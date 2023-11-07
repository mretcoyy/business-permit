<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\Services\UserService;
use App\Repositories\Eloquent\UserRepositoryEloquent;
use App\Transformers\UserTransformer;

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

    public function list(Request $request)
    {
        $filters =  (object) $request->get('filters');

        $userList = app()->make(UserRepositoryEloquent::class)->list($filters);
        
        // $userList = fractal()->collection($userList, UserTransformer::class);

        return $userList;
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

    public function register(Request $request, UserService $service)
    {
        $data = $request->all();

        $store = $service->store($data);

        return $store;
    }

    public function changeRole(Request $request, $id, UserService $service)
    {
        $data = $request->post('role');

        $store = $service->changeRole($data, $id);

        return $store;
    }

    public function linkBusiness(Request $request, $id, UserService $service)
    {
        $businessID = $request->post('business_id');

        $store = $service->linkBusiness($businessID, $id);

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
 
    public function viewUserManagement(){
        return view('admin.UserManagement.list');
    }


}
