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
use App\Enums\TypeOfOrganization;
use Carbon\Carbon;
use App\Services\Contract\BusinessServiceInterface;
use Illuminate\Support\Facades\Log;

class BusinessService implements BusinessServiceInterface
{
    public function store($data_field, $files)
    {
        $data = json_decode($data_field);
        $businessData = $data->business;
        $businessInformationData = $data->businessInformation;
        $businessInformationDetailData = $data->BusinessActivity;
        $ownersInformationData = $data->ownerAddress;
        $lessorInformationData = $data->lessorInformation;
        $date = Carbon::now();
        $storeBusiness = [
            'reference_number' => $businessData->referenceNo,
            'dti_registration_no' => $businessData->dtiSecNo,
            'dti_date_of_registration' => Carbon::now(),
            'type_of_organization' => TypeOfOrganization::SINGLE,
            'is_tax_incentive' => 1,
            'date_of_application' => Carbon::now(),
            'user_id' => 1,
        ];

        $business = Business::create($storeBusiness);
        
        $storeBusinessDetail = [
            'business_id' => $business->id,
            'bin' => '1234',
            'status' => BusinessStatus::NEW,
            'date_renewed' => $date,
        ];

        $businessDetail = BusinessDetail::create($storeBusinessDetail);

        $storeBusinessInfo = [
            'business_id' => $business->id,
            'first_name' => $businessInformationData->taxPayerLname,
            'middle_name' => $businessInformationData->taxPayerMname,
            'last_name' => $businessInformationData->taxPayerFname,
            'business_name' => $businessInformationData->taxPayerBname,
            'trade_name' => $businessInformationData->taxPayerTname,
            'business_number' => $businessInformationData->BAddressHouseNo,
            'building_name' => $businessInformationData->BAddressBuildingName,
            'unit_no' => $businessInformationData->BAddressUnitNo,
            'street' => $businessInformationData->BAddressStreet,
            'barangay' => $businessInformationData->BAddressBarangay,
            'subdivision' => $businessInformationData->BAddressSubd,
            'city' => $businessInformationData->BAddressCity,
            'province' => $businessInformationData->BAddressProvince,
            'contact_number' => $businessInformationData->BAddressTelNo,
            'email_address' => $businessInformationData->BAddressEmail,
            'pin' => $businessInformationData->BusinessArea,
            'business_area' => $businessInformationData->BusinessArea,
            'number_of_employees' => $businessInformationData->TotalNumberofEmployees,
            'number_of_employees_in_lgu' => $businessInformationData->LGUEmployeeCount,
            'emergency_contact_person' => $businessInformationData->BusinessArea,
        ];

        $businessInfo = BusinessInformation::create($storeBusinessInfo);

        $storeOwnersInformation = [
            'business_id' => $business->id,
            'first_name' => $businessInformationData->taxPresidentFname,
            'middle_name' => $businessInformationData->taxPresidentMname,
            'last_name' => $businessInformationData->taxPresidentLname,
            'house_number' => $ownersInformationData->OAddressHouseNo,
            'street' => $ownersInformationData->OAddressStreet,
            'barangay' => $ownersInformationData->OAddressBarangay,
            'subdivision' => $ownersInformationData->OAddressSubd,
            'city' => $ownersInformationData->OAddressCity,
            'province' => $ownersInformationData->OAddressProvince,
            'contact_number' => $ownersInformationData->OAddressTelNo,
            'email_address' => $ownersInformationData->OAddressEmail,
        ];

        $ownerInformation = OwnerInformation::create($storeOwnersInformation);
        if (isset($lessorInformationData)) {
  
            $storeLessorInformation = [
                'business_id' => $business->id,
                'first_name' => $lessorInformationData->LessorFname,
                'middle_name' => $lessorInformationData->LessorMname,
                'last_name' => $lessorInformationData->LessorLname,
                'monthly_rental' => $lessorInformationData->LessorMonthlyRental,
                'house_number' => $lessorInformationData->LAddressHouseNo,
                'street' => $lessorInformationData->LAddressStreet,
                'barangay' => $lessorInformationData->LAddressBarangay,
                'subdivision' => $lessorInformationData->LAddressSubd,
                'city' => $lessorInformationData->LAddressCity,
                'province' => $lessorInformationData->LAddressProvince,
                'contact_number' => $lessorInformationData->LAddressTelNo,
                'email_address' => $lessorInformationData->LAddressEmail,
            ];
    
            $lessorInformation = LessorInformation::create($storeLessorInformation);
        }

        $barangay_clearance = null;
        $zoning_clearance = null;
        $sanitary_clearance = null;
        $occupancy_permit = null;
        $environment_certificate = null;
        $community_tax_certificate = null;
        $real_property_tax_clearance = null;
        $fire_certificate = null;
        foreach ($files as $key => $file) 
        {
            $extension = $file->getClientOriginalExtension();
            $filename = $key.'.'.$extension;
            $file->storeAs('/'.$businessData->referenceNo , $filename, 'requirements');
            
            switch ($key) {
                case 'barangay':
                    $barangay_clearance = $key;
                    break;
                case 'community':
                    $community_tax_certificate = $key;
                    break;
                case 'environment':
                    $environment_certificate = $key;
                    break;
                case 'occupancy':
                    $occupancy_permit = $key;
                    break;
                case 'rpt':
                    $real_property_tax_clearance = $key;
                    break;
                case 'zoning':
                    $zoning_clearance = $key;
                    break;
                default:
                    break;
            }
        }
        $storeBusinessFiles = [
            'business_id' => $business->id,
            'barangay_clearance' => $barangay_clearance, 
            'zoning_clearance' => $zoning_clearance, 
            'sanitary_clearance' => $sanitary_clearance, 
            'occupancy_permit' => $occupancy_permit, 
            'environment_certificate' => $environment_certificate, 
            'community_tax_certificate' => $community_tax_certificate, 
            'real_property_tax_clearance' => $real_property_tax_clearance, 
            'fire_certificate' => $fire_certificate, 
        ];
        $businessFiles = BusinessFiles::create($storeBusinessFiles);


        foreach ($businessInformationDetailData as $data) {
            $this->storeBusinessDetail($data, $business->id);
        }
        
    }

    public function storeBusinessDetail($data, $id)
    {
        $businessInformationDetailData = [
            'business_id' => $id,
            'code' => 'abc',
            'line_of_business' => $data->lineOfBusiness,
            'number_of_units' => $data->noOfUnits,
            'capitalization' => 20000,
            'essential' => 0.00,
            'non_essential' => 0.00,
        ];

        $businessInformationDetail = BusinessInformationDetail::create($businessInformationDetailData);
        
        return $businessInformationDetail;
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