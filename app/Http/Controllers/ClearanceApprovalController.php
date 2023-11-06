<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClearanceApprovalController extends Controller
{
    public function index()
    {
        return view('admin.ClearanceApproval.list');
    }
}
