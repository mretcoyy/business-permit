<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Eloquent\BusinessRepositoryEloquent;
use App\Services\Services\BusinessService;
use App\Transformers\BusinessTransformer;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.Report.list');
    }

    public function list(Request $request)
    {
        $filters =  (object) $request->get('filters');

        $business = app()->make(BusinessRepositoryEloquent::class)->list($filters);
        
        $business = fractal()->collection($business, BusinessTransformer::class);
        
        return $business;
    }

}
