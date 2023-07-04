<?php


use App\Http\Controllers\employee\SignUpEmployeeController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| employee Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::resource('singnupemployee', SignUpEmployeeController::class);
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:employe']
    ], function () {

    //==============================dashboard============================
    Route::get('/employe/dashboard', function () {
        return view('pages.employee.dashboard');
    })->name('dashboard.employes');


});
