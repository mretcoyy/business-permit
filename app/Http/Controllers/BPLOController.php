<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BPLOController extends Controller
{
    public function index()
    {
        return view('page.BPLO.list');
    }
}
