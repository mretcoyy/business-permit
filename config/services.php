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

    'http_sms' => [
        'from' => env("HTTP_SMS_FROM", "+639615537090"),
        'api_key' => env("HTTP_SMS_KEY", "Q8J2bBxuX4_ZFGaVmVcsCv96pyQoER5-WqPMflq7t-vivA6GrPSdC7mH_Al6aDYI")
    ],

    'twillio' => [
        'sid' => env("TWILIO_SID", "AC89629d97fdfec64144d80c1ce050e5c0"),
        'auth_token' => env("TWILIO_AUTH_TOKEN", "b41608f530ad12ce7d789b15c2e4570d"),
        'number' => env("TWILIO_NUMBER", "+19253018760"),
    ],

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

];
