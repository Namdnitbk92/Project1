<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware'=>'web'], function() {

	Route::group(['middleware'=>'admin'],function() {
			Route::resource('admin','AdminController',['only'=>['index','show']]);
	});

	Route::group(['middleware'=>'admin'],function() {
			Route::resource('test.course','TestController', [
				'paramters' => 'singular'
			]);
	});

	Route::group(['middleware'=>'sup'],function() {
			Route::resource('sup','SupController');
	});

	Route::group(['middleware'=>'user'],function() {
			Route::resource('user','UserController');
	});

	Route::group(['middleware'=>'auth'],function() {
			Route::resource('course','CourseController');

			Route::get('/dashboard',[
				'as'=>'dashboard',
				'uses'=>'HomeController@index'	
			]);
	});

	Route::group(['prefix'=>'login'],function() {

		Route::get('socialNetwork/callback',[
				'as' => 'callbackSocial',
				'uses' => 'SocialAuthController@callback',
		]);

		Route::get('socialNetwork/callbackTwitter',[
			'as' => 'loginWithSocialNetwork',
			'uses' => 'SocialAuthController@callbackTwitter',
		]);

		Route::get('socialNetwork/callbackGmail',[
			'as' => 'loginWithSocialNetwork',
			'uses' => 'SocialAuthController@callbackGmail',
		]);

		Route::get('{accountSocial}/redirect',[
			'as' => 'loginWithSocialNetwork',
			'uses' => 'SocialAuthController@redirect',
		]);

	});

	Route::get('/', function () {
	    return view('welcome');
	});
});


Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::auth();

Route::get('/home', 'HomeController@index');
