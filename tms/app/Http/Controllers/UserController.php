<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Course\CourseRepositoryInterface;
use App\Http\Requests;

class UserController extends Controller
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
    public function index(Request $request)
    {
        $view_subject_of_user = $request->input('view_subject_of_user');
        if (isset($view_subject_of_user)) {
            $subjects = $this->courseRepository->getSubjectsOfUser();
        } else {
            $subjects = $this->courseRepository->getSubjects(5);
        }

        return view('layouts.user.subject.index', [
            'subjects' => $subjects,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($user, $id)
    {
        $data = $this->courseRepository->getSubjectsOfUser();
        $subjects = collect([]);
        foreach ($data as $element) {
            if ($element->subject_id === intval($id)) {
                $subjects->push($element);
                break;
            }
        }

        return view('layouts.user.subject.show', ['subject' => $subjects->first()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function finishSubject(Request $request)
    {
        $msg = '';
        if(!$request->has('id')) {
            $msg = 'Can"t finish subject without id';
        } else {
            $id = $request->input('id');
            $msg = 'Finish Subject Id : ' . $id . 'successfully';
            if($request->ajax()) {
                $result = $this->courseRepository->finishSubject($id);
                if(!$result) {
                    $msg = 'Finish subject id' . $id . 'errors';
                }
            }
        }

        return response()->json(['messsage' => $msg]);
    }
}
