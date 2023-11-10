<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Services\BusinessService;

class BFPController extends Controller
{
    public function index()
    {
        return view('admin.Bfp.list');
    }

    public function changeBusinessStatus(Request $request, BusinessService $service, $id)
    {
        $status = $request->post('status') == BusinessStatus::APPROVED ? BusinessStatus::PAYMENT : BusinessStatus::DECLINED;

        $changeBusinessStatus = $service->changeBusinessStatus($status, $id);
        return $changeBusinessStatus;
    }
}
