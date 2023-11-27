<?php

namespace App\Traits;
use App\Enums\BusinessStatus;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

trait StatusNotif
{

    public static function smsNotif($recipients, $message)
    {
        log::info('testSmS');
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($recipients, 
            ['from' => $twilio_number, 'body' => $message] );
    }

    public static function emailNotif($email, $status)
    {
        log::info('testEmail');
    }
}