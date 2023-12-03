<?php

namespace App\Http\Controllers;

use App\Entities\BusinessDetail;
use App\Entities\BusinessFees;
use App\Entities\User;
use App\Services\Services\BusinessService;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.Dashboard.list');
    }

    public function fetchData(BusinessService $service)
    {
        $result = $service->fetchData();
    
        return $result;
       
       
    }
}
