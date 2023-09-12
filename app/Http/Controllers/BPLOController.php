<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BPLOController extends Controller
{
    public function index()
    {
        return view('page.BPLO.list');
    }

    public function store(Request $request)
    {
        return $request->all();
    }

    public function view()
    {
        return;
    }
}
