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
    | IMPORTANT: 
    | - For production, update your .env file with production keys
    | - Never commit production keys to version control
    | - Always test in sandbox mode first
    |
    */

    // Server Key - Get from Midtrans Dashboard
    'server_key' => env('MIDTRANS_SERVER_KEY', 'Mid-server-8hEYF1IVzpkT2VU2satq2r5o'),
    
    // Client Key - Get from Midtrans Dashboard  
    'client_key' => env('MIDTRANS_CLIENT_KEY', 'Mid-client-ughTgkx6m733ZUOl'),
    
    // Production Mode - Set to true for production
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    
    // Sanitized Mode - Set to true for security
    'is_sanitized' => env('MIDTRANS_IS_SANITIZED', true),
    
    // 3DS Mode - Set to true for 3D Secure
    'is_3ds' => env('MIDTRANS_IS_3DS', true),
    
    // Merchant ID - Get from Midtrans Dashboard
    'merchant_id' => env('MIDTRANS_MERCHANT_ID', 'G388833137'),
    
    /*
    |--------------------------------------------------------------------------
    | Environment Specific Settings
    |--------------------------------------------------------------------------
    |
    | Different settings for different environments
    |
    */
    
    'sandbox' => [
        'server_key' => 'Mid-server-8hEYF1IVzpkT2VU2satq2r5o',
        'client_key' => 'Mid-client-ughTgkx6m733ZUOl',
        'merchant_id' => 'G388833137',
        'base_url' => 'https://api.sandbox.midtrans.com',
    ],
    
    'production' => [
        'server_key' => env('MIDTRANS_PRODUCTION_SERVER_KEY'),
        'client_key' => env('MIDTRANS_PRODUCTION_CLIENT_KEY'),
        'merchant_id' => env('MIDTRANS_PRODUCTION_MERCHANT_ID'),
        'base_url' => 'https://api.midtrans.com',
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Payment Methods
    |--------------------------------------------------------------------------
    |
    | Available payment methods
    |
    */
    
    'payment_methods' => [
        'credit_card' => true,
        'bca_va' => true,
        'bni_va' => true,
        'bri_va' => true,
        'mandiri_va' => true,
        'permata_va' => true,
        'gopay' => true,
        'shopeepay' => true,
        'qris' => true,
        'echannel' => true,
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Callback URLs
    |--------------------------------------------------------------------------
    |
    | URLs for payment callbacks
    |
    */
    
    'callbacks' => [
        'finish' => env('MIDTRANS_FINISH_URL', url('/student/payment/success')),
        'unfinish' => env('MIDTRANS_UNFINISH_URL', url('/student/payment/failure')),
        'error' => env('MIDTRANS_ERROR_URL', url('/student/payment/failure')),
        'notification' => env('MIDTRANS_NOTIFICATION_URL', url('/payment/notification')),
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Logging
    |--------------------------------------------------------------------------
    |
    | Logging configuration for Midtrans
    |
    */
    
    'logging' => [
        'enabled' => env('MIDTRANS_LOGGING_ENABLED', true),
        'level' => env('MIDTRANS_LOG_LEVEL', 'info'),
        'channel' => env('MIDTRANS_LOG_CHANNEL', 'single'),
    ],
];
