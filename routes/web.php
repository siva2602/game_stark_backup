<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
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

Route::get('/dashboard','AdminController@index')->name('dashboard');

Route::get('/',  'Auth\LoginController@showLoginForm');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');

Route::group(['middleware' => 'auth'], function(){
	// logout route
	Route::get('/logout', 'Auth\LoginController@logout');
	Route::get('/clear-cache', 'HomeController@clearCache');
	Route::get('/call', 'HomeController@call');
	Route::get('/users', 'CustomerController@index');
	Route::get('/users/banned', 'CustomerController@bannedindex');
	Route::post('/users/status', 'CustomerController@status');
	Route::get('/users/delete/{id}', 'CustomerController@destroy');
	Route::post('/users', 'CustomerController@status');
	Route::get('/user/get-list/{status}', 'CustomerController@getUserList');
	Route::post('/user/addcoin', 'CustomerController@add_coin');
	Route::post('/user/noti', 'NotificationController@notifyUser');
	Route::get('/user/search/{name}', 'CustomerController@getSearchList');
	Route::get('/userlog/{id}', 'CustomerController@getUserlog');
	Route::get('/userlog/action', 'CustomerController@delUserlog');
	Route::get('/user-transaction', 'TransactionController@index');
	Route::get('/user/track/{id}', 'TransactionController@trackView');
	Route::get('/search-user', function () { return view('pages.search-user'); });

	Route::get('/transaction/data', 'TransactionController@getTransacitonList');
	Route::get('/pay-transaction', function () { return view('pages.payment-trans'); });
	Route::get('/pay-transaction/data', 'TransactionController@getPayTransacitonList');
	Route::get('/pay-transaction/delete/{id}', 'TransactionController@deletePayTransaciton');
	Route::get('/transaction/{id}', 'TransactionController@getUserTransaciton');
	Route::get('/transaction/delete/{id}', 'TransactionController@deleteTransaciton');
	Route::post('/transaction/action', 'TransactionController@action');
	
	
	Route::get('/setting-general','SettingController@index');
	Route::get('/setting/security','SettingController@security');
	Route::get('/setting/ads','SettingController@adsView');
	Route::post('/setting/update', 'SettingController@update');
	Route::get('/setting/spin', 'SettingController@spin');
	Route::get('/setting/app', 'SettingController@app');
	Route::get('/setting/maintenance', 'SettingController@maintenance');
	Route::post('/setting/app-setting', 'SettingController@appupdate');
	Route::post('/setting/admin-setting', 'SettingController@adminSetting');
	Route::post('/setting/spinupdate', 'SettingController@spinupdate');
	Route::view('/notification', 'notification');
	Route::post('/notification/send', 'NotificationController@new');
	Route::get('/admin-profile', 'AdminController@admin');
	Route::post('/admin/update', 'AdminController@update');
	Route::post('/verify', 'AdminController@verify');

	//web
	Route::get('/websites', 'WeblinkController@index');
	Route::get('/websites/list', 'WeblinkController@List');
	Route::get('/websites/create-websites', function () { return view('web.create-web'); });
	Route::post('/websites/create', 'WeblinkController@store');
	Route::post('/websites/action', 'WeblinkController@action');
	Route::get('/websites/edit/{id}', 'WeblinkController@edit');
	Route::post('/websites/update', 'WeblinkController@update');
	Route::get('/websites/delete/{id}', 'WeblinkController@destroy');
	
	//faq
	Route::get('/faq', 'FAQController@index');
	Route::get('/faq/list', 'FAQController@List');
	Route::post('/faq/create', 'FAQController@store');
	Route::post('/faq/action', 'FAQController@action');
	Route::get('/faq/edit/{id}', 'FAQController@edit');
	Route::post('/faq/update', 'FAQController@update');
	Route::get('/faq/delete/{id}', 'FAQController@destroy');
	
	//coinstore
	Route::get('/coinstore', 'CoinStoreController@index');
	Route::get('/coinstore/list', 'CoinStoreController@List');
	Route::post('/coinstore/create', 'CoinStoreController@store');
	Route::post('/coinstore/action', 'CoinStoreController@action');
	Route::get('/coinstore/edit/{id}', 'CoinStoreController@edit');
	Route::post('/coinstore/update', 'CoinStoreController@update');

	//banner
	Route::get('/banner', 'BannerController@index');
	Route::get('/banner/list', 'BannerController@List');
	Route::post('/banner/create', 'BannerController@store');
	Route::post('/banner/action', 'BannerController@action');
	Route::get('/banner/edit/{id}', 'BannerController@edit');
	Route::post('/banner/update', 'BannerController@update');
	Route::get('/banner/delete/{id}', 'BannerController@destroy');
	
	//video
	Route::get('/videos', 'VideoController@index');
	Route::get('/videos/list', 'VideoController@List');
	Route::get('/videos/create-video', function () { return view('video.create-video'); });
	Route::post('/videos/create', 'VideoController@store');
	Route::post('/videos/action', 'VideoController@action');
	Route::get('/videos/edit/{id}', 'VideoController@edit');
	Route::post('/videos/update', 'VideoController@update');
	Route::get('/videos/delete/{id}', 'VideoController@destroy');
	
	//apps
	Route::get('/apps', 'AppsController@index');
	Route::get('/apps/list', 'AppsController@List');
	Route::get('/apps/create-app', function () { return view('app.create-app'); });
	Route::post('/apps/create', 'AppsController@store');
	Route::post('/apps/action', 'AppsController@action');
	Route::get('/apps/edit/{id}', 'AppsController@edit');
	Route::post('/apps/update', 'AppsController@update');
	Route::get('/apps/delete/{id}', 'AppsController@destroy');
	Route::post('appinfo', 'AppsController@appinfo');
	
	//offerwall
	Route::get('/offerwall/sdk', function () { return view('offerwall.sdk-offers'); });
	Route::get('/offerwall/api', function () { return view('offerwall.api-offers'); });
	Route::get('/offerwall/web', function () { return view('offerwall.web-offers'); });
	Route::get('/offerwall/create-offer-sdk',  function () { return view('offerwall.create-offer-sdk'); });
	Route::get('/offerwall/create-offer-api',  function () { return view('offerwall.create-offer-api'); });
	Route::get('/offerwall/create-offer-web',  function () { return view('offerwall.create-offer-web'); });
	Route::post('/offerwall/create','OfferwallC@store');
	Route::get('/offerwall/edit/{type}/{id}','OfferwallC@edit');
	Route::post('/offerwall/update','OfferwallC@update');
	Route::get('/offerwall/list/{type}', 'OfferwallC@Data');
	Route::post('/offerwall/action', 'OfferwallC@action');



	//rewards
	Route::get('/payment-options', 'RedeemController@index');
	Route::get('/payment-options/list', 'RedeemController@List');
	Route::get('/payment-options/create', 'RedeemController@create');
	Route::post('/payment-options/create', 'RedeemController@store');
	Route::post('/payment-options/action', 'RedeemController@action');
	Route::get('/payment-options/edit/{id}', 'RedeemController@edit');
	Route::post('/payment-options/update', 'RedeemController@update');
	Route::get('/payment-options/delete/{id}', 'RedeemController@destroy');
	//rewards category
	Route::get('/reward-cat', 'RedeemCatController@index');
	Route::get('/reward-cat/list', 'RedeemCatController@List');
	Route::get('/reward-cat/create', function () { return view('redeem.create-redeemcat'); });
	Route::post('/reward-cat/create', 'RedeemCatController@store');
	Route::get('/reward-cat/edit/{id}', 'RedeemCatController@edit');
	Route::post('/reward-cat/update', 'RedeemCatController@update');
	Route::get('/reward-cat/delete/{id}', 'RedeemCatController@destroy');
	
	//quiz
	Route::get('/quiz', 'QuizController@index');
	Route::get('/quiz/list', 'QuizController@List');
	Route::get('/quiz/create', 'QuizController@create');
	Route::post('/quiz/create', 'QuizController@store');
	Route::post('/quiz/update', 'QuizController@update');
	Route::post('/quiz/action', 'QuizController@action');
	Route::get('/quiz/edit/{id}', 'QuizController@edit');
	Route::get('/quiz/delete/{id}', 'QuizController@destroy');
	
	//quiz cat
	Route::get('/quiz-cat', 'QuizController@cat_index');
	Route::get('/quiz-cat/list', 'QuizController@cat_List');
	Route::get('/quiz-cat/create', function () { return view('game.create-game'); });
	Route::post('/quiz-cat/create', 'QuizController@cat_store');
	Route::post('/quiz-cat/update', 'QuizController@cat_update');
	Route::post('/quiz-cat/action', 'QuizController@cat_action');
	Route::get('/quiz-cat/edit/{id}', 'QuizController@cat_edit');
	Route::get('/quiz-cat/delete/{id}', 'QuizController@cat_destroy');
	
	//game
	Route::get('/game', 'GameController@index');
	Route::get('/game/list', 'GameController@List');
	Route::get('/game/create', function () { return view('game.create-game'); });
	Route::post('/game/create', 'GameController@store');
	Route::post('/game/update', 'GameController@update');
	Route::post('/game/action', 'GameController@action');
	Route::get('/game/edit/{id}', 'GameController@edit');
	Route::get('/game/delete/{id}', 'GameController@destroy');

	//request pending
	Route::get('/request/completelist', 'PaymentController@completelist'); // this one
	Route::get('/request-pending', 'PaymentController@index');
	Route::get('/request/pendinglist', 'PaymentController@pendinglist');
	Route::post('/request/action', 'PaymentController@action');

	//request reject
	Route::get('/request-reject', 'PaymentController@viewreject');
	Route::get('/request/rejectlist', 'PaymentController@rejectlist');
	
	Route::post('/request/update', 'PaymentController@update');
	Route::get('/request/delete/{id}', 'PaymentController@destroy');
	Route::get('/request/{id}', 'PaymentController@list');

	//request complete
	Route::get('/request-complete', 'PaymentController@viewcomplete');



  

	
});

	Route::post('/transaction/transactionbydate', 'TransactionController@transactionbydate');


