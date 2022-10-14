<?php

namespace App\Services\ZohoApi;

class ZohoContactsService extends ZohoApiService
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
    public function createContact($contactsData, $userId): array
    {
        return  $this->sendWithAuthToken('post', 'Contacts', $userId, $contactsData);
    }

    /**
     *
     *
     * @param array $contactsData
     *
     * @return array
     *
     * @return array|null
     */
    public function getContacts($userId): array
    {
        return  $this->sendWithAuthToken('get', 'Contacts?fields=Last_Name,Email', $userId);
    }
}
