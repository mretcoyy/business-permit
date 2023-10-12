<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Business;

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
            'referenceNo' => '',
            'dtiSecNo' => '',
            'dtiDateOfRedti_date_of_registrationgistration' => '',
            'typeOfOrganization' => '',
            'isTaxIncentive' => '',
            'dateOfApplication' => '',
            'createdAt' => '',
            'updatedAt' => '',
            'businessFiles' => $this->businessFiles($model->businessFiles),
            'businessInformation' => $this->businessInformation($model->businessInformation),
            'businessInformationDetail' => $this->businessInformationDetail($model->businessInformationDetail),
            'businessDetail' => $this->businessDetail($model->businessDetail),
            'lessorInformation' => $this->lessorInformation($model->lessorInformation),
            'ownerInformation' => $this->ownerInformation($model->ownerInformation),
        ];

        return$data;
    }

    public function businessDetail($data)
    {
        $data = [];

        foreach ($data as $datum) {
           'bin' => $datum->test,
           'status' => '',
           'date_renewed' => '', 
        }
        return $data;
    }

    public function businessInformation($data)
    {
        $data = [];

        foreach ($data as $datum) {
            'taxPayerFname' => $datum->first_name,
            'taxPayerMname' => $datum->middle_name,
            'taxPayerLname' => $datum->last_name,
            'taxPayerBname' => $datum->business_name,
            'taxPayerTname' => $datum->trade_name,
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
        }

        return $data;
    }

    public function businessInformationDetail($data)
    {
        $data = [];

        foreach ($data as $datum) {
            'code' => $datum->code,
            'line_of_business' => $datum->line_of_business,
            'number_of_units' => $datum->number_of_units,
            'capitalization' => $datum->capitalization,
            'essential' => $datum->essential,
            'non_essential' => $datum->non_essential,
        }

        return $data;
    }

    public function lessorInformation($data)
    {
        $data = [];

        foreach ($data as $datum) {
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
        }

        return $data;
    }

    public function ownerInformation($data)
    {
        $data = [];

        foreach ($data as $datum) {
            'OAddressHouseNo' => $datum->house_number,
            'OAddressStreet' => $datum->street,
            'OAddressBarangay' => $datum->barangay,
            'OAddressSubd' => $datum->subdivision,
            'OAddressCity' => $datum->city,
            'OAddressProvince' => $datum->province,
            'OAddressTelNo' => $datum->contact_number,
            'OAddressEmail' => $datum->email_address,
        }

        return $data;
    }

    public function businessFiles($data)
    {
        $data = [];

        foreach ($data as $datum) {
            'barangay_clearance',
            'zoning_clearance',
            'sanitary_clearance',
            'occupancy_permit',
            'environment_certificate',
            'community_tax_certificate',
            'real_property_tax_clearance',
            'fire_certificate',
        }

        return $data;
    }
}
