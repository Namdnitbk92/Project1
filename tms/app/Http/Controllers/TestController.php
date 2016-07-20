<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Task;

class TestController extends Controller
{
	public function showPage($locale,$page) {
		return view('layouts.task');
	}

	public function paging(){
		$users = Task::paginate(2);
		return view('layouts.task',compact('users'));
	}

	public function login(Request $request) {
		var_dump($request->all());
		return redirect('/task/en');		
	}	

}
