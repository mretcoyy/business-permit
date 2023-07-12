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

Route::get('/application', function () {
    return view('page.BPLO.list');
});

Route::get('/dashboard', function () {
    return view('page.Dashboard.list');
});

Route::get('/', 'UserController@index');

Route::get('/register', 'UserController@registration');
Route::get('user/store', 'UserController@register');

Route::get('/bplo', 'BPLOController@index');

Route::get('/menro', 'MENROController@index');

Route::get('/mpdc', 'MPDCController@index');

Route::get('/engineering', 'EngineeringController@index');

Route::get('/sanitary', 'SanitaryController@index');

Route::get('/treasurer', 'TreasurerController@index');

Route::get('/bfp', 'BFPController@index');

Route::get('/mayors-office', 'MayorsOfficeController@index');

Route::get('/bplo-releasing', 'BPLOReleasingController@index');