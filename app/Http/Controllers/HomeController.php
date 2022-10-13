<?php

namespace App\Http\Controllers;

use App\Services\ZohoApi\ZohoAuthenticationService;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
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


        return view('home', compact('zohoRequest'));
    }
}
