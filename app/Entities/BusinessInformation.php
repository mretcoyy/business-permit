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
        $business_number = $this->business_number == null ? '' : $this->business_number;
        $building_name = $this->building_name == null ? '' : $this->building_name;
        $unit_no = $this->unit_no == null ? '' : $this->unit_no; 
        $street = $this->street == null ? '' : $this->street; 
        $barangay = $this->barangay == null ? '' : $this->barangay; 
        $subdivision = $this->subdivision == null ? '' : $this->subdivision; 
        $city = $this->city == null ? '' : $this->city; 
        $province = $this->province == null ? '' : $this->province;

        return
        ($building_name == null ? $business_number : $business_number. ", ") 
        . ($unit_no == null ? $building_name : $building_name. ", ") 
        . ($street == null ? $unit_no : $unit_no. ", ") 
        . ($barangay == null ? $street : $street. ", ") 
        . ($subdivision == null ? $barangay : $barangay. ", ") 
        . ($city == null ? $subdivision : $subdivision. ", ") 
        . ($province == null ? $city : $city. ", ") 
        . ($province == null ? '' : $province);
    }


}
