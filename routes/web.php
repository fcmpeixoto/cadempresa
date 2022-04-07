<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Auth::routes(['register' => false]);

Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => 'auth', 'prefix' => 'system'],function(){

    Route::resource('/employee', App\Http\Controllers\EmployeeController::class);
    Route::any('employee/search', [App\Http\Controllers\EmployeeController::class,'search'])->name('employee.search');

    Route::resource('/companie', App\Http\Controllers\CompanieController::class);
    Route::any('companie/search', [App\Http\Controllers\CompanieController::class,'search'])->name('companie.search');

});
