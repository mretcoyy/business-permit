<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Services\BusinessService;
use Illuminate\Support\Facades\Log;
use App\Enums\BusinessStatus;

class MpdcController extends Controller
{
    public function index()
    {
        return view('admin.MpdcApproval.list');
    }

    public function changeStatus(Request $request, BusinessService $service, $id)
    {
        $changeStatus = $service->changeStatus($request->all(), BusinessStatus::ENGINEERING, $id);

        return $changeStatus;
    }
}
