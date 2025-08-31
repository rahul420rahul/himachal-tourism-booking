<?php

return [
    'razorpay' => [
        'key' => env('RAZORPAY_KEY_ID'),
        'secret' => env('RAZORPAY_KEY_SECRET'),
        'webhook_secret' => env('RAZORPAY_WEBHOOK_SECRET'),
    ],
    
    'weather' => [
        'api_key' => env('OPENWEATHER_API_KEY'),
    ],
];
