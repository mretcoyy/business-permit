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

    public function changeBusinessStatus(Request $request, BusinessService $service, $id)
    {
        $status = $request->post('status') == BusinessStatus::APPROVED ? BusinessStatus::ENGINEERING : BusinessStatus::DECLINED;

        $changeBusinessStatus = $service->changeBusinessStatus($status, $id);
        return $changeBusinessStatus;
    }
}
