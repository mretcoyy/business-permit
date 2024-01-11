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


Route::get('/', 'UserController@index');

//Business Owner
Route::get('/register', 'UserController@registration');
Route::post('/user/login', 'UserController@login');
Route::post('/user/store', 'UserController@register');
Route::post('/user/update', 'UserController@update');
Route::post('/user/logout', 'UserController@logout');
Route::get('/user/get-user', 'UserController@getUser');
Route::post('/forgot-password', 'UserController@forgotPassword');
Route::get('/password-reset', 'UserController@passwordReset')->name('password-reset');
Route::post('/password-reset/save-password-reset', 'UserController@savePasswordReset');

Route::middleware(['role:Admin,User,BPLO,MENRO,MPDC,ENGR,SNTRY,BFP,TREASURER'])->group(function () {
    Route::get('/user/dashboard', 'UserController@viewDashboard');
    Route::get('/user/application', 'UserController@viewApplication');
    Route::get('/business-form', 'UserBusinessController@index');
    Route::get('/bplo/list', 'BPLOController@list');
    Route::post('/bplo/view-requirement', 'BPLOController@viewRequirement');
    Route::post('/user/bplo/store', 'BPLOController@store');
    Route::post('/admin/bplo/store', 'BPLOController@store');
    Route::post('/user/bplo/view-requirement', 'BPLOController@viewRequirement');
});

Route::middleware(['role:Admin,BPLO,MENRO,MPDC,ENGR,SNTRY,BFP,TREASURER'])->group(function () {
    Route::get('/admin/dashboard', 'AdminDashboardController@index');
    Route::get('/bplo/dashboard', 'AdminDashboardController@fetchData');
    Route::get('/admin/audit-trial', 'AuditTrailController@index');
    Route::get('/bplo/audit-list', 'AuditTrailController@list');
});

Route::middleware(['role:Admin,BPLO'])->group(function () {
//BPLO
Route::get('/bplo', 'BPLOController@index');
//APPROVAL
Route::patch('/bplo/changeStatus/{id}', 'BPLOController@changeStatus');
Route::patch('/bplo/business-change-status/{id}', 'BPLOController@changeBusinessStatus');
Route::patch('/bplo/update-gross/{id}', 'BPLOController@updateGross');
});

//APPROVAL
Route::middleware(['role:Admin,MENRO'])->group(function () {
    Route::get('/admin/menro', 'MENROController@index');
    Route::patch('/bplo/menro-change-status/{id}', 'MENROController@changeBusinessStatus');
});

Route::middleware(['role:Admin,BPLO,MPDC'])->group(function () {
    Route::get('/admin/mpdc', 'MPDCController@index');
    Route::patch('/bplo/mpdc-change-status/{id}', 'MPDCController@changeBusinessStatus');
});

Route::middleware(['role:Admin,ENGR'])->group(function () {
    Route::get('/admin/engineering', 'EngineeringController@index');
    Route::patch('/bplo/engineering-change-status/{id}', 'EngineeringController@changeBusinessStatus');
});

Route::middleware(['role:Admin,SNTRY'])->group(function () {
    Route::get('/admin/sanitary', 'SanitaryController@index');
    Route::patch('/bplo/sanitary-change-status/{id}', 'SanitaryController@changeBusinessStatus');
});

Route::middleware(['role:Admin,BFP'])->group(function () {
    Route::get('/admin/bfp', 'BFPController@index');
    Route::patch('/bplo/bfp-change-status/{id}', 'BFPController@changeBusinessStatus');
});

//AMENDMENT

Route::middleware(['role:Admin,BPLO'])->group(function () {
    Route::get('/admin/amendment', 'AmendmentController@index');
    Route::post('/amendment/update-data', 'AmendmentController@updateData');
});

//TAX COMPUTATION
Route::middleware(['role:Admin,TREASURER'])->group(function () {
    Route::get('/admin/tax-computation', 'TaxComputationController@index');
    Route::post('/tax-computation/store', 'TaxComputationController@store');
    Route::post('/tax-computation/view-fees-form', 'TaxComputationController@viewFeesForm');
});

//MAYORS PERMIT
Route::middleware(['role:Admin,BPLO'])->group(function () {
    Route::get('/admin/mayors-permit', 'MayorsPermitController@index');
    Route::post('/mayors-permit/view-mayors-permit', 'MayorsPermitController@view');
});



//User Management
Route::middleware(['role:Admin'])->group(function () {
    Route::get('/admin/user-management', 'UserController@viewUserManagement');
    Route::get('/user/list', 'UserController@list');
    Route::patch('/user/change-role/{id}', 'UserController@changeRole');
    Route::patch('/user/link-business/{id}', 'UserController@linkBusiness');
});

// Application
Route::middleware(['role:Admin,BPLO'])->group(function () {
    Route::get('/admin/application', 'Application@index');
    Route::get('/admin/new-application', 'Application@viewNewApplication');
    Route::post('/admin/bplo/view-requirement', 'BPLOController@viewRequirement');
    Route::get('/admin/dashboard', 'Application@viewDashboard');
});

//Report
Route::middleware(['role:Admin,BPLO'])->group(function () {
    Route::get('/admin/report', 'ReportController@index');
    Route::get('/report/list', 'ReportController@list');
});
