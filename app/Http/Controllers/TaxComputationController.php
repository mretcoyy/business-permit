<?php

namespace App\Http\Controllers;

use App\Services\Services\BusinessService;
use Illuminate\Http\Request;

class TaxComputationController extends Controller
{
    public function index()
    {
        return view('admin.TaxComputation.list');
    }

    public function store(Request $request, BusinessService $service)
    {
      
        $store = $service->submitBusinessFees($request->all());

        return $store;
    }
}
