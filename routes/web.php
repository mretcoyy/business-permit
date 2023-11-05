<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BPLOController;
use App\Http\Controllers\BFPController;
use App\Http\Controllers\MayorsOfficeController;
use App\Http\Controllers\MENROController;
use App\Http\Controllers\MPDCController;
use App\Http\Controllers\EngineeringController;
use App\Http\Controllers\SanitaryController;
use App\Http\Controllers\BPLOReleasingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/application', function () {
//     return view('page.BPLO.list');
// });
//Universal
Route::get('/login', 'UserController@index');

Route::get('/admin/dashboard', function () {
    return view('admin.Dashboard.list');
});

Route::get('/', 'UserController@index');

//Business Owner
Route::get('/register', 'UserController@registration');
Route::post('/user/login', 'UserController@login');
Route::post('/user/store', 'UserController@register');
Route::post('/user/logout', 'UserController@logout');
Route::get('/user/get-user', 'UserController@getUser');

Route::middleware(['role:Admin,User'])->group(function () {
    Route::get('/user/dashboard', 'UserController@viewDashboard');
    Route::get('/user/application', 'UserController@viewApplication');
    Route::get('/business-form', 'UserBusinessController@index');
    Route::get('/bplo/list', 'BPLOController@list');
    Route::post('/bplo/view-requirement', 'BPLOController@viewRequirement');
});

Route::middleware(['role:Admin'])->group(function () {
//BPLO
Route::get('/bplo', 'BPLOController@index');
Route::post('/bplo/store', 'BPLOController@store');
//APPROVAL
Route::patch('/bplo/changeStatus/{id}', 'BPLOController@changeStatus');
Route::patch('/bplo/update-gross/{id}', 'BPLOController@updateGross');

//APPROVAL
Route::get('/admin/certificate-approval', 'CertificateApprovalController@index');
Route::get('/admin/clearance-approval', 'ClearanceApprovalController@index');

//AMENDMENT
Route::get('/admin/amendment', 'AmendmentController@index');
Route::post('/amendment/update-data', 'AmendmentController@updateData');

Route::get('/menro', 'MENROController@index');
Route::get('/mpdc', 'MPDCController@index');
Route::get('/engineering', 'EngineeringController@index');
Route::get('/sanitary', 'SanitaryController@index');
Route::get('/treasurer', 'TreasurerController@index');
Route::get('/bfp', 'BFPController@index');
Route::get('/mayors-office', 'MayorsOfficeController@index');
Route::get('/bplo-releasing', 'BPLOReleasingController@index');

// Application
Route::get('/admin/application', 'Application@index');
});