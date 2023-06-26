<?php

use App\Http\Controllers\API\AccountingController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ChampionshipLevelController;
use App\Http\Controllers\API\ChampionshipResultController;
use App\Http\Controllers\API\CoachsController;
use App\Http\Controllers\API\DietPlanController;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\EmploymentTypesController;
use App\Http\Controllers\API\FoodsController;
use App\Http\Controllers\API\FoodSystemController;
use App\Http\Controllers\API\ForgotPasswordController;
use App\Http\Controllers\API\GenderController;
use App\Http\Controllers\API\LocationController;
use App\Http\Controllers\API\NationalityController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\PaypalController;
use App\Http\Controllers\API\PlayersController;
use App\Http\Controllers\API\PrizesController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ProductTypeController;
use App\Http\Controllers\API\ProfController;
use App\Http\Controllers\API\SectionController;
use App\Http\Controllers\API\Sub_LocationController;
use App\Http\Controllers\API\SubscribeController;
use App\Http\Controllers\API\SubtypeController;
use App\Http\Controllers\API\TeamController;
use App\Http\Controllers\API\TournamentController;
use App\Http\Controllers\API\TournamentTypeController;
use App\Http\Controllers\API\TrainingController;
use App\Http\Controllers\API\TrainingGroupController;
use App\Models\ChampionshipLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/login', function () {
    echo 'some thing went wrong';
});

Route::group(['middleware' => ['api', 'auth:api'], 'prefix' => 'v1/club'], function ($router) {
    Route::post('add_club' ,'App\Http\Controllers\API\club\ClubController@store')->withoutMiddleware('auth:api');
    Route::post('update', 'App\Http\Controllers\API\club\ClubController@update');
});

Route::group(['middleware' => ['api', 'auth:api'], 'prefix' => 'v1'], function ($router) {
    Route::post('login/admin' ,'App\Http\Controllers\API\AuthController@login')->withoutMiddleware('auth:api');
    Route::post('logout/admin', 'App\Http\Controllers\API\AuthController@logout');
    Route::post('refresh/admin', 'App\Http\Controllers\API\AuthController@refresh');
    Route::get('userProfile/admin', 'App\Http\Controllers\API\AuthController@userProfile');
    Route::post('password/email', [ForgotPasswordController::class,'forgot'])->withoutMiddleware('auth:api');
    Route::post('password/reset', [ForgotPasswordController::class,'reset'])->withoutMiddleware('auth:api');
});



