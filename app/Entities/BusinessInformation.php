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

    protected $appends = ['fullname','address'];

    protected function getFullNameAttribute()
    {
        return $this->first_name . " " . ($this->middle_name == null ? '' : $this->middle_name. " ") . $this->last_name;
    }

    protected function getAddressAttribute()
    {
        return
        ($this->business_number == null ? '' : $this->business_number. " ") 
        . ($this->building_name == null ? '' : $this->building_name. " ") 
        . ($this->unit_no == null ? '' : $this->unit_no. " ") 
        . ($this->street == null ? '' : $this->street. " ") 
        . ($this->barangay == null ? '' : $this->barangay. " ") 
        . ($this->subdivision == null ? '' : $this->subdivision. " ") 
        . ($this->city == null ? '' : $this->city. " ") 
        . ($this->province == null ? '' : $this->province. " ");
    }


}
