<?php

namespace App\Traits;
use App\Enums\BusinessStatus;
use Twilio\Rest\Client;

trait StatusNotif
{

    public function smsNotif($recipients, $message)
    {
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($recipients, 
            ['from' => $twilio_number, 'body' => $message] );
    }

    public function emailNotif($email, $status)
    {

    }
}