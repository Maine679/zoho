<?php

namespace App\Http\Controllers;


use App\Models\ZohoAccess;
use App\Services\ZohoApi\ZohoAuthenticationService;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;


class ZohoController extends Controller
{
    /**
     * Login by Zoho
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function auth(Request $request)
    {
        if (!$request->get('code') || !$request->get('accounts-server') || $request->get('error'))
            return redirect()->intended('');

        $zohoAuthenticationService = new ZohoAuthenticationService();
        $authenticationData = $zohoAuthenticationService->generateZohoTokensData($request->get('accounts-server'), $request->get('code'));

        $user = $request->user();
        if(($authenticationData['access_token'] ?? false) && ($authenticationData['api_domain'] ?? false)) {

            ZohoAccess::updateOrCreate(
                [
                    'user_id' => $user->id,
                ],
                [
                    'access_token' => $authenticationData['access_token'],
                    'access_token_at' => time() + ($authenticationData['expires_in'] ?? null),
                    'refresh_token' => $authenticationData['refresh_token'] ?? null,
                    'api_domain' => $authenticationData['api_domain'],
                ]
            );
        }
        return redirect()->intended('home');
    }

    public function getDataUsers() {
//        array:4 [▼
//          "access_token" => "1000.6f43e41fd7d8192c0390d82a3d2f790a.cd1b94e177b1fec4b54a298ce1020492"
//          "api_domain" => "https://www.zohoapis.eu"
//          "token_type" => "Bearer"
//          "expires_in" => 3600
//        ]
    }
}
