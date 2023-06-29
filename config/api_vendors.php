<?php

return [
    'you_verify' => [
        'base_url' => env('YOU_VERIFY_BASE_URL'),
        'token' => env('YOU_VERIFY_APIKEY'),
    ],
    'bulk_sms_nigeria' => [
        'base_url' => env('BULK_SMS_NIGERIA_BASE_URL'),
        'api_token' => env('BULK_SMS_NIGERIA_API_TOKEN'),
        'sender_id' => env('BULK_SMS_NIGERIA_SENDER_ID'),
    ],
];
