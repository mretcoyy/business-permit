<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class LessorInformation.
 *
 * @package namespace App\Entities;
 */
class LessorInformation extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'business_id',
        'first_name',
        'middle_name',
        'last_name',
        'monthly_rental',
        'house_number',
        'building_name',
        'unit_no',
        'street',
        'barangay',
        'subdivision',
        'city',
        'province',
        'contact_number',
        'email_address',
        'created_at',
        'updated_at',
    ];

}
