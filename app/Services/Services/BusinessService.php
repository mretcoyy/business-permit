<?php

namespace App\Services\Services;

use App\Entities\Business;
use App\Entities\BusinessDetail;
use App\Entities\BusinessFiles;
use App\Entities\BusinessInformation;
use App\Entities\BusinessInformationDetail;
use App\Entities\LessorInformation;
use App\Entities\OwnerInformation;
use App\Enums\BusinessStatus;
use Carbon\Carbon;

class BusinessService implements BusinessServiceInterface
{
    public function store($data)
    {
        $businessData = $data['business'];
        $businessInformationData = $data['businessInformation'];
        $ownersInformationData = $data['ownerAddress'];
        $lessorInformationData = $data['lessorInformation'];
        $date = Carbon::now();

        $storeBusiness = [
            'reference_number' => $businessData['referenceNo'],
            'dti_registration_no' => $businessData['dtiSecNo'],
            'dti_date_of_registration' => $businessData['dtiSecdateofReg'],
            'type_of_organization' => $businessData['typeOfOrganization'],
            'is_tax_incentive' => $businessData['hasTaxIncentive'],
            'date_of_application' => $businessData['dateOfApplication'],
        ];

        $business = Business::create($storeBusiness);
        
        $storeBusinessDetail = [
            'business_id' => $business->id,
            'bin' => '1234',
            'status' => BusinessStatus::NEW,
            'date_renewed' => $date,
        ];

        $storeBusinessInfo = [
            'business_id' => $business->id,
            'first_name' => $businessInformationData['taxPayerLname'],
            'middle_name' => $businessInformationData['taxPayerMname'],
            'last_name' => $businessInformationData['taxPayerFname'],
            'business_name' => $businessInformationData['taxPayerBname'],
            'trade_name' => $businessInformationData['taxPayerTname'],
            'business_number' => $businessInformationData['BAddressHouseNo'],
            'building_name' => $businessInformationData['BAddressBuildingName'],
            'unit_no' => $businessInformationData['BAddressUnitNo'],
            'street' => $businessInformationData['BAddressStreet'],
            'barangay' => $businessInformationData['BAddressBarangay'],
            'subdivision' => $businessInformationData['BAddressSubd'],
            'city' => $businessInformationData['BAddressCity'],
            'province' => $businessInformationData['BAddressProvince'],
            'contact_number' => $businessInformationData['BAddressTelNo'],
            'email_address' => $businessInformationData['BAddressEmail'],
            'pin' => $businessInformationData['test'],
            'business_area' => $businessInformationData['BusinessArea'],
            'number_of_employees' => $businessInformationData['TotalNumberofEmployees'],
            'number_of_employees_in_lgu' => $businessInformationData['LGUEmployeeCount'],
            'emergency_contact_person' => $businessInformationData['EmergencyContactPerson'],
            
        ];

        $storeOwnersInformation = [
            'business_id' => $business->id,
            'house_number' => $ownersInformationData['OAddressHouseNo'],
            'street' => $ownersInformationData['OAddressStreet'],
            'barangay' => $ownersInformationData['OAddressBarangay'],
            'subdivision' => $ownersInformationData['OAddressSubd'],
            'city' => $ownersInformationData['OAddressCity'],
            'province' => $ownersInformationData['OAddressProvince'],
            'contact_number' => $ownersInformationData['OAddressTelNo'],
            'email_address' => $ownersInformationData['OAddressEmail'],
        ];

        $storeLessorInformation = [
            'business_id' => $business->id,
            'first_name' => $lessorInformationData['LessorFname'],
            'middle_name' => $lessorInformationData['LessorMname'],
            'last_name' => $lessorInformationData['LessorLname'],
            'monthly_rental' => $lessorInformationData['LessorMonthlyRental'],
            'house_number' => $lessorInformationData['LAddressHouseNo'],
            'street' => $lessorInformationData['LAddressStreet'],
            'barangay' => $lessorInformationData['LAddressBarangay'],
            'subdivision' => $lessorInformationData['LAddressSubd'],
            'city' => $lessorInformationData['LAddressCity'],
            'province' => $lessorInformationData['LAddressProvince'],
            'contact_number' => $lessorInformationData['LAddressTelNo'],
            'email_address' => $lessorInformationData['LAddressEmail'],
        ];

    }

    public function changeStatus($data) 
    {
        $id = $data['id'];

        $updateData = [
            'status' => $data['status']
        ];

        $businessDetail = BusinessDetail::find($id);
        $businessDetail->update($updateData);

        return $businessDetail;
    }

    public function renewBusiness($id)
    {
        $insertDatra = [
            'business_id' => $business->id,
            'bin' => '1234',
            'status' => BusinessStatus::RENEW,
            'date_renewed' => Carbon::now(),
        ];

        $business = BusinessDetail::create($insertDatra);
    }
}