<?php

namespace App\Http\Controllers;

use App\Services\ZohoApi\ZohoContactsService;
use App\Services\ZohoApi\ZohoDealsService;

class DealsController extends Controller
{
    public function create() {

        //TODO writer data for deal.
        $data = [];

        $user = request()->user();
        $zohoDealsService = new ZohoDealsService();
        $response = $zohoDealsService->addDeal($data, $user->id);

        dd('createDeals', $response);
    }
}
