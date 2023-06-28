<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TreasurerController extends Controller
{
    public function index()
    {
        return view('page.Treasurer.list');
    }
}
