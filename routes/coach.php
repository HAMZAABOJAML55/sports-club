<?php


use App\Http\Controllers\coach\dashboard\FoodController;
use App\Http\Controllers\coach\SignupController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| student Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::resource('SignUpCoach', SignupController::class);

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:coach']
    ], function () {

    //==============================dashboard============================
    Route::get('/coaches/dashboard', function () {
//        dd('kdj');
        return view('pages.coach.dashboard.dashboard');
    })->name('dashboard.coaches');

    Route::resource('coach.food' , FoodController::class);
});
