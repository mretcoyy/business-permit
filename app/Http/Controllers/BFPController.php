<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BFPController extends Controller
{
    public function index()
    {
        return view('page.BFP.list');
    }
}
