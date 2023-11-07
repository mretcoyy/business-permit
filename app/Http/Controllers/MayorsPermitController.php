<?php

namespace App\Http\Controllers;

use App\Services\Services\BusinessService;
use Illuminate\Http\Request;

class MayorsPermitController extends Controller
{
    public function index()
    {
        return view('admin.MayorsPermit.list');
    }

    public function view(Request $request, BusinessService $service)
    {
        $data = $service->viewMayorsPermit($request->all());

        return $data;
    }
}
