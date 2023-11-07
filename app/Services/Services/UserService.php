<?php

namespace App\Services\Services;
use Illuminate\Support\Facades\Auth;
use App\Entities\User;
use App\Entities\Business;
use App\Services\Contract\UserServiceInterface;

class UserService implements UserServiceInterface
{

    public function store($data)
    {
        $user = User::create([
            'name' => $data['fullName'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return $user;
    }

    public function changeRole($data, $userID) 
    {

        $updateData = [
            'role' => $data['role']
        ];

        $user = User::find($userID);
        $user->update($updateData);

        return $user;
    }

    public function linkBusiness($businessID, $userID) 
    {

        $updateData = [
            'user_id' => $userID
        ];

        $business = Business::find($businessID);
        $business->update($updateData);

        return $business;
    }
}