<?php

namespace App\Transformers;

use App\Entities\AuditTrails;
use League\Fractal\TransformerAbstract;
use App\Entities\Business;
use App\Enums\BusinessStatus;
use App\Enums\TypeOfOrganization;
use Illuminate\Support\Facades\Log;

class AuditTrailTransformer extends TransformerAbstract
{
 
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(AuditTrails $model)
    {
        $data = [
            'type' => $model->type,
            'status' => $model->status,
            'business_id' => $model->business_id,
            'status_label' => BusinessStatus::getDescription((int)$model->status),
            'user_id' => $model->user_id,
            'createdAt' => $model->created_at,
            'updatedAt' => $model->updated_at,
            'user' => $this->user($model->user),
            'businessInformation' => $this->businessInformation($model->businessInformation),
            'businessDetail' => $this->businessDetail($model->businessDetail),
        ];

        return $data;
    }

    public function user($data)
    {   
        return $data;
        $result = [];
           $result = [
            'name' => $data->name,
            'full_address' => $data->full_address,
           ];
        return $result;
    }

    public function businessDetail($data)
    {   
        $result = [];
        foreach ($data as $datum) {
           $result = [
            'business_id' => $datum->business_id,
            'bin' => $datum->bin,
            'date_renewed' => $datum->date_renewed,
            'status' => BusinessStatus::getDescription($datum->status),
            'business_status' => strtoupper(BusinessStatus::getDescription( (integer) $datum->business_status)),
            'status_val' => $datum->status,
            'business_status_val' => (integer) $datum->business_status,
           ];
        }
        return $result;
    }

    public function businessInformation($data)
    {
        $result = [];
        foreach ($data as $datum) {
            $result = [
                'taxPayerFullname' => $datum->fullname,
                'taxPayerFname' => $datum->first_name,
                'taxPayerMname' => $datum->middle_name,
                'taxPayerLname' => $datum->last_name,
                'taxPayerBname' => $datum->business_name,
                'taxPayerTname' => $datum->trade_name,
                'BAddress' => $datum->address,
                'BAddressHouseNo' => $datum->business_number,
                'BAddressBuildingName' => $datum->building_name,    
                'BAddressUnitNo' => $datum->unit_no,
                'BAddressStreet' => $datum->street,
                'BAddressBarangay' => $datum->barangay,
                'BAddressSubd' => $datum->subdivision,
                'BAddressCity' => $datum->city,
                'BAddressProvince' => $datum->province,
                'BAddressTelNo' => $datum->contact_number,
                'BAddressEmail' => $datum->email_address,
                'pin' => $datum->pin,
                'BusinessArea' => $datum->business_area,
                'TotalNumberofEmployees' => $datum->number_of_employees,
                'LGUEmployeeCount' => $datum->number_of_employees_in_lgu,
                'EmergencyContactPerson' => $datum->emergency_contact_person,
            ];
        }

        return $result;
    }


    public function ownerInformation($data)
    {
        $result = [];
        foreach ($data as $datum) {
            $result = [
                'OFullname' => $datum->fullname,
                'OFulladdress' => $datum->address,
                'OFname' => $datum->first_name,
                'OMname' => $datum->middle_name,
                'OLname' => $datum->last_name,
                'OAddressHouseNo' => $datum->house_number,
                'OAddressBuildingName' => $datum->building_name,
                'OAddressUnitNo' => $datum->unit_no,
                'OAddressStreet' => $datum->street,
                'OAddressBarangay' => $datum->barangay,
                'OAddressSubd' => $datum->subdivision,
                'OAddressCity' => $datum->city,
                'OAddressProvince' => $datum->province,
                'OAddressTelNo' => $datum->contact_number,
                'OAddressEmail' => $datum->email_address,
            ];
        }

        return $result;
    }
}
