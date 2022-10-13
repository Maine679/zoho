<?php

namespace App\Http\Controllers;


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

        dd('auth',$authenticationData);
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
