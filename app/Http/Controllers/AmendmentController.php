<?php

namespace App\Http\Controllers;

use App\Services\Services\BusinessService;
use Illuminate\Http\Request;

class AmendmentController extends Controller
{
    public function index()
    {
        return view('admin.Amendment.list');
    }

    public function updateData(Request $request, BusinessService $service)
    {
        $files = [];
        if ($request->hasFile('file')) {
            $files = $request->file('file');
        }
        $data = $service->updateData($request->input('data'), $files, $request->input('business_id'));
    
        return $data;
    }
}
