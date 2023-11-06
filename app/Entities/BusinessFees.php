<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class BusinessFees.
 *
 * @package namespace App\Entities;
 */
class BusinessFees extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'business_fees';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'business_id',
        'business_tax',
        'mayors_permit',
        'occupational_permit',
        'subscription_other',
        'environmental_clearance',
        'sanitary_permit_fee',
        'zoning_fee',
        'user_id',
        'status',
    ];

}
