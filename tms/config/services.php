<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'facebook' => [
        'client_id' => '275578219472356',
        'client_secret' => 'f563c045b74480570a2981f35f93faf5',
        'redirect' => 'http://laravel.dev/Project1/tms/public/login/socialNetwork/callback',
    ],

    'twitter' => [
        'client_id' => 'AVtBOLEWa80whaJ4qpwKTxWwc',
        'client_secret' => 'ngqTggcQ6uRodfv2J38jQnTZKd71EyZMuv1EMDwUFT9lPPTHem',
        'redirect' => 'http://laravel.dev/Project1/tms/public/login/socialNetwork/callbackTwitter',
    ],

    'google' => [
        'client_id' => '262932562453-0a3pfdj4pmtgr4bd3p12ovmna4nr5h1p.apps.googleusercontent.com',
        'client_secret' => 'PDWv6njesZKCroF6kqGPMKaJ',
        'redirect' => 'http://laravel.dev/Project1/tms/public/login/socialNetwork/callbackGmail',
    ],

    

];
