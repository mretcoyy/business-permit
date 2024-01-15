<?php

namespace App\Traits;
use App\Enums\BusinessStatus;
use App\Mail\UserNotifEmail;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

trait StatusNotif
{

    public static function smsNotif($recipients, $message)
    {
        $account_sid = config("services.twillio.sid");
        $auth_token = config("services.twillio.auth_token");
        $twilio_number = config("services.twillio.number");
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($recipients, 
            ['from' => $twilio_number, 'body' => $message] );
    }

    public static function emailNotif($email, $email_data)
    {
        Mail::to($email)->send(new UserNotifEmail($email_data));
        if (Mail::failures()) {
            return ['message'=> "Mail not Sent"];
        }
        else{
            return ['message'=> "Mail Sent"];
        }
    }
}