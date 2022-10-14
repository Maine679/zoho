<?php

namespace App\Services\ZohoApi;

class ZohoDealsService extends ZohoApiService
{
    /**
     * Create a single contact.
     *
     * @param array $contactsData
     *
     * @return array
     *
     * @return array|null
     */
    public function addDeal($dealsData, $userId): array
    {
        return  $this->sendWithAuthToken('post', 'Deals', $userId, $dealsData);
    }
}
