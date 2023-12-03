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
        $account_sid = env("TWILIO_SID", "AC89629d97fdfec64144d80c1ce050e5c0");
        $auth_token = env("TWILIO_AUTH_TOKEN", "95c519456bddaf356f6bf2da5f393676");
        $twilio_number = env("TWILIO_NUMBER", "+19253018760");
        log::info($account_sid);
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