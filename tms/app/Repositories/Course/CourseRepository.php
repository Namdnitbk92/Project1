<?php

namespace App\Repositories\Course;

use App\Services\Utils;
use App\UserCourse;
use App\UserSubject;
use DB;
use App\Course;
use App\Subject;
use App\User;
use App\CourseSubject;
use App\Http\Requests\Request;
use App\Repositories\Course\BaseRepository;
use App\Repositories\Course\CourseRepositoryInterface;
use Mockery\CountValidator\Exception;

class CourseRepository extends BaseRepository implements CourseRepositoryInterface
{
    use Utils;

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

    public function create()
    {
        return view('layouts.course.list');
    }

    public function store($data)
    {
        $check = false;
        $course = collect([]);
        try {
            DB::beginTransaction();
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
        } catch (Exception $e) {
            $check = true;

        } finally {
            if (!$check) {
                $this->logToActivity(
                    auth()->user()->id,
                    $course->id,
                    Course::class,
                    config('attr.action_type.create')
                );
                DB::commit();
            } else {
                DB::rollBack();
                throw new Exception('create course errors');
            }
        }

        return true;
    }

    public function edit($id)
    {
    }

    public function update($data = [], $id)
    {
        $check = false;
        $course = collect([]);
        try {
            DB::beginTransaction();
            $course = $this->getById($id);
            $course->update($data);
            $users = $data['userInCourses'];
            if (isset($users) && !empty($users)) {
                $users = explode(',', $users);
                $course->users()->sync($users);
            } else {
                $course->user_course()->delete();
            }

        } catch (Exception $e) {
            $check = true;
        } finally {

            if (!$check) {
                $this->logToActivity(
                    auth()->user()->id,
                    $course->id,
                    Course::class,
                    config('attr.action_type.update')
                );
                DB::commit();
            } else {
                DB::rollBack();
                throw new Exception('update course errors');
            }
        }

        return true;

    }

    public function delete($args = [])
    {

    }

    public function getSubjects($limit = null)
    {
        $subjects = [];
        if ($limit !== null) {
            $subjects = $this->subject->paginate($limit);
        } else {
            $subjects = $this->subject->all();
        }

        return $subjects;
    }

    public function getSubjectsOfUser()
    {
        $user = auth()->user();
        if ($user == null) {
            return;
        }
        $user_subjects = $user->user_subjects()->get();
        $subjects = $user_subjects->map(function ($user_subject) {
            $subject = $user_subject->subject()->first();
            $temp = app()->make('stdClass');
            $temp->id = $user_subject->id;
            $temp->user_course_id = $user_subject->user_course_id;
            $temp->course_id = UserCourse::find($user_subject->user_course_id)->course_id;
            $temp->subject_id = $user_subject->subject_id;
            $temp->start_date = $user_subject->start_date;
            $temp->end_date = $user_subject->end_date;
            $temp->status = $user_subject->status;
            $temp->progress = $user_subject->progress;
            $temp->subject_name = $subject->name;
            $temp->description = $subject->description;

            return $temp;
        });

        return $subjects;
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

    public function show($id)
    {
        return $this->getById($id);
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
        foreach ($ids as $id) {
            $this->destroy($id);
        }
    }

    public function findSubjectById($id)
    {
        return $this->subject->findOrFail($id);
    }

    public function destroy($id)
    {
        $check = false;
        try {
            DB::beginTransaction();
            $course = $this->getById($id);
            $course_subjects = $course->course_subject()->get();
            foreach ($course_subjects as $cs => $value) {
                $conds = ['course_id' => $course->id, 'subject_id' => $value->subject_id];
                $this->courseSubject->where($conds)->delete();
            }

            if (!empty($course)) {
                $course->delete();
            }

        } catch (Exception $e) {
            $check = true;
            DB::rollBack();
        } finally {

            if (!$check) {
                $this->logToActivity(
                    auth()->user()->id,
                    $course->id,
                    Course::class,
                    config('attr.action_type.update')
                );
                DB::commit();
            } else {
                DB::rollBack();
                throw new Exception('delete course errors');
            }
        }
        return true;
    }

    public function getAllTrainees()
    {
        return $this->user->all();
    }

    public function getTraineesOfCourse($filter = null)
    {
        $trainees = [];
        if ($filter['course_id']) {
            $course = $this->getById($filter['course_id']);
            $trainees = $course->users()->get();
        }
        return $trainees;
    }

    public function getAllTraineesWithoutCourse($trainees = [])
    {
        $ids = $trainees->map(function ($trainee) {
            return $trainee->id;
        });
        return $this->user->whereNotIn('id', $ids)->where('role', 0)->get();
    }

    public function assignTraineeToCourse($data)
    {
        $ids = $data['ids'];
        $course_id = $data['course_id'];
        $course = $this->getById($course_id);
        if (isset($ids) && isset($course_id)) {
            $traineesOfCourse = $course->user_course()->get();
            foreach ($ids as $key => $id) {
                foreach ($traineesOfCourse as $trainee) {
                    if ($trainee->user_id == $id) {
                        unset($ids[$key]);
                    } else continue;
                }
            }
            if (!empty($ids)) {
                try {
                    $course->users()->attach($ids);
                } catch (Exception $e) {
                    return false;
                }
            }
        }
        return true;
    }

    public function getCourseOfUser()
    {
        $user = auth()->user();
        $courses = $user->courses()->get();
        return $courses;
    }

    public function finishSubject($id)
    {
        try {
            $user_subject = UserSubject::findOrFail($id);
            $user_subject->status = 4;//set status to finish
            $user_subject->save();

            $this->logToActivity(
                auth()->user()->id,
                $user_subject->id,
                UserSubject::class,
                config('attr.action_type.finish')
            );
        } catch (Exception $e) {
            return false;
        }

        return true;
    }
}