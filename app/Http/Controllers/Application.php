<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Application extends Controller
{
    public function index()
    {
        return view('page.Application.list');
    }
}
