<?php

namespace App\Services\ZohoApi;

class ZohoAuthenticationService extends ZohoApiService
{
    /**
     * Start auth process
     *
     * @param string $ssn
     *
     * @return array
     */
    public function generateZohoTokensData(string $url, string $code)
    {
        $params = [
//            'client_id'  => config('zoho.client_id'),
//            'client_secret'  => config('zoho.secret_code'),
            'grant_type'   => 'authorization_code',
            'code'          => $code,
            'redirect_uri'  => config('zoho.api_return_auth_url'),
        ];

        $data = $this->sendAuthentication($url . config('zoho.api_part_url'), $params);

        return $this->getAuthenticationBody($data);
    }

    /**
     * Get authentication body
     *
     * @param $response
     *
     * @return array|null
     */
    protected function getAuthenticationBody($data)
    {
        //TODO Need get correct data and fix in this function
        return $data;
    }

    /**
     * Get data from config
     *
     * @return array
     */
    public function getDataForRoute() {
        return [
            'api_base_url' => config('zoho.api_base_url'),
            'client_id' => config('zoho.client_id'),
            'scope' => config('zoho.scope'),
            'response_type' => config('zoho.response_type'),
            'access_type' => config('zoho.access_type'),
            'api_return_auth_url' => config('zoho.api_return_auth_url'),
        ];
    }

}
