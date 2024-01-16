<?php

namespace App\Http\Controllers;

use App\Entities\PassworReset;
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

        $rules =
        [
            'email' => 'required|unique:users,email',
            'contact_number' => 'numeric|min:11',
        ];
        $request->validate($rules);

        $store = $service->store($data);

        return $store;
    }

    public function update(Request $request, UserService $service)
    {
        $data = $request->all();

        $rules =
        [
            'email' => 'required|unique:users,email,' . $data['id'] . ',id,email,' . $data['email'],
            'contact_number' => 'numeric|min:11',
        ];
        $request->validate($rules);
        $store = $service->update($data);

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
        $user_id = $request->post('user_id');

        $store = $service->linkBusiness($user_id, $id);

        return $store;
    }

    public function forgotPassword(Request $request, UserService $service)
    {
        $email = $request->post('email');

        $forgot_password = $service->forgotPassword($email); 
        return $forgot_password;
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
    
    public function passwordReset(Request $request, UserService $service){
        $data = $service->passwordReset($request->all()); 
        return $data;
    }

    public function savePasswordReset(Request $request, UserService $service){
        $data = $service->savePasswordReset($request->all()); 
        return $data;
    }
}
