<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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


     Route::get('/', [HomeController::class,'index'])->name('selection');

    Route::get('/login/{type}',[LoginController::class,'loginForm'])->middleware('guest')->name('login.show');

    Route::post('/login',[LoginController::class,'login'])->name('login');

    Route::get('/logout/{type}', [LoginController::class,'logout'])->name('logout');



    //==============================Translate all pages============================
    Route::group(
        [
            'prefix' => LaravelLocalization::setLocale(),
            'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
        ], function () {

    //==============================dashboard============================
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    //==============================dashboard============================






});



