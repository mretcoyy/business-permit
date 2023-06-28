<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MayorsOfficeController extends Controller
{
    public function index()
    {
        return view('page.MayorsOffice.list');
    }
}
