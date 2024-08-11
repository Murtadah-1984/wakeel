<?php

return [
    'gateway' => env('PAYMENT_GATEWAY', 'fib'), // Default to FIB
    'fastpay' => [
        'store_id' => env('FASTPAY_STORE_ID'),
        'store_password' => env('FASTPAY_STORE_PASSWORD'),
        'base_url' => env('FASTPAY_BASE_URL', 'https://staging-apigw-merchant.fast-pay.iq'),
    ],
    'zaincash' => [
        'merchant_id' => env('ZAINCASH_MERCHANT_ID'),
        'merchant_secret' => env('ZAINCASH_MERCHANT_SECRET'),
        'base_url' => env('ZAINCASH_BASE_URL', 'https://test.zaincash.iq'),
    ],
    'areeba' => [
        'merchant_id' => env('AREEBA_MERCHANT_ID'),
        'api_password' => env('AREEBA_API_PASSWORD'),
        'base_url' => env('AREEBA_BASE_URL', 'https://epayment.areeba.com/api/rest/version/78'),
    ],
    'paypal' => [
        'client_id' => env('PAYPAL_CLIENT_ID'),
        'client_secret' => env('PAYPAL_CLIENT_SECRET'),
        'base_url' => env('PAYPAL_BASE_URL', 'https://api.sandbox.paypal.com'),
    ],
    'stripe' => [
        'secret' => env('STRIPE_SECRET'),
    ],
];
