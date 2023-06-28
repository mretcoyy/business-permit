<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EngineeringController extends Controller
{
    public function index()
    {
        return view('page.Engineering.list');
    }
}
