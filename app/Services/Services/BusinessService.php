<?php

namespace App\Services\Services;

use App\Entities\AuditTrails;
use App\Entities\Business;
use App\Entities\BusinessDetail;
use App\Entities\BusinessFees;
use App\Entities\BusinessFiles;
use App\Entities\BusinessInformation;
use App\Entities\BusinessInformationDetail;
use App\Entities\LessorInformation;
use App\Entities\OwnerInformation;
use App\Entities\User;
use App\Enums\BusinessStatus;
use App\Enums\TypeOfOrganization;
use Carbon\Carbon;
use App\Services\Contract\BusinessServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Traits\StatusNotif;
use setasign\Fpdi\Tcpdf\Fpdi;

class BusinessService implements BusinessServiceInterface
{
    use StatusNotif;

    public function store($data_field, $files)
    {
        DB::beginTransaction();
        try {
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
            'type_of_organization' => (int)$businessData->typeOfOrganization,
            'is_tax_incentive' => (int)$businessData->hasTaxIncentive,
            'date_of_application' => Carbon::now(),
            'user_id' => $data->Admin ? null : Auth::user()->id,
        ];

        $business = Business::create($storeBusiness);
        
        $storeBusinessDetail = [
            'business_id' => $business->id,
            'bin' => '1234',
            'status' => BusinessStatus::NEW,
            'business_status' => BusinessStatus::BPLOAPPROVAL,
            'date_renewed' => $date,
        ];

        $businessDetail = BusinessDetail::create($storeBusinessDetail);

        $storeBusinessInfo = [
            'business_id' => $business->id,
            'first_name' => isset($businessInformationData->taxPayerLname) ? $businessInformationData->taxPayerLname : null,
            'middle_name' => isset($businessInformationData->taxPayerMname) ? $businessInformationData->taxPayerMname : null,
            'last_name' => isset($businessInformationData->taxPayerFname) ? $businessInformationData->taxPayerFname : null,
            'business_name' => isset($businessInformationData->taxPayerBname) ? $businessInformationData->taxPayerBname : null,
            'trade_name' => isset($businessInformationData->taxPayerTname) ? $businessInformationData->taxPayerTname : null,
            'business_number' => isset($businessInformationData->BAddressHouseNo) ? $businessInformationData->BAddressHouseNo : null,
            'building_name' => isset($businessInformationData->BAddressBuildingName) ? $businessInformationData->BAddressBuildingName : null,
            'unit_no' => isset($businessInformationData->BAddressUnitNo) ? $businessInformationData->BAddressUnitNo : null,
            'street' => isset($businessInformationData->BAddressStreet) ? $businessInformationData->BAddressStreet : null,
            'barangay' => isset($businessInformationData->BAddressBarangay) ? $businessInformationData->BAddressBarangay : null,
            'subdivision' => isset($businessInformationData->BAddressSubd) ? $businessInformationData->BAddressSubd : null,
            'city' => isset($businessInformationData->BAddressCity) ? $businessInformationData->BAddressCity : null,
            'province' => isset($businessInformationData->BAddressProvince) ? $businessInformationData->BAddressProvince : null,
            'contact_number' => isset($businessInformationData->BAddressTelNo) ? $businessInformationData->BAddressTelNo : null,
            'email_address' => isset($businessInformationData->BAddressEmail) ? $businessInformationData->BAddressEmail : null,
            'pin' => isset($businessInformationData->BusinessArea) ? $businessInformationData->BusinessArea : null,
            'business_area' => isset($businessInformationData->BusinessArea) ? $businessInformationData->BusinessArea : null,
            'number_of_employees' => isset($businessInformationData->TotalNumberofEmployees) ? $businessInformationData->TotalNumberofEmployees : 0,
            'number_of_employees_in_lgu' => isset($businessInformationData->LGUEmployeeCount) ? $businessInformationData->LGUEmployeeCount : 0,
            'emergency_contact_person' => $businessInformationData->BusinessArea,
        ];

        $businessInfo = BusinessInformation::create($storeBusinessInfo);

        $storeOwnersInformation = [
            'business_id' => $business->id,
            'first_name' => $businessInformationData->taxPresidentFname,
            'middle_name' => isset($businessInformationData->taxPresidentMname) ? $businessInformationData->taxPresidentMname : null,
            'last_name' => $businessInformationData->taxPresidentLname,
            'house_number' => isset($ownersInformationData->OAddressHouseNo) ? $ownersInformationData->OAddressHouseNo : null,
            'building_name' => isset($ownersInformationData->OAddressBuildingName) ? $ownersInformationData->OAddressBuildingName : null,
            'unit_no' => isset($ownersInformationData->OAddressUnitNo) ? $ownersInformationData->OAddressUnitNo : null,
            'street' => isset($ownersInformationData->OAddressStreet) ? $ownersInformationData->OAddressStreet : null,
            'barangay' => $ownersInformationData->OAddressBarangay,
            'subdivision' => isset($ownersInformationData->OAddressSubd) ? $ownersInformationData->OAddressSubd : null,
            'city' => $ownersInformationData->OAddressCity,
            'province' => $ownersInformationData->OAddressProvince,
            'contact_number' => $ownersInformationData->OAddressTelNo,
            'email_address' => $ownersInformationData->OAddressEmail,
        ];

        $ownerInformation = OwnerInformation::create($storeOwnersInformation);
        if (isset($lessorInformationData)) {
            if(isset($lessorInformationData->is_lessor) ? $lessorInformationData->is_lessor : false)
            {
                $storeLessorInformation = [
                    'business_id' => $business->id,
                    'first_name' => isset($lessorInformationData->LessorFname) ? $lessorInformationData->LessorFname : null,
                    'middle_name' => isset($lessorInformationData->LessorMname) ? $lessorInformationData->LessorMname : null,
                    'last_name' => isset($lessorInformationData->LessorLname) ? $lessorInformationData->LessorLname : null,
                    'monthly_rental' => isset($lessorInformationData->LessorMonthlyRental) ? $lessorInformationData->LessorMonthlyRental : null,
                    'house_number' => isset($lessorInformationData->LAddressHouseNo) ? $lessorInformationData->LAddressHouseNo : null,
                    'street' => isset($lessorInformationData->LAddressStreet) ? $lessorInformationData->LAddressStreet : null,
                    'barangay' => isset($lessorInformationData->LAddressBarangay) ? $lessorInformationData->LAddressBarangay : null,
                    'subdivision' => isset($lessorInformationData->LAddressSubd) ? $lessorInformationData->LAddressSubd : null,
                    'city' => isset($lessorInformationData->LAddressCity) ? $lessorInformationData->LAddressCity : null,
                    'province' => isset($lessorInformationData->LAddressProvince) ? $lessorInformationData->LAddressProvince : null,
                    'contact_number' => isset($lessorInformationData->LAddressTelNo) ? $lessorInformationData->LAddressTelNo : null,
                    'email_address' => isset($lessorInformationData->LAddressEmail) ? $lessorInformationData->LAddressEmail : null,
                ];
                $lessorInformation = LessorInformation::create($storeLessorInformation);
            }
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
            $filename = $business->id.$key.date('ymdhis').'.'.$extension;
            $file->storeAs('/'. $business->id , $filename, 'requirements');
            
            switch ($key) {
                case 'barangay':
                    $barangay_clearance = $filename;
                    break;
                case 'community':
                    $community_tax_certificate = $filename;
                    break;
                case 'environment':
                    $environment_certificate = $filename;
                    break;
                case 'occupancy':
                    $occupancy_permit = $filename;
                    break;
                case 'rpt':
                    $real_property_tax_clearance = $filename;
                    break;
                case 'zoning':
                    $zoning_clearance = $filename;
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

        AuditTrails::create([
            'type' => "NEW",
            'status' => 1,
            'business_id' => $business->id,
            'user_id' => Auth::user()->id,
        ]);

        foreach ($businessInformationDetailData as $data) {
            $this->storeBusinessDetail($data, $business->id);
        }
            DB::commit();
            return response()->json(['message' => 'Successfully Saved']);
        } catch (\Error $th) {
            DB::rollBack();
            return response()->json(['message' => $th->getMessage()], 422);
        }
    }

    public function storeBusinessDetail($data, $id)
    {
        $businessInformationDetailData = [
            'business_id' => $id,
            'code' => $data->code,
            'line_of_business' => $data->lineOfBusiness,
            'number_of_units' => $data->noOfUnits,
            'capitalization' => isset($data->capitalization) ? $data->capitalization : 0,
            'essential' => isset($data->essential) && is_numeric($data->essential) ? $data->essential : 0,
            'non_essential' => isset($data->non_essential) && is_numeric($data->essential) ? $data->non_essential : 0,
        ];

        $businessInformationDetail = BusinessInformationDetail::create($businessInformationDetailData);
        
        return $businessInformationDetail;
    }

    public function changeBusinessStatus($status, $id) 
    {
        $updateData = [
            'business_status' => $status
        ];

        $businessDetail = BusinessDetail::find($id);


        $business = Business::where('id',$id)->with(['businessDetail','businessInformation', 'businessInformationDetail'])->first();
        $business_detail =  $business->businessDetail;
        $user = User::find($business->user_id);
        if($user)
        {
            $bin = $business_detail[0]['bin'];
            $business_status = $business_detail[0]['business_status'];

            $type = ($status == 6 ? 'DECLINED': 'APPROVED');
            AuditTrails::create([
                'type' => $type,
                'status' => $businessDetail->business_status,
                'business_id' => $id,
                'user_id' => Auth::user()->id,
            ]);

            foreach ($business->businessInformation as $business_information) {
                $business_name = $business_information->business_name;
                $taxpayer = $business_information->fullname;
            }

            $email = $user->email;
         

            $email_data = [
                'fullname' => $taxpayer,
                'email' => $email,
                'business_name' => $business_name,
                'business_status' => $business_status,
                'bin' => $bin,
                'status' => $status,
                'type' => $type,
            ];
            
            if($user->contact_number != null)
            {
                if($this->isValidPhoneNumber($user->contact_number))
                {
                    $contact = "+63" . substr($user->contact_number, 1);
                    StatusNotif::smsNotif($contact, $email_data);
                }
            }
            StatusNotif::emailNotif($email, $email_data);
        }
        $businessDetail->update($updateData);

        return 1;
    }

    public function isValidPhoneNumber($phoneNumber) {
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
        if (strlen($phoneNumber) === 11) {
            return true;
        } else {
            return false;
        }
    }

    public function sendAnnouncement($message, $users)
    {
        foreach ($users as $user) {
            $user = (object) $user;
            if (isset($user->contact_number) && $this->isValidPhoneNumber($user->contact_number)) {
                $contact = "+63" . substr($user->contact_number, 1);
                StatusNotif::smsAnnouncement($contact, $message);
            }
        }

        return true;
    }

    public function changeStatus($id)
    {
        $updateData = [
            'status' => BusinessStatus::RENEW
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

    public function viewRequirement($data)
    {
        $r = $data['data'];
        $id = $r['business_file_id'];
        $column = $r['type'];
        $result = BusinessFiles::select('business_id',$column)->where('id', $id)->first();
        $filepath = $result->business_id.'/'.$result[$column];
        try {
          if (Storage::disk('requirements')->exists($filepath)) {
            return response(Storage::disk('requirements')->get($filepath), 200)->header('Content-Type', 'application/pdf');
          } else {
            return response()->json(['message' => 'File not Found', "status" => '422'], 422);
          }
        } catch (\Error $th) {
          return response()->json(['message' => $th->getMessage()], 422);
        }
    }

    public function updateData($data_field, $files, $id)
    {
        $data = json_decode($data_field);
        $businessData = $data->business;
        $businessInformationData = $data->businessInformation;
        $businessInformationDetailData = $data->BusinessActivity;
        $ownersInformationData = $data->ownerAddress;
        $lessorInformationData = $data->lessorInformation;
        $date = Carbon::now();
        $updateBusiness = [
            'reference_number' => $businessData->referenceNo,
            'dti_registration_no' => $businessData->dtiSecNo,
            'dti_date_of_registration' => $businessData->dtiSecdateofReg,
            'type_of_organization' => (int)$businessData->typeOfOrganization,
            'is_tax_incentive' => $businessData->isTaxIncentive,
            'user_id' => Auth::user()->id,
        ];

        $business = Business::find($id);
        $business->update($updateBusiness);

        
        $updateBusinessDetail = [
            'business_id' => $business->id,
            'bin' => '1234',
            'date_renewed' => $date,
        ];

        $businessDetail = $business->businessDetail()->update($updateBusinessDetail);

        $updateBusinessInfo = [
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
            'number_of_employees' => isset($businessInformationData->TotalNumberofEmployees) ? $businessInformationData->TotalNumberofEmployees : 0,
            'number_of_employees_in_lgu' => isset($businessInformationData->LGUEmployeeCount) ? $businessInformationData->LGUEmployeeCount : 0,
            'emergency_contact_person' => $businessInformationData->BusinessArea,
        ];
        $businessInformation = $business->businessInformation()->update($updateBusinessInfo);



        $updateOwnersInformation = [
            'business_id' => $business->id,
            'first_name' => $businessInformationData->taxPresidentFname,
            'middle_name' => $businessInformationData->taxPresidentMname,
            'last_name' => $businessInformationData->taxPresidentLname,
            'house_number' => $ownersInformationData->OAddressHouseNo,
            'building_name' => $ownersInformationData->OAddressBuildingName,
            'unit_no' => $ownersInformationData->OAddressUnitNo,
            'street' => $ownersInformationData->OAddressStreet,
            'barangay' => $ownersInformationData->OAddressBarangay,
            'subdivision' => $ownersInformationData->OAddressSubd,
            'city' => $ownersInformationData->OAddressCity,
            'province' => $ownersInformationData->OAddressProvince,
            'contact_number' => $ownersInformationData->OAddressTelNo,
            'email_address' => $ownersInformationData->OAddressEmail,
        ];

        $ownerInformation = $business->OwnerInformation()->update($updateOwnersInformation);

        if (isset($lessorInformationData)) {
  
            $updateLessorInformation = [
                'business_id' => $business->id,
                'first_name' => isset($lessorInformationData->LessorFname) ? $lessorInformationData->LessorFname : null,
                'middle_name' => isset($lessorInformationData->LessorMname) ? $lessorInformationData->LessorMname : null,
                'last_name' => isset($lessorInformationData->LessorLname) ? $lessorInformationData->LessorLname : null,
                'monthly_rental' => isset($lessorInformationData->LessorMonthlyRental) ? $lessorInformationData->LessorMonthlyRental : null,
                'house_number' => isset($lessorInformationData->LAddressHouseNo) ? $lessorInformationData->LAddressHouseNo : null,
                'street' => isset($lessorInformationData->LAddressStreet) ? $lessorInformationData->LAddressStreet : null,
                'barangay' => isset($lessorInformationData->LAddressBarangay) ? $lessorInformationData->LAddressBarangay : null,
                'subdivision' => isset($lessorInformationData->LAddressSubd) ? $lessorInformationData->LAddressSubd : null,
                'city' => isset($lessorInformationData->LAddressCity) ? $lessorInformationData->LAddressCity : null,
                'province' => isset($lessorInformationData->LAddressProvince) ? $lessorInformationData->LAddressProvince : null,
                'contact_number' => isset($lessorInformationData->LAddressTelNo) ? $lessorInformationData->LAddressTelNo : null,
                'email_address' => isset($lessorInformationData->LAddressEmail) ? $lessorInformationData->LAddressEmail : null,
            ];

            $lessorInformation = $business->lessorInformation()->update($updateLessorInformation);
        }

        $barangay_clearance = null;
        $zoning_clearance = null;
        $sanitary_clearance = null;
        $occupancy_permit = null;
        $environment_certificate = null;
        $community_tax_certificate = null;
        $real_property_tax_clearance = null;
        $fire_certificate = null;
        if(count($files))
        {
            foreach ($files as $key => $file) 
            {
                $filename = '';
                $extension = $file->getClientOriginalExtension();
                $filename = $business->id.$key.date('ymdhis').'.'.$extension;
                $file->storeAs('/'. $business->id , $filename, 'requirements');
                
                switch ($key) {
                    case 'barangay':
                        $barangay_clearance = $filename;
                        break;
                    case 'community':
                        $community_tax_certificate = $filename;
                        break;
                    case 'environment':
                        $environment_certificate = $filename;
                        break;
                    case 'occupancy':
                        $occupancy_permit = $filename;
                        break;
                    case 'rpt':
                        $real_property_tax_clearance = $filename;
                        break;
                    case 'zoning':
                        $zoning_clearance = $filename;
                        break;
                    default:
                        break;
                }
            }
        }
        if(count($business->businessFiles) == 0)
        {
            $updateBusinessFiles = [
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
       
            $businessFiles = BusinessFiles::create($updateBusinessFiles);
        }
        else{
            if($barangay_clearance != null)
            {
                $updateBusinessFiles = ['barangay_clearance'=>$barangay_clearance];
                $business->businessFiles()->update($updateBusinessFiles);
            }
            if($zoning_clearance != null)
            {
                $updateBusinessFiles = ['zoning_clearance'=>$zoning_clearance];
                $business->businessFiles()->update($updateBusinessFiles);
            }
            if($sanitary_clearance != null)
            {
                $updateBusinessFiles = ['sanitary_clearance'=>$sanitary_clearance];
                $business->businessFiles()->update($updateBusinessFiles);
            }
            if($occupancy_permit != null)
            {
                $updateBusinessFiles = ['occupancy_permit'=>$occupancy_permit];
                $business->businessFiles()->update($updateBusinessFiles);
            }
            if($environment_certificate != null)
            {
                $updateBusinessFiles = ['environment_certificate'=>$environment_certificate];
                $business->businessFiles()->update($updateBusinessFiles);
            }
            if($community_tax_certificate != null)
            {
                $updateBusinessFiles = ['community_tax_certificate'=>$community_tax_certificate];
                $business->businessFiles()->update($updateBusinessFiles);
            }
            if($real_property_tax_clearance != null)
            {
                $updateBusinessFiles = ['real_property_tax_clearance'=>$real_property_tax_clearance];
                $business->businessFiles()->update($updateBusinessFiles);
            }
            if($zoning_clearance != null)
            {
                $updateBusinessFiles = ['zoning_clearance'=>$zoning_clearance];
                $business->businessFiles()->update($updateBusinessFiles);
            }
        }

        if(count($business->BusinessInformationDetail) == 0)
        {
            foreach ($businessInformationDetailData as $data) {
                $this->storeBusinessDetail($data, $business->id);
            }
        }
        else{
            foreach ($businessInformationDetailData as $data) {
                $this->updateBusinessDetail($data, $business->id);
            }
        }
    }
    
    public function updateBusinessDetail($data, $id)
    {
        $businessInformationDetailData = [
            'business_id' => $id,
            'code' => $data->code,
            'line_of_business' => $data->lineOfBusiness,
            'number_of_units' => $data->noOfUnits,
            'capitalization' => isset($data->capitalization) ? $data->capitalization : 0,
            'essential' => isset($data->essential) ? $data->essential : 0,
            'non_essential' => isset($data->non_essential) ? $data->non_essential : 0,
        ];
        if(isset($data->id))
        {
            $businessDetail = BusinessInformationDetail::find($data->id);
            if($businessDetail)
            {
                $businessDetail->update($businessInformationDetailData);
            }else{
                BusinessInformationDetail::create($businessInformationDetailData);
            }
        }else{
            BusinessInformationDetail::create($businessInformationDetailData);
        }
       
        
        // return $businessInformationDetail;
    }

    public function updateGross($data, $id) 
    {
      $request =  $data['data'];
      foreach ($request as $datum) {
        $businessInformationDetailData = [
            'business_id' => $id,
            'code' => $datum['code'],
            'line_of_business' => $datum['lineOfBusiness'],
            'number_of_units' => $datum['noOfUnits'],
            'capitalization' => isset($datum['capitalization']) ? $datum['capitalization'] : 0,
            'essential' => isset($datum['essential']) ? $datum['essential'] : 0,
            'non_essential' => isset($datum['non_essential']) ? $datum['non_essential'] : 0,
        ];
        if(isset($datum['id']))
        {
            $businessDetail = BusinessInformationDetail::find($datum['id']);
            if($businessDetail)
            {
                $businessDetail->update($businessInformationDetailData);
            }else{
                BusinessInformationDetail::create($businessInformationDetailData);
            }
        }else{
            BusinessInformationDetail::create($businessInformationDetailData);
        }
      }
      return 'Success';
    }


    public function submitBusinessFees($data)
    {
        $buss_or_number = BusinessFees::where('or_number', $data['or_number'])->first();
        if($buss_or_number)
        {
            return response()->json(['message' => 'OR number already exists.'], 422);
        }
        else{
            $storeBusinessFees = [
                'business_id' => $data['business_id'],
                'payor' => $data['payor'], 
                'or_number' => $data['or_number'],
                'business_tax' => isset($data['business_tax']) ? $data['business_tax'] : 0,
                'mayors_permit' => isset($data['mayors_permit']) ? $data['mayors_permit'] : 0,
                'occupational_permit' => isset($data['occupational_permit']) ? $data['occupational_permit'] : 0,
                'subscription_other' => isset($data['subscription_other']) ? $data['subscription_other'] : 0,
                'environmental_clearance' => isset($data['environmental_clearance']) ? $data['environmental_clearance'] : 0,
                'sanitary_permit_fee' => isset($data['sanitary_permit_fee']) ? $data['sanitary_permit_fee'] : 0,
                'zoning_fee' => isset($data['zoning_fee']) ? $data['zoning_fee'] : 0,
                'total_fee' => $data['total_fee'],
                // 'user_id' => $data->user_id,
                // 'status' => $data->status,
            ];
    
            $business = BusinessFees::create($storeBusinessFees);
    
            $this->changeBusinessStatus(BusinessStatus::MAYORSPERMIT, $data['business_id']);
    
            return $business;
        }
    }

    public function viewMayorsPermit($data)
    {
        $business = Business::where('id',$data['filters']['business_id'])->with(['businessDetail','businessInformation', 'businessInformationDetail'])->first();

        $filename = '';
        $business_detail =  $business->businessDetail;
        $bin = $business_detail[0]['bin'];
        $filename =  $bin.Date('YmdHis').'.pdf';
        foreach ($business->businessInformation as $business_information) {
            $business_name = $business_information->business_name;
            $taxpayer = $business_information->fullname;
            $business_address = $business_information->address;
        }
        $line_of_business = $business->businessInformationDetail[0]->line_of_business;
        $date_issued = Date('m/d/Y');
        $valid_until = '12/31/'.Date('Y');

        $pdf = new Fpdi();
        $pagesource = $pdf->setSourceFile(public_path("pdf/BUSINESS_PERMIT.pdf"));
        $pageimport = $pdf->importPage($pagesource);
        $pdf->AddPage();
        $pdf->useTemplate($pageimport, null, null, 215.6, 297 ,FALSE);
        $pdf->SetHeaderMargin(0);
        $pdf->SetFooterMargin(0);
        $pdf->MultiCell(40, 0, $bin, '', 'C', 0, 0, 26, 168, true, 0, false, true, 8, 'M', true);
        $pdf->MultiCell(40, 0, $date_issued, '', 'C', 0, 0, 26, 178, true, 0, false, true, 8, 'M', true);
        $pdf->MultiCell(40, 0, $valid_until, '', 'C', 0, 0, 26, 188, true, 0, false, true, 8, 'M', true);

        $pdf->MultiCell(110, 0, $taxpayer, '', 'L', 0, 0, 80, 135, true, 0, false, true, 8, 'M', true);
        $pdf->MultiCell(110, 0, $line_of_business, '', 'L', 0, 0, 80, 150, true, 0, false, true, 8, 'M', true);
        $pdf->MultiCell(110, 0, $business_address, '', 'L', 0, 0, 80, 165, true, 0, false, true, 8, 'M', true);
        $pdf->MultiCell(110, 0, $taxpayer, '', 'L', 0, 0, 80, 180, true, 0, false, true, 8, 'M', true);


        $style = array(
            'border' => 0,
            'vpadding' => 'auto',
            'hpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => false, //array(255,255,255)
            'module_width' => 1, // width of a single module in points
            'module_height' => 1 // height of a single module in points
        );
        
        //barcode
        $pdf->write2DBarcode( $bin.'/'.$date_issued.'/'.$valid_until, 'QRCODE,L',24,123, 45, 45, $style, 'N');

        $pdf->Output($filename, 'I');
        return $pdf;
    }

    public function viewFeesForm($data)
    {
        $d = $data['data'];
        $f = $data['fees'];
        $filename = $d['bin'].Date('YmdHis');
        
        $pdf = new Fpdi();
        $pagesource = $pdf->setSourceFile(public_path("pdf/rec.pdf"));
        $pageimport = $pdf->importPage($pagesource);
        $pdf->AddPage();
        $pdf->useTemplate($pageimport, null, null, 215.6, 297 ,FALSE);
        $pdf->SetHeaderMargin(0);
        $pdf->SetFooterMargin(0);

        $business_tax = ((isset($f['business_tax']) && is_numeric($f['business_tax'])) ? number_format($f['business_tax'],2) : "0.00");
        $mayors_permit = ((isset($f['mayors_permit']) && is_numeric($f['mayors_permit'])) ? number_format($f['mayors_permit'], 2) : "0.00");
        $occupational_permit = ((isset($f['occupational_permit']) && is_numeric($f['occupational_permit'])) ? number_format($f['occupational_permit'], 2) : "0.00");
        $subscription_other = ((isset($f['subscription_other']) && is_numeric($f['subscription_other'])) ? number_format($f['subscription_other'], 2) : "0.00");
        $environmental_clearance = ((isset($f['environmental_clearance']) && is_numeric($f['environmental_clearance'])) ? number_format($f['environmental_clearance'], 2) : "0.00");
        $sanitary_permit_fee = ((isset($f['sanitary_permit_fee']) && is_numeric($f['sanitary_permit_fee'])) ? number_format($f['sanitary_permit_fee'], 2) : "0.00");
        $zoning_fee = ((isset($f['zoning_fee']) && is_numeric($f['zoning_fee'])) ? number_format($f['zoning_fee'], 2) : "0.00");
        $total_fee = ((isset($f['total_fee']) && is_numeric($f['total_fee'])) ? number_format($f['total_fee'], 2) : "0.00");
                

        // $pdf->Text(17,58 , 'City Government of Dolores');
        // $pdf->Text(77,58, 'Gr A');

        $payor = $f['payor'];
        $x = 0;
        $y = 5;
        $label_y = 0;

        $pdf->SetFont(''   , '', 23, '', 'false');
        $or_number = ($f['or_number'] == null ? '0' : $f['or_number']);
        $pdf->MultiCell(68,7, $or_number."\n", 0, 'R', 0, 1,15 + $x, 28 + $y, true, 0, false, true, 20, 'M', true);
   
        $pdf->SetFont(''   , '', 12, '', 'false');
        $pdf->Text(55,49 +$y , date('Y-m-d'));
        $pdf->SetFont(''   , '', 12, '', 'false');
        $pdf->setCellPaddings(2, 4, 6, 8);
        $txt = ($payor == null ? '0' : $payor);
        $pdf->MultiCell(70,10, $txt."\n", 0, 'L', 0, 1,15 + $x, 59 + $y, true, 0, false, true, 20, 'M', true);

        $pdf->Text(5,81  + $label_y, 'Business Tax');
        $pdf->setCellPaddings(2, 4, 6, 8);
        $txt =($business_tax == null ? '0' : $business_tax);
        $pdf->MultiCell(68,7, $txt."\n", 0, 'R', 0, 1,32 + $x, 77 + $y, true, 0, false, true, 20, 'M', true);

        $pdf->Text(5,87 + $label_y , 'Mayors Permit');
        $pdf->setCellPaddings(2, 4, 6, 8);
        $txt =($mayors_permit == null ? '0' : $mayors_permit);
        $pdf->MultiCell(68,7, $txt."\n", 0, 'R', 0, 1,32 + $x, 82 + $y, true, 0, false, true, 20, 'M', true);

        $pdf->Text(5,92  + $label_y, 'Occupational Permit');
        $pdf->setCellPaddings(2, 4, 6, 8);
        $txt =($occupational_permit == null ? '0' : $occupational_permit);
        $pdf->MultiCell(70,7, $txt."\n", 0, 'R', 0, 1,30 + $x, 88 + $y, true, 0, false, true, 20, 'M', true);

        $pdf->Text(5,98 + $label_y , 'Subscription and Other Fees');
        $pdf->setCellPaddings(2, 4, 6, 8);
        $txt =($subscription_other == null ? '0' : $subscription_other);
        $pdf->MultiCell(55,7, $txt."\n", 0, 'R', 0, 1, 45 + $x, 95 + $y, true, 0, false, true, 20, 'M', true);


        $pdf->Text(5,104  + $label_y, 'Environmental Clearance');
        $pdf->setCellPaddings(2, 4, 6, 8);
        $txt = ($environmental_clearance == null ? '0' : $environmental_clearance);
        $pdf->MultiCell(50,7, $txt."\n", 0, 'R', 0, 1,50 + $x, 100 + $y, true, 0, false, true, 20, 'M', true);

        $pdf->Text(5,110  + $label_y, 'Sanitary Fee');
        $pdf->setCellPaddings(2, 4, 6, 8);
        $txt = ($sanitary_permit_fee == null ? '0' : $sanitary_permit_fee);
        $pdf->MultiCell(68,7, $txt."\n", 0, 'R', 0, 1,32 + $x, 105 + $y, true, 0, false, true, 21, 'M', true);

        $pdf->Text(5,115 + $label_y , 'Zoning Fee');
        $pdf->setCellPaddings(2, 4, 6, 8);
        $txt = ($zoning_fee == null ? '0' : $zoning_fee);
        $pdf->MultiCell(70,7, $txt."\n", 0, 'R', 0, 1,30 + $x, 110 + $y, true, 0, false, true, 21, 'M', true);

        $pdf->Text(7, 143 + $y , 'x');

        $pdf->Text(6,167 + $y, ($f['or_number'] == null ? '0' : $f['or_number']));
        $pdf->Text(5,172 + $y, 'BIN: ' .$d['bin']);

        $pdf->setCellPaddings(2, 4, 6, 8);
        $txt = ($total_fee == null ? '0' : $total_fee);
        $pdf->MultiCell(40,7, $txt."\n", 0, 'R', 0, 1,60 + $x, 123 + $y, true, 0, false, true, 21, 'M', true);

        $pdf->setCellPaddings(2, 4, 6, 8);
        $txt = ucwords($this->numberToWordsWithCentsInPesos( str_replace(',', '', $total_fee)));
        $pdf->MultiCell(60,20, $txt."\n", 0, 'L', 0, 1,35 + $x, 132 + $y, true, 0, false, true, 24, 'M', true);

        $pdf->Text(42,161, '');
        // $pdf->Text(42,165 , 'CITY TREASURER');


        $pdf->Output($filename, 'I');
        return $pdf;
    }


    private function numberToWords($number) {
        $words = array(
            0 => 'Zero',
            1 => 'One',
            2 => 'Two',
            3 => 'Three',
            4 => 'Four',
            5 => 'Five',
            6 => 'Six',
            7 => 'Seven',
            8 => 'Eight',
            9 => 'Nine',
            10 => 'Ten',
            11 => 'Eleven',
            12 => 'Twelve',
            13 => 'Thirteen',
            14 => 'Fourteen',
            15 => 'Fifteen',
            16 => 'Sixteen',
            17 => 'Seventeen',
            18 => 'Eighteen',
            19 => 'Nineteen',
            20 => 'Twenty',
            30 => 'Thirty',
            40 => 'Forty',
            50 => 'Fifty',
            60 => 'Sixty',
            70 => 'Seventy',
            80 => 'Eighty',
            90 => 'Ninety'
        );

        if ($number < 20) {
            return $words[$number];
        }

        if ($number < 100) {
            $tens = $words[floor($number / 10) * 10];
            $units = $number % 10;
            return $tens . ($units > 0 ? '-' . $words[$units] : '');
        }

        if ($number < 1000) {
            $hundreds = $words[floor($number / 100)] . ' Hundred';
            $remainder = $number % 100;
            return $hundreds . ($remainder > 0 ? ' and ' . $this->numberToWords($remainder) : '');
        }

        if ($number < 1000000) {
            $thousands = $this->numberToWords(floor($number / 1000)) . ' Thousand';
            $remainder = $number % 1000;
            return $thousands . ($remainder > 0 ? ' ' . $this->numberToWords($remainder) : '');
        }

        if ($number < 1000000000) {
            $millions = $this->numberToWords(floor($number / 1000000)) . ' Million';
            $remainder = $number % 1000000;
            return $millions . ($remainder > 0 ? ' ' . $this->numberToWords($remainder) : '');
        }
        
        // Continue the pattern for millions and larger numbers...

        return 'Out of range';
    }

    private function numberToWordsWithCentsInPesos($number) {

        $wholePart = floor($number);
        $decimalPart = round(($number - $wholePart) * 100);

        $result = $this->numberToWords($wholePart) . ' ' . ($wholePart === 1 ? 'Peso' : 'Pesos');

        if ($decimalPart > 0) {
            $result .= ' and ' . $this->numberToWords($decimalPart) . ' ' . ($decimalPart === 1 ? 'Centavo' : 'Centavos');
        }

        return $result;
    }

    public function fetchData(){
         
        $result = [];
        $total_income_generated = BusinessFees::whereYear('created_at', Date('Y'))->sum('total_fee');
        $total_funds = BusinessFees::whereYear('created_at', Date('Y'))->sum('business_tax');
        $total_number_applicants = User::where('role' , 2)->whereYear('created_at', Date('Y'))->count();
        $number_pending_applicants = BusinessDetail::where('business_status', 10)->whereYear('created_at', Date('Y'))->count();
        $number_renewals = BusinessDetail::where('status', 2)->whereYear('created_at', Date('Y'))->count();
        $number_pending_renewals = BusinessDetail::where('status', 2)->where('business_status', 10)->whereYear('created_at', Date('Y'))->count();
        $number_of_accounts = User::count();
        // $number_of_accounts = BusinessDetail::whereYear('created_at', Date('Y'))->where('business_status','>', 10)
        // ->orWhere('business_status','<', 17)
        // ->count();
        $number_approved_applications = BusinessDetail::whereYear('created_at', Date('Y'))->where('business_status','>', 10)
        ->count();


        $jan = AuditTrails::where('type', 'NEW')->whereMonth('created_at', 1)->whereYear('created_at', Date('Y'))->count();
        $feb = AuditTrails::where('type', 'NEW')->whereMonth('created_at', 2)->whereYear('created_at', Date('Y'))->count();
        $mar = AuditTrails::where('type', 'NEW')->whereMonth('created_at', 3)->whereYear('created_at', Date('Y'))->count();
        $apr = AuditTrails::where('type', 'NEW')->whereMonth('created_at', 4)->whereYear('created_at', Date('Y'))->count();
        $may = AuditTrails::where('type', 'NEW')->whereMonth('created_at', 5)->whereYear('created_at', Date('Y'))->count();
        $jun = AuditTrails::where('type', 'NEW')->whereMonth('created_at', 6)->whereYear('created_at', Date('Y'))->count();
        $jul = AuditTrails::where('type', 'NEW')->whereMonth('created_at', 7)->whereYear('created_at', Date('Y'))->count();
        $aug = AuditTrails::where('type', 'NEW')->whereMonth('created_at', 8)->whereYear('created_at', Date('Y'))->count();
        $sep = AuditTrails::where('type', 'NEW')->whereMonth('created_at', 9)->whereYear('created_at', Date('Y'))->count();
        $oct = AuditTrails::where('type', 'NEW')->whereMonth('created_at', 10)->whereYear('created_at', Date('Y'))->count();
        $nov = AuditTrails::where('type', 'NEW')->whereMonth('created_at', 11)->whereYear('created_at', Date('Y'))->count();
        $dec = AuditTrails::where('type', 'NEW')->whereMonth('created_at', 12)->whereYear('created_at', Date('Y'))->count();

        $graph = [
            $jan,$feb,$mar,$apr,$may,$jun,$jul,$aug,$sep,$oct,$nov,$dec
        ];
     
        $result = [
            'total_income_generated' => number_format($total_income_generated, 2),
            'total_funds' => number_format($total_funds, 2),
            'total_number_applicants' => $total_number_applicants,
            'number_pending_applicants' => $number_pending_applicants,
            'number_renewals' => $number_renewals,
            'number_of_accounts' => $number_of_accounts,
            'number_pending_renewals' => $number_pending_renewals,
            'number_approved_applications' => $number_approved_applications,
            'graph' => $graph
        ];

        return $result;
    }
}