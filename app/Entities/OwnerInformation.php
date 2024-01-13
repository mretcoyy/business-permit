<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class OwnerInformation.
 *
 * @package namespace App\Entities;
 */
class OwnerInformation extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'owners_information';
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
    protected $appends = ['fullname','address'];

    protected function getFullNameAttribute()
    {
        return $this->first_name . " " . ($this->middle_name == null ? '' : $this->middle_name. " ") . $this->last_name;
    }

    protected function getAddressAttribute()
    {
        $house_number = $this->house_number == null ? '' : $this->house_number;
        $building_name = $this->building_name == null ? '' : $this->building_name;
        $unit_no = $this->unit_no == null ? '' : $this->unit_no; 
        $street = $this->street == null ? '' : $this->street; 
        $barangay = $this->barangay == null ? '' : $this->barangay; 
        $subdivision = $this->subdivision == null ? '' : $this->subdivision; 
        $city = $this->city == null ? '' : $this->city; 
        $province = $this->province == null ? '' : $this->province;

        return
        ($building_name == null ? $house_number : $house_number. ", ") 
        . ($unit_no == null ? $building_name : $building_name. ", ") 
        . ($street == null ? $unit_no : $unit_no. ", ") 
        . ($barangay == null ? $street : $street. ", ") 
        . ($subdivision == null ? $barangay : $barangay. ", ") 
        . ($city == null ? $subdivision : $subdivision. ", ") 
        . ($province == null ? $city : $city. ", ") 
        . ($province == null ? '' : $province);

    
    }

}
