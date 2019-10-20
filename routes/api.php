<?php

use Illuminate\Http\Request;

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
Route::group(['middleware'=>'api'], function(){
   Route::post('/login', 'Api\LoginController@login');


//audition api
    Route::group(['prefix' => 'audition/'], function(){
        //inserting form data
        Route::post('/registration', 'Api\AuditionController@storeAuditionForm');

        //listing the data
        Route::get('/banner/list', 'Api\AuditionController@getBannerlist');
        Route::get('/judge/list', 'Api\AuditionController@getJudgelist');
        Route::get('/sponser/list', 'Api\AuditionController@getSponserlist');
        Route::get('/location/list', 'Api\AuditionController@getLocationlist');
        Route::get('/news/list', 'Api\AuditionController@getNewslist');

        //Payment api
        Route::group(['prefix' => 'payment/'], function() {
            //stripe payment api
            Route::get('/stripe/key', 'Api\PaymentController@getStripeKey');
            Route::post('/stripe/pay', 'Api\PaymentController@postPaymentStripe');


            Route::post('/change/status', 'Api\PaymentController@changePaymentStatus')->middleware('jwt.verify');
            Route::get('/status', 'Api\AuditionController@getAuditionStatus');

            //offline  gundruk quiz change point
            Route::post('/change/status', 'Api\PaymentController@changePaymentStatus')->middleware('jwt.verify');


        });


    });
//    end audition route

    //gundruk offline quiz api route
    Route::group(['prefix' => 'gundrukquiz/', 'middleware' => 'jwt.verify'], function() {

        //offline  gundruk quiz change point
        Route::post('/offline/change-point', 'Api\GundrukOfflineQuizController@addOfflineQuizPoint');
        Route::post('/offline/get-user-points', 'Api\GundrukOfflineQuizController@get_logged_in_user_points');
        Route::post('/offline/leaderboard', 'Api\GundrukOfflineQuizController@getLeaderBoard');
    });

});

Route::get('/stories', 'Api\GundrukController@getStoriesList');
Route::get('/videos', 'Api\GundrukController@getVideosList');
//to refresh the token
Route::post('/token/refresh', 'Api\LoginController@refresh');
Route::get('/policy', 'Api\GundrukController@getPolicy');
Route::get('/faq', 'Api\GundrukController@getFaq');





