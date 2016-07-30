<?php

namespace App\Repositories\Course;

abstract class BaseRepository {

	protected $model;

	public function getNumber()
	{
		return $this->model->count();
	}

	public function getById($id) 
	{
		return $this->model->findOrFail($id);
	}
}	