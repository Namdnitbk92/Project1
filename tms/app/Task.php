<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/*use DB;*/

class Task extends Model
{

	/**
	*
	*Define name of table to get or store data on this table.
	*
	*/
	protected $table = 'tasks';

	/**Get the relation ship with user table*/
	public function trainee(){
		return $this->belongsTo('App\Trainee');
	}
}
