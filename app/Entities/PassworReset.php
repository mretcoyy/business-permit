<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class PassworReset.
 *
 * @package namespace App\Entities;
 */
class PassworReset extends Model implements Transformable
{
    use TransformableTrait;
    protected $table = 'password_reset';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'token'
    ];

}
