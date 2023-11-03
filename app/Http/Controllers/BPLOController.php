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
        $files = [];
        if ($request->hasFile('file')) {
            $files = $request->file('file');
        }
        $store = $service->store($request->input('data'), $files);

        return $store;
    }

    public function list(Request $request)
    {
        $filters = (object) $request->get('filters');

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
