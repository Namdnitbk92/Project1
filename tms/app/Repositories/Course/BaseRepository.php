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

	public function formatDataForSelect($records, $key, $value)
	{
		$content = [];
		foreach($records as $record) {
            $content[$record->$key] = $record->$value;
        }
        return $content;
	}

}	