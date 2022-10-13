<?php

namespace App\Http\Controllers;

use App\Services\ZohoApi\ZohoAuthenticationService;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return Factory|View
     *
     */
    public function index()
    {
        $zohoAuthenticationService = new ZohoAuthenticationService();
        $dataForRoute = $zohoAuthenticationService->getDataForRoute();

        $zohoRequest = $dataForRoute['api_base_url'] .
            "?scope=" .$dataForRoute['scope'] .
            "&client_id=" .$dataForRoute['client_id'] .
            "&response_type=" .$dataForRoute['response_type'] .
            "&access_type=" .$dataForRoute['access_type'] .
            "&redirect_uri=" .$dataForRoute['api_return_auth_url'];


        return view('welcome', compact('zohoRequest'));
    }
}
