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

    'client' => [
        'defaults' => [
            'verify' => env('CLIENT_DEFAULTS_VERIFY', false),
        ],
        'timeout' => env('CLIENT_TIMEOUT', 120),
        'connect_timeout' => env('CLIENT_CONNECT_TIMEOUT', 120),
        'debug' => env('CLIENT_DEBUG', false),
    ],

    'imdb' => [
        'base_uri' => env('IMDB_COLLECT_API_BASE_URL', 'https://api.collectapi.com/imdb/'),
        'headers' => [
            'authorization' => env('IMDB_COLLECT_API_TOKEN'),
            'content-type' => env('IMDB_COLLECT_API_CONTENT_TYPE', 'application/json'),
        ]
    ],

];
