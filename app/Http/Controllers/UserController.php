<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\User;
use Illuminate\Support\Facades\Auth;

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
        if (Auth::attempt(['email' => $email, 'password' => $password, 'status' => 1])) {
            return json_encode($Auth::user());
        } else {
            return ['message' => 'Invalid Username or Password'];
        }
        
        return;
    }

    public function register(Request $request)
    {
        return $request->all();
        return User::create([
            'name' => $data,
            'email' => $data,
            'password' => $data
        ]);

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
