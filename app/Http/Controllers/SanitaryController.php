<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Services\BusinessService;
use Illuminate\Support\Facades\Log;
use App\Enums\BusinessStatus;

class SanitaryController extends Controller
{
    public function index()
    {
        return view('admin.Sanitary.list');
    }

    public function changeBusinessStatus(Request $request, BusinessService $service, $id)
    {
        $changeStatus = $service->changeBusinessStatus(BusinessStatus::TAXCOMPUTATION, $id);

        return $changeStatus;
    }
}
