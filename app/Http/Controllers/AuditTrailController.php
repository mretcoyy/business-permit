<?php

namespace App\Http\Controllers;

use App\Repositories\Eloquent\AuditTrailsRepositoryEloquent;
use Illuminate\Http\Request;
use App\Transformers\AuditTrailTransformer;

class AuditTrailController extends Controller
{
    public function index()
    {
        return view('admin.AuditTrail.list');
    }

    public function list(Request $request)
    {
        $filters =  (object) $request->get('filters');

        $business = app()->make(AuditTrailsRepositoryEloquent::class)->list($filters);
        
        $business = fractal()->collection($business, AuditTrailTransformer::class);
        
        return $business;
    }

}
