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
            'grant_type'   => 'authorization_code',
            'code'          => $code,
            'redirect_uri'  => config('zoho.api_return_auth_url'),
        ];

        return $this->sendAuthentication($url . config('zoho.api_part_url'), $params);
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
