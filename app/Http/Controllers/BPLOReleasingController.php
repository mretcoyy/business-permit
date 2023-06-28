<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BPLOReleasingController extends Controller
{
    public function index()
    {
        return view('page.BPLOReleasing.list');
    }
}
