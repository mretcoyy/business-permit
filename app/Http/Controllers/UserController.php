<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    public function login(Request $request)
    {
        $data = $request->all();

        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password'], 'status' => 1])) {
            return json_encode(Auth::user());
        } else {
            return ['message' => 'Invalid Username '.$data['email'].' or Password '.$data['password']];
        }
    }

    public function register(Request $request)
    {
        $data = $request->all();

        return User::create([
            'name' => $data['fullName'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
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
