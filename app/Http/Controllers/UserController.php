<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('page.User.login');
    }

    public function register()
    {
        return view('page.User.register');
    }
}
