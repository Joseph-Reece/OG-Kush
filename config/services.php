<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],


    'facebook' => [
        'client_id' => env('FACEBOOK_APP_ID'),
        'client_secret' => env('FACEBOOK_APP_SECRET'),
        'redirect' => env('FACEBOOK_APP_CALLBACK_URL'),
    ],

    'google' => [
        'client_id' => env('GOOGLE_APP_ID'),
        'client_secret' => env('GOOGLE_APP_SECRET'),
        'redirect' => env('GOOGLE_APP_CALLBACK_URL'),
    ],
    'apple' => [
        'client_id' => env('APPLE_APP_ID'),
        'client_secret' => env('APPLE_APP_SECRET'),
        'redirect' => env('APPLE_APP_CALLBACK_URL'),
    ],
    'paypal' => [
        'id' => env('PAYPAL_CLIENT_ID'),
        'secret' => env('PAYPAL_SECRET'),
        'url' => [
            'redirect' => 'http://localhost:8000/execute-payment',
            'cancel'=>'http://localhost:8000/cancel',
            'executeAgreement' => [
                'success'=>'http://budandcarriage.techplus.com.pk/execute-agreement/true',
                'failure'=>'http://budandcarriage.techplus.com.pk/execute-agreement/false'

            ]
        ]
    ],
];
