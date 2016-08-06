<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Repositories\Course\CourseRepositoryInterface;
use Mockery\CountValidator\Exception;

class CourseController extends Controller
{

    protected $courseRepository;

    public function __construct(CourseRepositoryInterface $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = $this->courseRepository->getDataPaginate();
        $trainees = $this->courseRepository->getTrainees();
        return view('layouts.course.list', ['courses' => $courses, 'trainees' => $trainees]);
    }

    /**
     * Show the form for creating a new resource.php
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subjects = $this->courseRepository->getSubjects();
        return view('layouts.course.create',
            [
                'subjects' => $this->courseRepository->formatDataForSelect($subjects, 'id', 'name'),
                'course' => [],
            ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(['name', 'description', 'status', 'start_date', 'end_date', 'image_url', 'subjectData']);
        $data['status'] = intval($data['status']);

        $data['subjectList'] = explode(',', $data['subjectData']);

        $result = $this->courseRepository->store($data);
        if ($result == false) {
            return redirect()->route('course.index')->withErrors($result)->withInput();
        }
        return redirect()->route('course.index')->withSuccess('add course success!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = $this->courseRepository->show($id);
        $subjects = $this->courseRepository->getSubjectOfCourse($id);
        $trainees = $this->courseRepository->getTrainees(['course_id' => $id]);

        return view('layouts.course.show', ['course' => $course, 'subjects' => $subjects, 'trainees' => $trainees]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = $this->courseRepository->show($id);
        $arrays = $this->courseRepository->getSubjectOfCourse($id);
        $trainees = $this->courseRepository->getTrainees(['course_id' => $id]);
        $subjects = [];
        foreach ($arrays as $array) {
            $first = $array[0];
            if (!empty($first)) {
                $subjects[$first->id] = $first->name;
            }
        }
        return view('layouts.course.edit', ['course' => $course, 'subjects' => $subjects, 'trainees' => $trainees]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->only([
            'name',
            'description',
            'start_date',
            'end_date',
            'image_url',
            'subjectData',
        ]);

        $data['subjectList'] = explode(',', $data['subjectData']);

        $result = $this->courseRepository->update($data, $id);

        if ($result == false) {
            return redirect()->route('course.edit', ['course' => $id])->withErrors($result)->withInput();
        }
        return redirect()->route('course.edit', ['course' => $id])->withSuccess('add course success!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->courseRepository->destroy($id);

        if (is_string($result)) {
            return redirect()->route('course.index')->withErrors('delete errors');
        }

        return redirect()->route('course.index')->withSuccess('delete success');
    }

    public function search(Request $request)
    {
        $term = $request->input('term');
        $course = $this->courseRepository->search($term);
        return view('layouts.course.list', ['courses' => $course, 'search' => true]);
    }

    public function destroySelected(Request $request)
    {
        $ids = $request->input('ids');
        $this->courseRepository->destroySelected($ids);
    }

    public function assignTrainee(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->only(['ids', 'course_id']);
            try {
                $result = $this->courseRepository->assignTraineeToCourse($data);
                if (!$result) {
                    return response()->json(['error' => 'Assign Trainee Error!']);
                }
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }

        }

        return response()->json(['message' => 'Assign Trainee Successfully!']);
    }
}
