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
use Illuminate\Http\Request;
use App\Task;

Route::get('/', function () {
    return view('welcome');
});

/*
* Routes for login with social account
*/

Route::get('login/{accountSocial}/redirect','SocialAuthController@redirect');

Route::get('login/socialNetwork/callback','SocialAuthController@callback');

Route::get('login/socialNetwork/callbackTwitter','SocialAuthController@callbackTwitter');
Route::get('login/socialNetwork/callbackGmail','SocialAuthController@callbackGmail');

/**
*
*The routes for logs views
*/
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::auth();

Route::get('/home', 'HomeController@index');
