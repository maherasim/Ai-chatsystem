<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Agora Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for Agora Real-Time Messaging (RTM) and Chat services.
    | Get these credentials from: https://console.agora.io/
    |
    */

    'app_id' => env('AGORA_APP_ID', ''),
    'app_certificate' => env('AGORA_APP_CERTIFICATE', ''),
    'customer_id' => env('AGORA_CUSTOMER_ID', ''),
    'customer_secret' => env('AGORA_CUSTOMER_SECRET', ''),
    
    // Agora Chat REST API base URL
    'chat_api_base_url' => 'https://api.agora.io/dev/v2',
    
    // RTM settings
    'rtm' => [
        'token_expiry' => env('AGORA_RTM_TOKEN_EXPIRY', 3600), // 1 hour default
    ],
    
    // Chat settings
    'chat' => [
        'token_expiry' => env('AGORA_CHAT_TOKEN_EXPIRY', 86400), // 24 hours default
        'org_name' => env('AGORA_ORG_NAME', ''),
        'app_name' => env('AGORA_APP_NAME', ''),
    ],
];

