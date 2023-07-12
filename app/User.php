<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;


    protected $fillable = [
        'name',
        'email',
        'username',
        'type',
        'password',
        'full_address',
        'contact_number',
        'status',
        'role',
        'barangay',
        'remember_token'
    ];

    // public function sendPasswordResetNotification($token)
    // {
    //     $this->notify(new \App\Notifications\MailResetPasswordNotification($token));
    // }
}
