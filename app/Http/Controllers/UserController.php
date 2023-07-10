<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('page.User.login');
    }

    public function registration()
    {
        return view('page.User.register');
    }

    public function login()
    {
        return;
    }

    public function register()
    {
        return;
    }

    public function forgotPassword()
    {
        return;
    }

    public function changePassword()
    {
        return;
    }

}
