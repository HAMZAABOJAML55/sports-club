<?php


use App\Http\Controllers\player\SignupPlayerController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| player Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::resource('SignUpPlayer', SignupPlayerController::class);

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:player']
    ], function () {

    //==============================dashboard============================
    Route::get('/players/dashboard', function () {
        return view('pages.player.dashboard.dashboard');
    })->name('dashboard.players');


});
