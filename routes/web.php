<?php

use App\Http\Controllers\accounting\AccountingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\coach\CoachController;
use App\Http\Controllers\employee\EmployeeController;
use App\Http\Controllers\food\FoodController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\player\PlayerController;
use App\Http\Controllers\product\ProductController;
use App\Http\Controllers\prof\profController;
use App\Http\Controllers\section\SectionController;
use App\Http\Controllers\subscribe\SubscribeController;
use App\Http\Controllers\team\TeamController;
use App\Http\Controllers\tournament\TournamentController;
use App\Http\Controllers\training\TrainingController;
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
            'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:web']
        ], function () {

    //==============================dashboard============================
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');


    //==============================dashboard============================

    Route::resource('player' , playerController::class);
    Route::resource('coach' , CoachController::class);
    Route::resource('employee' , EmployeeController::class);
    Route::resource('food' , FoodController::class);
    Route::resource('subscribe' , SubscribeController::class);
    Route::resource('team' , TeamController::class);
    Route::resource('tournament' , TournamentController::class);
    Route::resource('section' , SectionController::class);
    Route::resource('product' , ProductController::class);
    Route::resource('prof' , profController::class);
    Route::resource('training' , TrainingController::class);
    Route::resource('accounting' , AccountingController::class);


    //==============================image====================================
    Route::resource('image', ImageController::class);





//==============================player============================

});



