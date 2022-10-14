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
    public function welcome()
    {
        return view('welcome');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = request()->user();
        $zohoData = [];
        $zohoAuthenticationService = new ZohoAuthenticationService();

        if(!optional($user->zohoAccess)->id) {
            $dataForRoute = $zohoAuthenticationService->getDataForRoute();

            $zohoData['requestAuth'] = $dataForRoute['api_base_url'] .
                "?scope=" . $dataForRoute['scope'] .
                "&client_id=" . $dataForRoute['client_id'] .
                "&response_type=" . $dataForRoute['response_type'] .
                "&access_type=" . $dataForRoute['access_type'] .
                "&redirect_uri=" . $dataForRoute['api_return_auth_url'];
        } else {
            $zohoData['indexContract'] = true;
            $zohoData['createContract'] = true;
            $zohoData['createDeals'] = true;
        }

        return view('home', compact('zohoData'));
    }
}
