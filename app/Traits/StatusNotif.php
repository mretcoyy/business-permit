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
        log::info('testSmS');
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($recipients, 
            ['from' => $twilio_number, 'body' => $message] );
    }

    public static function emailNotif($email, $email_data)
    {
        log::info('testEmail');
        Mail::to($email)->send(new UserNotifEmail($email_data));
        if (Mail::failures()) {
            return ['message'=> "Mail not Sent"];
        }
        else{
            return ['message'=> "Mail Sent"];
        }
    }
}