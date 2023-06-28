<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MENROController extends Controller
{
    public function index()
    {
        return view('page.MENRO.list');
    }
}
