<?php
return [
    'default' => env('PAYMENT_PROVIDER', 'paystack'),

    'providers' => [
        'paystack' => [
            'base_url' => env('PAYSTACK_BASE_URL', 'https://api.paystack.co'),
            'secret_key' => env('PAYSTACK_SECRET_KEY'),
        ],
    ],
];
