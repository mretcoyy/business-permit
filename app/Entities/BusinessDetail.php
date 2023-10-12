<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class BusinessDetail.
 *
 * @package namespace App\Entities;
 */
class BusinessDetail extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'business_detail';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'business_id',
        'bin',
        'status',
        'date_renewed',
        'created_at',
        'updated_at'
    ];

}
