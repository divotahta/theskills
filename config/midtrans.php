<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Midtrans Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration for Midtrans payment gateway.
    | You can set your server key, client key, and other settings here.
    |
    */

    'server_key' => env('MIDTRANS_SERVER_KEY', 'Mid-server-8hEYF1IVzpkT2VU2satq2r5o'),
    'client_key' => env('MIDTRANS_CLIENT_KEY', 'Mid-client-ughTgkx6m733ZUOl'),
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    'is_sanitized' => env('MIDTRANS_IS_SANITIZED', true),
    'is_3ds' => env('MIDTRANS_IS_3DS', true),
    'merchant_id' => env('MIDTRANS_MERCHANT_ID', 'G388833137'),
];
