<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Business;
use App\Enums\BusinessStatus;
use App\Enums\TypeOfOrganization;
use Illuminate\Support\Facades\Log;

class BusinessTransformer extends TransformerAbstract
{
 
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Business $model)
    {
        $data = [
            'referenceNo' => $model->reference_number,
            'dtiSecNo' => $model->dti_registration_no,
            'dtiSecdateofReg' => $model->dti_date_of_registration,
            'typeOfOrganizationLabel' => TypeOfOrganization::getDescription($model->type_of_organization),
            'typeOfOrganization' => $model->type_of_organization,
            'isTaxIncentive' => $model->is_tax_incentive,
            'dateOfApplication' => $model->date_of_application,
            'typeOfBusienss' => Date('Y',strtotime($model->date_of_application)) == Date('Y') ? 1 : 0,
            'createdAt' => $model->created_at,
            'updatedAt' => $model->updated_at,
            'businessFiles' => $this->businessFiles($model->businessFiles),
            'businessInformation' => $this->businessInformation($model->businessInformation),
            'businessInformationDetail' => $this->businessInformationDetail($model->businessInformationDetail),
            'businessDetail' => $this->businessDetail($model->businessDetail),
            'lessorInformation' => $this->lessorInformation($model->lessorInformation),
            'ownerInformation' => $this->ownerInformation($model->ownerInformation),
        ];

        return $data;
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

    public function businessInformationDetail($data)
    {
        $result = [];
        foreach ($data as $datum) {
            $result[] = [
                'id' => $datum->id,
                'code' => $datum->code,
                'line_of_business' => $datum->line_of_business,
                'number_of_units' => $datum->number_of_units,
                'capitalization' => $datum->capitalization,
                'essential' => $datum->essential,
                'non_essential' => $datum->non_essential,
            ];
        }

        return $result;
    }

    public function lessorInformation($data)
    {
        $result = [];
        foreach ($data as $datum) {
            $result = [
                'LessorFname' => $datum->first_name,
                'LessorMname' => $datum->middle_name,
                'LessorLname' => $datum->last_name,
                'LessorMonthlyRental' => $datum->monthly_rental,
                'LAddressHouseNo' => $datum->house_number,
                'LAddressStreet' => $datum->street,
                'LAddressBarangay' => $datum->barangay,
                'LAddressSubd' => $datum->subdivision,
                'LAddressCity' => $datum->city,
                'LAddressProvince' => $datum->province,
                'LAddressTelNo' => $datum->contact_number,
                'LAddressEmail' => $datum->email_address,
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

    public function businessFiles($data)
    {
        $result = [];
        foreach ($data as $datum) {
            $result = [
                'business_file_id' => $datum->id,
                'barangay_clearance' => $datum->barangay_clearance,
                'zoning_clearance' => $datum->zoning_clearance,
                'sanitary_clearance' => $datum->sanitary_clearance,
                'occupancy_permit' => $datum->occupancy_permit,
                'environment_certificate' => $datum->environment_certificate,
                'community_tax_certificate' => $datum->community_tax_certificate,
                'real_property_tax_clearance' => $datum->real_property_tax_clearance,
                'fire_certificate' => $datum->fire_certificate,
            ];
        }

        return $result;
    }
}
