<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\Services\UserService;
use App\Repositories\Eloquent\UserRepositoryEloquent;

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
            return json_encode(['user' => Auth::user()]);
        } else {
            return ['message' => 'loginError'];
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
    }

    public function register(Request $request, User $service)
    {
        $data = $request->all();

        $store = $service->store($data);

        return $store;
    }

    public function changeRole(Request $request, User $service)
    {
        $data = $request->post('filters');
        
        $userID = $data['user_id'];

        $store = $service->changeRole($data, $userID);

        return $store;
    }

    public function linkBusiness(Request $request, User $service)
    {
        $data = (object) $request->post('filters');

        $businessID = $data->business_id;
        $userID = $data->user_id;

        $store = $service->linkBusiness($businessID, $userID);

        return $store;
    }

    public function forgotPassword()
    {
        return;
    }

    public function changePassword()
    {
        return;
    }

    public function getUser()
    {
        return Auth::user();
    }

    // JAN NEW ROUTES

    public function viewDashboard(){
        return view('user.Dashboard.index');
    }

    public function viewApplication(){
        return view('user.Application.index');
    }

}
