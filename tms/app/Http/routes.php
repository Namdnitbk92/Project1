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

Route::get('/login',function(){
	return view('layouts/login');
});

Route::get('/master', function () {
    return view('layouts/master');
});

Route::get('test/{id}', function ($id) {
	return redirect()->route('child');
})->where('id', '[A-Za-z]+');

Route::get('/task/{locale}','TestController@paging');

Route::get('/child', ['as'=>'child',function () {
    return view('layouts/child',['name' => 'Dinh Ngoc Nam']);
}]);

Route::get('/task/{locale}/{page?}','TestController@showPage');

Route::post('/task',function(Request $request){	

	$validator = Validator::make($request->all(),[
		'name' => 'required|max:255'
	]);

	if($validator->fails())
	{
		return redirect('/')->withInput()->withErrors($validator);
	}

	$task = new Task;
	$task->name = $request->name;
	$task->save();

	return redirect('/task');
});


Route::post('/login','TestController@login');

/**
*
*The routes for logs views
*/
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::auth();

Route::get('/home', 'HomeController@index');
