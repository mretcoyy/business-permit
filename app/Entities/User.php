<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Class User.
 *
 * @package namespace App\Entities;
 */
class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'email',
        'username',
        'role',
        'password',
        'full_address',
        'contact_number',
        'status',
        'barangay',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function business()
    {
        return $this->hasMany(Business::class, 'user_id', 'id');
    }
    
    // public function sendPasswordResetNotification($token)
    // {
    //     $this->notify(new \App\Notifications\MailResetPasswordNotification($token));
    // }

}