Route::group(['middleware' => ['api','auth:api'],'prefix'=>'v1' ,'namspace'=>'API'], function()
{
    #seeder Show
    Route::get('location',[LocationController::class ,'index'])->withoutMiddleware('auth:api');
    Route::get('location/show',[LocationController::class ,'show'])->withoutMiddleware('auth:api');

    Route::get('nationality',[NationalityController::class ,'index'])->withoutMiddleware('auth:api');
    Route::get('nationality/show',[NationalityController::class ,'show']);

    Route::get('SubLocation',[Sub_LocationController::class ,'index'])->withoutMiddleware('auth:api');
    Route::get('SubLocation/show',[Sub_LocationController::class ,'show'])->withoutMiddleware('auth:api');

    Route::get('gender',[GenderController::class ,'index'])->withoutMiddleware('auth:api');
    Route::get('gender/show',[GenderController::class ,'show'])->withoutMiddleware('auth:api');

    Route::get('Prize',[PrizesController::class ,'index'])->withoutMiddleware('auth:api');
    Route::get('Prize/show',[PrizesController::class ,'show'])->withoutMiddleware('auth:api');

    Route::get('prof',[ProfController::class ,'index'])->withoutMiddleware('auth:api');
    Route::get('prof/show',[ProfController::class ,'show'])->withoutMiddleware('auth:api');

    Route::get('ChampionshipLevel',[ChampionshipLevelController::class ,'index'])->withoutMiddleware('auth:api');
    Route::get('ChampionshipLevel/show',[ChampionshipLevelController::class ,'show'])->withoutMiddleware('auth:api');

    Route::get('FoodSystem',[FoodSystemController::class ,'index'])->withoutMiddleware('auth:api');
    Route::get('FoodSystem/show',[FoodSystemController::class ,'show'])->withoutMiddleware('auth:api');

    Route::get('EmploymentTypes',[EmploymentTypesController::class ,'index'])->withoutMiddleware('auth:api');
    Route::get('EmploymentTypes/show',[EmploymentTypesController::class ,'show'])->withoutMiddleware('auth:api');

    Route::get('ProductType',[ProductTypeController::class ,'index'])->withoutMiddleware('auth:api');
    Route::get('ProductType/show',[ProductTypeController::class ,'show'])->withoutMiddleware('auth:api');

    Route::get('Subtype',[SubtypeController::class ,'index'])->withoutMiddleware('auth:api');
    Route::get('Subtype/show',[SubtypeController::class ,'show'])->withoutMiddleware('auth:api');

    Route::get('TournamentType',[TournamentTypeController::class ,'index'])->withoutMiddleware('auth:api');
    Route::get('TournamentType/show',[TournamentTypeController::class ,'show'])->withoutMiddleware('auth:api');

    Route::get('TrainingGroup',[TrainingGroupController::class ,'index'])->withoutMiddleware('auth:api');
    Route::get('TrainingGroup/show',[TrainingGroupController::class ,'show'])->withoutMiddleware('auth:api');

############################################################################################

    Route::get('team',[TeamController::class ,'index']);
    Route::post('team/add',[TeamController::class ,'store']);
    Route::post('team/update',[TeamController::class ,'update']);
    Route::get('team/show',[TeamController::class ,'show']);
    Route::delete('team/delete',[TeamController::class ,'destroy']);

    Route::get('tournament',[TournamentController::class ,'index']);
    Route::post('tournament/add',[TournamentController::class ,'store']);
    Route::post('tournament/update',[TournamentController::class ,'update']);
    Route::get('tournament/show',[TournamentController::class ,'show']);
    Route::delete('tournament/delete',[TournamentController::class ,'destroy']);

    Route::get('ChampionshipResult',[ChampionshipResultController::class ,'index']);
    Route::post('ChampionshipResult/add',[ChampionshipResultController::class ,'store']);
    Route::post('ChampionshipResult/update',[ChampionshipResultController::class ,'update']);
    Route::get('ChampionshipResult/show',[ChampionshipResultController::class ,'show']);
    Route::delete('ChampionshipResult/delete',[ChampionshipResultController::class ,'destroy']);


    Route::get('coach',[CoachsController::class ,'index']);
    Route::post('coach/add',[CoachsController::class ,'store']);
    Route::post('coach/update',[CoachsController::class ,'update']);
    Route::get('coach/show',[CoachsController::class ,'show']);
    Route::delete('coach/delete',[CoachsController::class ,'destroy']);

    Route::get('player' , [PlayersController::class , 'index']);
    Route::get('player/show' , [PlayersController::class , 'show']);
    Route::post('player/add' , [PlayersController::class , 'store']);
    Route::post('player/update' , [PlayersController::class , 'update']);
    Route::delete('player/delete' , [PlayersController::class , 'destroy']);

    Route::get('accounting',[AccountingController::class ,'index']);
    Route::post('accounting/add',[AccountingController::class ,'store']);
    Route::post('accounting/update',[AccountingController::class ,'update']);
    Route::get('accounting/show',[AccountingController::class ,'show']);
    Route::delete('accounting/delete',[AccountingController::class ,'destroy']);

    Route::get('section' , [SectionController::class , 'index']);
    Route::get('section/show' , [SectionController::class , 'show']);
    Route::post('section/add' , [SectionController::class , 'store']);
    Route::post('section/update' , [SectionController::class , 'update']);
    Route::delete('section/delete' , [SectionController::class , 'destroy']);

    Route::get('subscripe',[SubscribeController::class ,'index'])->withoutMiddleware('auth:api');
    Route::post('subscripe/add',[SubscribeController::class ,'store']);
    Route::post('subscripe/update',[SubscribeController::class ,'update']);
    Route::get('subscripe/show',[SubscribeController::class ,'show']);
//    Route::delete('subscripe/delete',[SubscribeController::class ,'destroy']);

    Route::get('employee',[EmployeeController::class ,'index']);
    Route::get('employee/show',[EmployeeController::class ,'show']);
    Route::post('employee/add',[EmployeeController::class ,'store']);
    Route::post('employee/update',[EmployeeController::class ,'update']);
    Route::delete('employee/delete',[EmployeeController::class ,'destroy']);

    Route::get('Food',[FoodsController::class ,'index']);
    Route::post('Food/add',[FoodsController::class ,'store']);
    Route::post('Food/update',[FoodsController::class ,'update']);
    Route::get('Food/show',[FoodsController::class ,'show']);
    Route::delete('Food/delete',[FoodsController::class ,'destroy']);

    Route::get('product',[ProductController::class ,'index']);
    Route::post('product/add',[ProductController::class ,'store']);
    Route::post('product/update',[ProductController::class ,'update']);
    Route::get('product/show',[ProductController::class ,'show']);
    Route::delete('product/delete',[ProductController::class ,'destroy']);

    Route::get('notifications', [NotificationController::class, 'index']);
    Route::get('notifications/{notification}', [NotificationController::class, 'show']);


    Route::get('/payment', [PaypalController::class, 'payment'])->name('payment')->withoutMiddleware('auth:api');
    Route::get('/cancel', [PaypalController::class, 'cancel'])->name('cancel')->withoutMiddleware('auth:api');
    Route::get('/payment/success', [PaypalController::class, 'success'])->withoutMiddleware('auth:api')->name('payment.success');



    Route::get('DietPlan',[DietPlanController::class ,'index']);
    Route::post('DietPlan/add',[DietPlanController::class ,'store']);
    Route::post('DietPlan/update',[DietPlanController::class ,'update']);
    Route::get('DietPlan/show',[DietPlanController::class ,'show']);
    Route::delete('DietPlan/delete',[DietPlanController::class ,'destroy']);

    Route::get('Category',[CategoryController::class ,'index']);
    Route::post('Category/add',[CategoryController::class ,'store']);
    Route::post('Category/update',[CategoryController::class ,'update']);
    Route::get('Category/show',[CategoryController::class ,'show'])->withoutMiddleware('auth:api');
    Route::delete('Category/delete',[CategoryController::class ,'destroy']);

#now
    Route::get('Training',[TrainingController::class ,'index']);
    Route::post('Training/add',[TrainingController::class ,'store']);
    Route::post('Training/update',[TrainingController::class ,'update']);
    Route::get('Training/show',[TrainingController::class ,'show']);
    Route::delete('Training/delete',[TrainingController::class ,'destroy']);

}

);


