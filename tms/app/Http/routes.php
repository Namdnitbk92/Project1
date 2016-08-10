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

Route::group(['middleware' => 'web'], function () {

    Route::group(['middleware' => 'admin'], function () {
        Route::resource('admin', 'AdminController', ['only' => ['index', 'show']]);
    });

    Route::group(['middleware' => 'sup'], function () {
        Route::resource('sup', 'SupController');
    });

    Route::group(['middleware' => 'user'], function () {
        Route::resource('user', 'UserController');
        Route::resource('user.subject', 'UserController', ['only' => ['index', 'show']]);
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::resource('course', 'CourseController');

        Route::get('exportExcel', [
            'as' => 'exportExcel',
            'uses' => 'HomeController@exportExcel'
        ]);

        Route::get('exportCSV', [
            'as' => 'exportCSV',
            'uses' => 'HomeController@exportCSV'
        ]);

        Route::get('search', [
            'as' => 'search',
            'uses' => 'CourseController@search'
        ]);

        Route::post('destroySelected', [
            'as' => 'search',
            'uses' => 'CourseController@destroySelected'
        ]);

        Route::get('getTrainees', [
            'as' => 'getTrainees',
            'uses' => 'CourseController@getTrainees'
        ]);

        Route::post('assignTrainee', [
            'as' => 'assignTrainee',
            'uses' => 'CourseController@assignTrainee'
        ]);

        Route::get('/dashboard', [
            'as' => 'dashboard',
            'uses' => 'HomeController@index'
        ]);

        Route::post('/getActivities', [
            'as' => 'getActivities',
            'uses' => 'HomeController@getActivities'
        ]);

        Route::post('user/finishSubject', [
            'as' => 'finishSubject',
            'uses' => 'UserController@finishSubject'
        ]);
    });

    Route::group(['prefix' => 'login'], function () {

        Route::get('socialNetwork/callback', [
            'as' => 'callbackSocial',
            'uses' => 'SocialAuthController@callback',
        ]);

        Route::get('socialNetwork/callbackTwitter', [
            'as' => 'loginWithSocialNetwork',
            'uses' => 'SocialAuthController@callbackTwitter',
        ]);

        Route::get('socialNetwork/callbackGmail', [
            'as' => 'loginWithSocialNetwork',
            'uses' => 'SocialAuthController@callbackGmail',
        ]);

        Route::get('{accountSocial}/redirect', [
            'as' => 'loginWithSocialNetwork',
            'uses' => 'SocialAuthController@redirect',
        ]);

    });

    Route::get('/', function () {
        return view('home');
    });
});


Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::auth();

Route::get('/home', 'HomeController@index');
