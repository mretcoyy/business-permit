<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AmendmentController extends Controller
{
    public function index()
    {
        return view('page.Amendment.list');
    }
}
