<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Agora Chat Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for Agora Chat SDK integration
    |
    */

    'app_id' => env('AGORA_APP_ID', ''),
    'app_certificate' => env('AGORA_APP_CERTIFICATE', ''),
    'base_url' => env('AGORA_BASE_URL', 'https://api.agora.io'),
];

