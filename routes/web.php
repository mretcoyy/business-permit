<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BPLOController;
use App\Http\Controllers\BFPController;
use App\Http\Controllers\MayorsOfficeController;
use App\Http\Controllers\MenroController;
use App\Http\Controllers\MpdcController;
use App\Http\Controllers\EngineeringController;
use App\Http\Controllers\SanitaryController;
use App\Http\Controllers\BPLOReleasingController;
use App\Http\Controllers\AdminDashboardController;

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

// Route::get('/admin/dashboard', function () {
//     return view('admin.Dashboard.list');
// });

Route::get('/admin/dashboard', 'AdminDashboardController@index');

Route::get('/', 'UserController@index');

//Business Owner
Route::get('/register', 'UserController@registration');
Route::post('/user/login', 'UserController@login');
Route::post('/user/store', 'UserController@register');
Route::post('/user/logout', 'UserController@logout');
Route::get('/user/get-user', 'UserController@getUser');
Route::post('/forgot-password', 'UserController@forgotPassword');
Route::get('/password-reset', 'UserController@passwordReset')->name('password-reset');
Route::post('/password-reset/save-password-reset', 'UserController@savePasswordReset');

Route::middleware(['role:Admin,User'])->group(function () {
    Route::get('/user/dashboard', 'UserController@viewDashboard');
    Route::get('/user/application', 'UserController@viewApplication');
    Route::get('/business-form', 'UserBusinessController@index');
    Route::get('/bplo/list', 'BPLOController@list');
    Route::post('/bplo/view-requirement', 'BPLOController@viewRequirement');
    Route::post('/user/bplo/store', 'BPLOController@store');
    Route::post('/admin/bplo/store', 'BPLOController@store');
    Route::post('/user/bplo/view-requirement', 'BPLOController@viewRequirement');
});

Route::middleware(['role:Admin'])->group(function () {
//BPLO
Route::get('/bplo', 'BPLOController@index');
//APPROVAL
Route::patch('/bplo/changeStatus/{id}', 'BPLOController@changeStatus');
Route::patch('/bplo/business-change-status/{id}', 'BPLOController@changeBusinessStatus');
Route::patch('/bplo/update-gross/{id}', 'BPLOController@updateGross');

//APPROVAL
Route::get('/admin/menro', 'MenroController@index');
Route::patch('/bplo/menro-change-status/{id}', 'MenroController@changeBusinessStatus');
Route::get('/admin/mpdc', 'MpdcController@index');
Route::patch('/bplo/mpdc-change-status/{id}', 'MpdcController@changeBusinessStatus');
Route::get('/admin/engineering', 'EngineeringController@index');
Route::patch('/bplo/engineering-change-status/{id}', 'EngineeringController@changeBusinessStatus');
Route::get('/admin/sanitary', 'SanitaryController@index');
Route::patch('/bplo/sanitary-change-status/{id}', 'SanitaryController@changeBusinessStatus');
Route::get('/admin/bfp', 'SanitaryController@index');
Route::patch('/bplo/sanitary-change-status/{id}', 'SanitaryController@changeBusinessStatus');

//AMENDMENT
Route::get('/admin/amendment', 'AmendmentController@index');
Route::post('/amendment/update-data', 'AmendmentController@updateData');

//TAX COMPUTATION
Route::get('/admin/tax-computation', 'TaxComputationController@index');
Route::post('/tax-computation/store', 'TaxComputationController@store');

//MAYORS PERMIT
Route::get('/admin/mayors-permit', 'MayorsPermitController@index');
Route::post('/mayors-permit/view-mayors-permit', 'MayorsPermitController@view');

Route::get('/menro', 'MENROController@index');
Route::get('/mpdc', 'MPDCController@index');
Route::get('/engineering', 'EngineeringController@index');
Route::get('/sanitary', 'SanitaryController@index');
Route::get('/treasurer', 'TreasurerController@index');
Route::get('/bfp', 'BFPController@index');
Route::get('/mayors-office', 'MayorsOfficeController@index');
Route::get('/bplo-releasing', 'BPLOReleasingController@index');

//User Management
Route::get('/admin/user-management', 'UserController@viewUserManagement');
Route::get('/user/list', 'UserController@list');
Route::patch('/user/change-role/{id}', 'UserController@changeRole');
Route::patch('/user/link-business/{id}', 'UserController@linkBusiness');

// Application
Route::get('/admin/application', 'Application@index');
Route::get('/admin/new-application', 'Application@viewNewApplication');
Route::post('/admin/bplo/view-requirement', 'BPLOController@viewRequirement');
Route::get('/admin/dashboard', 'Application@viewDashboard');
});