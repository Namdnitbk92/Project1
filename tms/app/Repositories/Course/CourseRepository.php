<?php

namespace App\Repositories\Course;

use App\Course;
use App\Subject;
use App\Http\Requests\Request;
use App\Repositories\Course\BaseRepository;
use App\Repositories\Course\CourseRepositoryInterface;

class CourseRepository extends BaseRepository implements CourseRepositoryInterface {

	protected $trainee;

	protected $subject;

	protected $task;

	public function __construct(Course $course,Subject $subject)
	{
		$this->model = $course;
		$this->subject = $subject;
	}

	public function getDataPaginate()
	{
		return $this->model->paginate(5);
	}

	public function all()
	{
		return $this->model->all();
	}

	public function show($id)
	{
		return $this->getById($id);
	}

	public function create()
	{
		return view('layouts.course.list');
	}

	public function store($data)
	{
		try {
		/*$data = $request->only(['name', 'description', 'start_date', 'end_date', 'status', 'image_url']);*/

		$this->model->name = $data['name'];
		$this->model->description = $data['description'];
		$this->model->start_date = $data['start_date'];
		$this->model->end_date = $data['end_date'];
		$this->model->status = $data['status'];
		$this->model->image_url = $data['image_url'];
		$this->model->save();

		} catch(Exception $e) {

		}
		
	}

	public function edit($id)
	{
	}

	public function update($id)
	{
	}

	public function delete($args = [])
	{

	}

}