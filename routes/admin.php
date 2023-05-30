<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/





#**************************-dashboard-*****************************
//==============================Translate all pages============================\\
//'localeSessionRedirect', 'localizationRedirect', 'localeViewPath',

Route::group(['prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:admin']], function () {
    Route::get('/admin/dashboard',[DashboardController::class,'index'])->name('admin.dashboard');
    Route::get('/admin/logout', [LoginController::class,'logout'])->name('admin.logout');
});

#**************************-login-*********************************
Route::group(['middleware'=>'guest:admin'], function (){
    Route::get('/admin/login',[LoginController::class,'getLogin'])->name('get.admin.login');
    Route::post('/admin/login',[LoginController::class,'login'])->name('admin.login');
});



