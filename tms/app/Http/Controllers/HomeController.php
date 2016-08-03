<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Services\ExportServices;
use App\Course;
use Excel;

class HomeController extends Controller
{
    protected $course;
    protected $config;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Course $course)
    {
        $this->course = $course;
        $this->config = app()->make('stdClass');
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function export($exportType)
    {
        $course = $this->course->all();
        $this->config->name = 'Excel Test';
        $this->config->creator = 'Framgia';
        $this->config->company = 'Framgia';
        $this->config->sheetName = 'Excel Test';
        $this->config->datafields = ['Id', 'Name', 'Description', 'StartDate', 'EndDate', 'Image', 'Status'];
        isset($exportType) ? $this->config->exportType = $exportType : null;
        $excel = new ExportServices($this->config, $course);
        $excel->buildExport();
        return redirect()->route('course.index');
    }

    public function exportCSV(){
        $this->export('csv');
    }

    public function exportExcel(){
        $this->export('xls');
    }

}
