<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Services\BusinessService;
use App\Repositories\Eloquent\BusinessRepositoryEloquent;
use App\Transformers\BusinessTransformer;
use Illuminate\Support\Facades\Log;
use App\Enums\BusinessStatus;

class BPLOController extends Controller
{
    public function index()
    {
        return view('page.BPLO.list');
    }

    public function store(Request $request, BusinessService $service)
    {
        $files = [];
        if ($request->hasFile('file')) {
            $files = $request->file('file');
        }
        $store = $service->store($request->input('data'), $files);

        return $store;
    }

    public function list(Request $request)
    {
        $filters =  (object) $request->get('filters');

        $business = app()->make(BusinessRepositoryEloquent::class)->list($filters);
        
        $business = fractal()->collection($business, BusinessTransformer::class);
        
        return $business;
    }

    public function changeStatus(Request $request)
    {
        $changeStatus = $service->changeStatus($id);

        return $changeStatus;
    }

    public function changeBusinessStatus(Request $request, BusinessService $service, $id)
    {
        $status = $request->post('status') == BusinessStatus::APPROVED ? BusinessStatus::MENRO : BusinessStatus::DECLINED;

        $changeBusinessStatus = $service->changeBusinessStatus($status, $id);
        return $changeBusinessStatus;
    }

    public function viewRequirement(Request $request, BusinessService $service)
    {
        $requirement = $service->viewRequirement($request->all());

        return $requirement;
    }

    public function updateGross(Request $request,BusinessService $service, $id)
    {
        $updateGross = $service->updateGross($request->all(), $id);

        return $updateGross;
    }
}
