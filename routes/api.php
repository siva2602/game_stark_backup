<?php

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

    
Route::group(['middleware' => 'auth:sanctum'], function(){
    //All secure URL's
    Route::post('list', 'Api\UserController@list');
    Route::get('user_coin', 'Api\UserController@fetch_coin');
    Route::post('profile', 'Api\UserController@profile');
    Route::post('updatetoken', 'Api\UserController@updatetoken');
    Route::get('spin', 'Api\FetchController@spin');
    Route::get('Homebanner', 'Api\FetchController@Homebanner');
    Route::post('check', 'Api\FetchController@check');
    Route::get('faq/{type}', 'Api\FetchController@faq');
    Route::get('video', 'Api\FetchController@fetch_video');
    Route::get('apps', 'Api\FetchController@fetch_apps');
    Route::get('/rewards_by_id', 'Api\FetchController@fetch_rewards');
    Route::get('games', 'Api\FetchController@fetch_game');
    Route::get('/rewards', 'Api\FetchController@fetch_reward_trans');
    Route::get('checkspin', 'Api\FetchController@spinlimit');
    Route::get('checkscratch', 'Api\FetchController@scratchlimit');
    Route::get('/history', 'Api\FetchController@fetch_transactions');
    Route::get('coinstores', 'Api\FuncController@Coinstores');
    Route::get('quizcat', 'Api\FetchController@QuizCat');
    Route::get('update_trans', 'Api\FuncController@UpdateTrans');
    Route::get('quiz', 'Api\FetchController@fetch_quiz');
    Route::get('credit_daily', 'Api\CreditController@dailycheckin');
    Route::get('cr_quiz_half', 'Api\CreditController@debit_half');
    Route::get('credit_web', 'Api\CreditController@credit_web');
    Route::get('credit_game', 'Api\CreditController@credit_game');
    Route::get('credit_quiz', 'Api\CreditController@credit_quiz');
    Route::get('credit_video', 'Api\CreditController@credit_video');
    Route::get('credit_app', 'Api\CreditController@credit_app');
    Route::get('credit_spin', 'Api\CreditController@credit_spin');
    Route::get('credit_scratch', 'Api\CreditController@credit_scratch');

    Route::post('appinfo', 'Api\FuncController@appinfo');
    Route::get('promoinfo', 'Api\FuncController@promoinfo');
    Route::post('createPromo', 'Api\FuncController@createPromo');
    Route::get('promo_app', 'Api\FuncController@promo_app');
    Route::get('promo_video', 'Api\FuncController@promo_video');
    Route::get('promo_web', 'Api\FuncController@promo_web');
    Route::post('promo_count', 'Api\FuncController@promo_count');
    Route::post('promo_report', 'Api\FuncController@promo_report');
    Route::post('collect_bonus', 'Api\UserController@collect_bonus');
    Route::post('reward-request', 'Api\CreditController@reward_request');

});
    Route::get('web', 'Api\FetchController@fetch_web');
    Route::get('daily_mission', 'Api\FetchController@DailyMission');
    Route::get('about', 'Api\FetchController@about');
    Route::get('fetch_offerwalls', 'Api\FetchController@fetch_offerwall');
    Route::get('offer_cr/{id}', 'Api\CreditController@offerwall');
    Route::post('signup', 'Api\UserController@store');
    Route::post('reset-password', 'Api\UserController@reset');
    Route::post('verify-otp', 'Api\UserController@verify');
    Route::post('send_otp', 'Api\UserController@send_otp');
    Route::post('update_password', 'Api\UserController@update_password');
    Route::post('login', 'Api\UserController@index');
    Route::post('gloin', 'Api\UserController@gloin');
    Route::get('rewards_by_category', 'Api\FetchController@fetch_rewards_category');
    Route::get('leaderboard', 'Api\UserController@leaderboard');
    Route::get('promotion_banner', 'Api\FetchController@promotion_banner');

   


/*Route::get('playstore/{url}', 'Api\FetchController@playstore');*/


    
    
    
    