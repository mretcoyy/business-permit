<?php

namespace App\Services\Services;

use App\Entities\Business;
use App\Entities\BusinessDetail;
use App\Entities\BusinessFees;
use App\Entities\BusinessFiles;
use App\Entities\BusinessInformation;
use App\Entities\BusinessInformationDetail;
use App\Entities\LessorInformation;
use App\Entities\OwnerInformation;
use App\Enums\BusinessStatus;
use App\Enums\TypeOfOrganization;
use Carbon\Carbon;
use App\Services\Contract\BusinessServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Tcpdf\Fpdi;
class BusinessService implements BusinessServiceInterface
{

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
        $businessDetail->update($updateData);

        return $businessDetail;
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
        
        $date_issued = Date('M/d/Y');
        $pdf = new Fpdi();
        $pdf->AddPage();
        $pdf->SetHeaderMargin(0);
        $pdf->SetFooterMargin(0);
      
        $html = '';
        $html .= '<table border="0" cellspacing="0" cellpadding="3" >
                    <tr>
                        <td colspan="2" style="text-align:center; font-weight:bold">BUSINESS FEES</td>
                    </tr>
                    <tr>
                        <td colspan="2" >BIN: '.$d['bin'].'</td>
                        <td colspan="2" >Date Issued: '.$date_issued.'</td>
                    </tr>
                    <tr>
                        <td >Business Name: '.$d['business_name'].'</td>
                        <td >Business Address: '.$d['business_address'].'</td>
                    </tr>
                    <tr>
                        <td >Owners Name: '.$d['owner_name'].'</td>
                        <td >Owners Address: '.$d['owner_address'].'</td>
                    </tr>
                    <tr>
                        <td >Number of Employees: '.$d['number_of_employees'].'</td>
                        <td >OR number: '.$f['or_number'].'</td>
                    </tr>
                    <tr>
                        <td colspan="2" ></td>
                    </tr>

        </table>
        ';
                        // <td align="right">'.!empty($f['business_tax']) ? $f['business_tax'] : 0.00.'</td>

        $html .= '
                <div style="display:flex; align-items:center; justify-content:center">
                <table border="1" cellspacing="0" cellpadding="3" style="border:black  1px; width:60%">
                    <tr style="border:0">
                        <td >Business Tax:</td>
                        <td align="right">'.((isset($f['business_tax']) && is_numeric($f['business_tax'])) ? number_format($f['business_tax'],2) : "0.00").'</td>
                    </tr>
                    <tr style="border:0">
                        <td >Mayors Permit:</td>
                        <td align="right">'.((isset($f['mayors_permit']) && is_numeric($f['mayors_permit'])) ? number_format($f['mayors_permit'], 2) : "0.00").'</td>
                    </tr>
                    <tr style="border:0">
                        <td >Occupational Permit</td>
                        <td align="right">'.((isset($f['occupational_permit']) && is_numeric($f['occupational_permit'])) ? number_format($f['occupational_permit'], 2) : "0.00").'</td>
                    </tr>
                    <tr style="border:0">
                        <td >Subscription and Others</td>
                        <td align="right">'.((isset($f['subscription_other']) && is_numeric($f['subscription_other'])) ? number_format($f['subscription_other'], 2) : "0.00").'</td>
                    </tr>
                    <tr style="border:0">
                        <td >Environmental Clearance</td>
                        <td align="right">'.((isset($f['environmental_clearance']) && is_numeric($f['environmental_clearance'])) ? number_format($f['environmental_clearance'], 2) : "0.00").'</td>
                    </tr>
                    <tr>
                        <td >Sanitary Permit Fee</td>
                        <td align="right">'.((isset($f['sanitary_permit_fee']) && is_numeric($f['sanitary_permit_fee'])) ? number_format($f['sanitary_permit_fee'], 2) : "0.00").'</td>
                    </tr>
                    <tr style="border:0">
                        <td >Zoning Fee</td>
                        <td align="right">'.((isset($f['zoning_fee']) && is_numeric($f['zoning_fee'])) ? number_format($f['zoning_fee'], 2) : "0.00").'</td>
                    </tr>
                    <tr style="border:0">
                        <td >Total Fee</td>
                        <td align="right">'.((isset($f['total_fee']) && is_numeric($f['total_fee'])) ? number_format($f['total_fee'], 2) : "0.00").'</td>
                    </tr>
                </table>
                </div>
        ';
        $pdf->writeHTML($html, true, false, true, false, '');

      
        // business_tax
        // mayors_permit
        // occupational_permit
        // subscription_other
        // environmental_clearance
        // sanitary_permit_fee
        // zoning_fee
        // total_fee

        $pdf->Output($filename, 'I');
        return $pdf;
    }
    
}