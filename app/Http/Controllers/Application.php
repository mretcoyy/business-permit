<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Application extends Controller
{
    public function index()
    {
        return view('admin.Application.list');
    }

    public function viewNewApplication()
    {
        return view('admin.NewApplication.list');
    }
}
