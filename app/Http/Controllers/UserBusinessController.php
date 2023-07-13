<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserBusinessController extends Controller
{
    public function index()
    {
        return view('page.UserBusiness.list');
    }
}
