<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class BusinessInformation.
 *
 * @package namespace App\Entities;
 */
class BusinessInformation extends Model implements Transformable
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
        'business_name',
        'trade_name',
        'business_number',
        'building_name',
        'unit_no',
        'street',
        'barangay',
        'subdivision',
        'city',
        'province',
        'contact_number',
        'email_address',
        'pin',
        'business_area',
        'number_of_employees',
        'number_of_employees_in_lgu',
        'emergency_contact_person',
        'created_at',
        'updated_at',
    ];

}
