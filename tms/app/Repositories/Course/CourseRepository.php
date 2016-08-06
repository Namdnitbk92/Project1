<?php

namespace App\Repositories\Course;

use DB;
use App\Course;
use App\Subject;
use App\User;
use App\CourseSubject;
use App\Http\Requests\Request;
use App\Repositories\Course\BaseRepository;
use App\Repositories\Course\CourseRepositoryInterface;

class CourseRepository extends BaseRepository implements CourseRepositoryInterface
{

    protected $trainee;

    protected $subject;

    protected $user;

    protected $task;

    protected $courseSubject;

    public function __construct(Course $course, Subject $subject, User $user, CourseSubject $courseSubject)
    {
        $this->model = $course;
        $this->subject = $subject;
        $this->user = $user;
        $this->courseSubject = $courseSubject;
    }

    public function getDataPaginate()
    {
        return $this->model->paginate(config('attr.size'));
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

            DB::transaction(function () use ($data) {

                $course = $this->model->create($data);

                if ($data['subjectList']) {
                    $subjects = $data['subjectList'];
                    $records = [];
                    foreach ($subjects as $subject) {
                        if (!empty($subject)) {
                            array_push($records, ['course_id' => $course->id, 'subject_id' => intval($subject)]);
                        }
                    }
                    $this->courseSubject->insert($records);
                }

            });

        } catch (Exception $e) {
            return $e->getMessage();
        }

        return true;
    }

    public function edit($id)
    {
    }

    public function update($data = [], $id)
    {
        try {
            $course = $this->getById($id);
            $course['name'] = $data['name'];
            $course['description'] = $data['description'];
            $course['start_date'] = $data['start_date'];
            $course['end_date'] = $data['end_date'];
            $course['image_url'] = $data['image_url'];
            $course['status'] = $data['image_url'];

            $course->save();

        } catch (Exception $e) {
            return $e->getMessage();
        }

        return true;

    }

    public function delete($args = [])
    {

    }

    public function destroy($id)
    {
        try {
            $course = $this->getById($id);

            DB::transaction(function () use ($course) {
                $course_subjects = $course->course_subject()->get();
                foreach ($course_subjects as $cs => $value) {
                    $conds = ['course_id' => $course->id, 'subject_id' => $value->subject_id];
                    $this->courseSubject->where($conds)->delete();
                }

                if (!empty($course)) {
                    $course->delete();
                }
            });

        } catch (Exception $e) {
            return $e->getMessage();
        }
        return true;
    }

    public function getSubjects()
    {
        return $this->subject->all();
    }

    public function getSubjectOfCourse($id)
    {
        $course = $this->show($id);
        $course_subjects = $course->course_subject()->get();

        if (empty($course_subjects)) {
            return null;
        }
        $subjects_of_course = [];
        foreach ($course_subjects as $key => $value) {
            $subject = $value->subject()->get();
            array_push($subjects_of_course, $subject);
        }
        return $subjects_of_course;
    }

    public function search($key)
    {
        return $this->model->where('id', 'LIKE', '%' . $key . '%')
            ->orWhere('name', 'LIKE', '%' . $key . '%')
            ->orWhere('status', 'LIKE', '%' . $key . '%')
            ->orWhere('start_date', 'LIKE', '%' . $key . '%')
            ->orWhere('end_date', 'LIKE', '%' . $key . '%')
            ->orWhere('description', 'LIKE', '%' . $key . '%')->paginate(2);
    }

    public function destroySelected($ids)
    {
        foreach ($ids as $id ) {
            $this->destroy($id);
        }
    }

    public function getTrainees($filter = null)
    {
        if(!isset($filter)) {
            $conds = ['role' => 0];
            $trainees = $this->user->where($conds)->get();
        } else {
            $course = $this->getById($filter['course_id']);
            $trainees = $course->users()->get();
        }
        return $trainees;
    }

    public function assignTraineeToCourse($data)
    {
        $ids = $data['ids'];
        $course_id = $data['course_id'];
        $course = $this->getById($course_id);
        if(isset($ids) && isset($course_id)) {
            $traineesOfCourse = $course->user_course()->get();
            foreach ($ids as $key => $id) {
                foreach ($traineesOfCourse as $trainee) {
                    if($trainee->user_id == $id) {
                        unset($ids[$key]);
                    } else continue;
                }
            }
            if(!empty($ids)) {
                try {
                    $course->users()->attach($ids);
                } catch (Exception $e) {
                    return false;
                }
            }
        }
        return true;
    }

}