<?php

return [
    'api_return_auth_url' => env('ZOHO_API_RETURN_LOGIN_URL', 'http://zoho.local/zoho/auth'),
    'api_base_url' => env('ZOHO_API_BASE_URL', 'https://accounts.zoho.com/oauth/v2/auth'),
    'api_part_url' => env('ZOHO_API_PART_URL', '/oauth/v2/token'),
    'client_id' => env('ZOHO_CLIENT_ID', '1000.ULQLCTPY8KGPISQJQ06FUK6MA6GLFQ'),
    'secret_code' => env('ZOHO_SECRET_CODE', '40e6b27ff5d7f2106cb583d7f0ea6d36d69f628064'),
    'scope' => env('ZOHO_SCOPE', 'ZohoCRM.modules.ALL'),
    'response_type' => env('ZOHO_RESPONSE_TYPE', 'code'),
    'access_type' => env('ZOHO_ACCESS_TYPE', 'offline'),
    'api_version_route' => env('ZOHO_API_VERSION_ROUTE', '/crm/v3/'),
];

