<?php

namespace App\Services\Services;
use Illuminate\Support\Facades\Auth;
use App\Entities\User;
use App\Entities\Business;

class UserService implements UserServiceInterface
{

    public function changeRole($data, $id) 
    {

        $updateData = [
            'role' => $data['role']
        ];

        $user = User::find($id);
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