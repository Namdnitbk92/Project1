<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trainee extends Model
{

	protected $table = 'trainee';

	public function tasks(){
		return $this->hasMany('App\Task');	
	}
}
