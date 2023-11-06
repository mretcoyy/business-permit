<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MayorsPermitController extends Controller
{
    public function index()
    {
        return view('admin.MayorsPermit.list');
    }
}
