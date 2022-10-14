<?php

namespace App\Services\ZohoApi;

use App\Models\ZohoAccess;
use Carbon\Carbon;
use GuzzleHttp;
use GuzzleHttp\Psr7\Response as GuzzleResponse;
use Throwable;
use Symfony\Component\HttpFoundation\Response;

class ZohoApiService
{
    public const TOKEN_TYPE = 'Zoho-oauthtoken ';

    /**
     * Send authentication request
     *
     * @param string $method
     * @param string $url
     * @param array $params
     * @return array|GuzzleResponse|string|null
     */
    protected function sendAuthentication(string $url, array $params = [])
    {
        $params = [
            'headers' => $this->prepareAuthenticationHeaders(),
            'form_params' => $params,
        ];

        return $this->sendMethod('post', $url, $params);
    }

    /**
     * Send authentication request
     *
     * @param string $method
     * @param string $url
     * @param array $params
     * @return array|GuzzleResponse|string|null
     */
    protected function sendWithAuthToken($method, string $url, $userId, $body = [])
    {
        $zohoAccess = (new ZohoAccess())->where('user_id', $userId)->first();
        if(!$zohoAccess)
            throw new \Exception('Something went wrong. You don\'t have auth token.');

        if( $zohoAccess->access_token_at < Carbon::now() && config('zoho.access_type') === 'offline') {
            //TODO Create refresh token with refresh token
//            refreshAuthToken($zohoAccess);
            $zohoAccess->refresh();
            dd('access token expired');
        }

        $params = [
            'headers' => $this->prepareAuthenticationHeaders($zohoAccess->access_token),
            'form_params' => $body,
        ];

        $url = $zohoAccess->api_domain . config('zoho.api_version_route') . $url;

        return $this->sendMethod($method, $url, $params);
    }

    /**
     * @param string $method 'post', 'get', 'put', 'delete'
     * @param string $action
     * @param array $params
     *
     * @return array|null
     */
    protected function sendMethod($method, $url, $params = [])
    {
        $response = $this->send($method, $url, $params);

        return $this->getResponseBody($response);
    }

    /**
     * Send request
     *
     * @param string $method 'post', 'get', 'put', 'delete'
     * @param string $url
     * @param array $params
     * @param float $timeout
     *
     * @return GuzzleResponse|null
     * @throws \Exception
     */
    private function send($method, $url, $params = [])
    {
        $client = new GuzzleHttp\Client();

        try {
            /** @var GuzzleHttp\Psr7\Response $result */
            $result = $client->$method($url, $params);
        } catch (Throwable $error) {
            \Log::error($error);
            throw new \Exception('Something went wrong.');
        }

        return $result;
    }

    /**
     * @return array
     */
    private function prepareAuthenticationHeaders(string $access_token = '')
    {
        $headers = [
            'content-type' => 'application/x-www-form-urlencoded;charset=UTF-8',
            'Authorization' => $access_token
                ? self::TOKEN_TYPE . $access_token
                : 'Basic ' . base64_encode( config('zoho.client_id') . ':' . config('zoho.secret_code') )
        ];

        return $headers;
    }

    /**
     * Get response body
     *
     * @param $response
     *
     * @return array|string|null
     */
    protected function getResponseBody($response)
    {
        if ($response && $response->getStatusCode() === Response::HTTP_OK)
            return @json_decode($response->getBody(), true);

        return null;
    }
}
