<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Services\BusinessService;
use Illuminate\Support\Facades\Log;
use App\Enums\BusinessStatus;

class EngineeringController extends Controller
{
    public function index()
    {
        return view('admin.Engineering.list');
    }

    public function changeStatus(Request $request, BusinessService $service, $id)
    {
        $changeStatus = $service->changeStatus($request->all(), BusinessStatus::SANITARY, $id);

        return $changeStatus;
    }
}
