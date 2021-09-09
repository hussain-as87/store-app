<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
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
    'paypal' => [
        'clint_id' => env('PAYPAL_CLINT_ID', ''),
        'clint_secret' => env('PAYPAL_CLINT_SECRET', ''),
        'mode' => env('PAYPAL_MODE', 'sandbox'),
    ], 'nexmo' => [
        'sms_from' => env('APP_NAME', 'Store'),
    ],
    'moyasar' => [
        'key' => 'sk_test_XqiVnFEQx134z7XmdGSZuoroi9jVWsVbP8cjw8qd',
        'secret' => 'pk_test_CVfjwvodCJqPtknW57gYhyxvEN6E3UuZGsNax6W2'

    ]/* , 'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect' => url('social/facebook/callback'),

    ]*/, 'github' => [
        'client_id' => env('GITHUB_CLIENT_ID', 'Iv1.214a577d35b3c37c'),
        'client_secret' => env('GITHUB_CLIENT_SECRET', 'd26650deedfe6eed3482a8a4d8c159b3f05d2422 '),
        'redirect' => 'http://127.0.0.1:8000/github/callback',
    ], 'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID', '818531962886-1mos38dq6mk2ic4om760ne7q745eqsgh.apps.googleusercontent.com'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET', 'ayPZVxF0RbBNCsdOtOgQDMfB'),
        'redirect' => 'http://127.0.0.1:8000/google/callback',
    ]


];
