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
}
