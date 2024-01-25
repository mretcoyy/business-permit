<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Eloquent\UserRepositoryEloquent;
use App\Enums\UserRole;
use App\Services\Services\BusinessService;

class AnnouncementController extends Controller
{
    public function index()
    {
        return view('admin.Announcements.list');
    }

    public function sendAnnouncement(Request $request, BusinessService $service)
    {
        ini_set('max_execution_time', -1);

        $message = $request->post('data');
        $filters->role = UserRole::USER;
        return $message;
        $userList = app()->make(UserRepositoryEloquent::class)->list($filters);

        $service = $service->sendAnnouncement($userList, $message);

        return $service;
    }
}
