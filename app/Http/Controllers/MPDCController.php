<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MPDCController extends Controller
{
    public function index()
    {
        return view('page.MPDC.list');
    }
}
