<?php

namespace App\Services\Contract;

interface UserServiceInterface
{
    public function store($data);
    public function changeRole($data, $userID);
    public function linkBusiness($businessID, $userID);
}
