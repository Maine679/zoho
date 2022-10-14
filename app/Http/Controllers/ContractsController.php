<?php

namespace App\Http\Controllers;

use App\Services\ZohoApi\ZohoContactsService;

class ContractsController extends Controller
{
    public function create()
    {
        $user = request()->user();

        $data =[
            'data' => [
                0 => [
                    'Company' => 'Zylker',
                    'Last_Name' => 'Daly',
                    'First_Name' => 'Paul',
                    'Email' => 'p.daly@zylker.com',
                    'State' => 'Texas',
                    '$wizard_connection_path' =>
                        [
                            0 => '3652397000003679053',
                        ],
                    'Wizard' =>
                        [
                            'id' => '3652397000003677001',
                        ],
                    ],
                1 => [
                        'Company' => 'Villa Margarita',
                        'Last_Name' => 'Dolan',
                        'First_Name' => 'Brian',
                        'Email' => 'brian@villa.com',
                        'State' => 'Texas',
                    ],
                ],
            'lar_id' => '3652397000002045001',
            'trigger' => [
                0 => 'approval',
                1 => 'workflow',
                2 => 'blueprint',
            ],
        ];

        $zohoContractService = new ZohoContactsService();
        $response = $zohoContractService->createContact($data, $user->id);

        dd('create', $response);
    }

    public function index()
    {
        $user = request()->user();

        $zohoContractService = new ZohoContactsService();
        $response = $zohoContractService->getContacts($user->id);

        dd('index', $response);
    }
}
