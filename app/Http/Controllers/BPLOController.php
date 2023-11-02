<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Services\BusinessService;
use App\Repositories\Eloquent\BusinessRepositoryEloquent;
use App\Transformers\BusinessTransformer;

class BPLOController extends Controller
{
    public function index()
    {
        return view('page.BPLO.list');
    }

    public function store(Request $request, BusinessService $service)
    {
        $store = $service->store($request->all());

        return $store;
    }

    public function list(Request $request)
    {
        $business = app()->make(BusinessRepositoryEloquent::class)->list($filters = []);
        
        $business = fractal()->collection($business, BusinessTransformer::class);
        
        return $business;
    }

    public function changeStatus(Request $request, $id)
    {
        $changeStatus = $service->changeStatus($request->all(), $id);

        return $changeStatus;
    }
}