Route::group(['middleware' => ['api', 'auth:api_player'], 'prefix' => 'v1'], function ($router) {

    Route::post('login/player', 'App\Http\Controllers\API\player\PlayerController@login')->withoutMiddleware('auth:api_player');;
    Route::post('register/player', 'App\Http\Controllers\API\player\PlayerController@register')->withoutMiddleware('auth:api_player');
    Route::post('logout/player', 'App\Http\Controllers\API\player\PlayerController@logout');
    Route::post('refresh/player', 'App\Http\Controllers\API\player\PlayerController@refresh');
    Route::post('myData/player', 'App\Http\Controllers\API\player\PlayerController@myData');
});

Route::group(['middleware' => ['api', 'auth:api_coach'], 'prefix' => 'v1'], function ($router) {

    Route::post('login/coach', 'App\Http\Controllers\API\coach\CoachController@login')->withoutMiddleware('auth:api_coach');;
    Route::post('register/coach', 'App\Http\Controllers\API\coach\CoachController@register')->withoutMiddleware('auth:api_coach');
    Route::post('logout/coach', 'App\Http\Controllers\API\coach\CoachController@logout');
    Route::post('refresh/coach', 'App\Http\Controllers\API\coach\CoachController@refresh');
    Route::post('myData/coach', 'App\Http\Controllers\API\coach\CoachController@myData');
});

Route::group(['middleware' => ['api', 'auth:api_employe'], 'prefix' => 'v1'], function ($router) {

    Route::post('login/employee', 'App\Http\Controllers\API\employee\EmployeeController@login')->withoutMiddleware('auth:api_employe');;
    Route::post('register/employee', 'App\Http\Controllers\API\employee\EmployeeController@register')->withoutMiddleware('auth:api_employe');
    Route::post('logout/employee', 'App\Http\Controllers\API\employee\EmployeeController@logout');
    Route::post('refresh/employee', 'App\Http\Controllers\API\employee\EmployeeController@refresh');
    Route::post('myData/employee', 'App\Http\Controllers\API\employee\EmployeeController@myData');
});

