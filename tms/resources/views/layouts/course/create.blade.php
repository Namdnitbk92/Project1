@extends('layouts.app')

@section('content')
<!-- <div id="add-course-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header panel-heading">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Course</h4>
      </div>
      <div class="modal-body">
        <form class="ui form">
          <div class="field">
            <div class="two fields">
              <div class="field">
                <label>Name</label>
                <input type="text" name="shipping[first-name]" placeholder="Course Name">
              </div>
              <div class="field">
                <label>Description</label>
                <input type="text" name="shipping[last-name]" placeholder="Last Name">
              </div>
            </div>

            <div class="two fields">
              <div class="field">
                <label>Start Date</label>
                 {{ Form::date('start_date', \Carbon\Carbon::now()) }}
              </div>
              <div class="field">
                <label>End Date</label>
                {{ Form::date('end_date', \Carbon\Carbon::now()) }}
              </div>
            </div>
            <div class="two fields">
              <div class="field">
                <label>Course Image</label>
                {{ Form::file('course_img', ['class'=>'file']) }}  
              </div>

              <div class="field">
                <label id="subject_list" data=""></label>
                <input type="hidden" name="subjectData"/>
                <div class="panel panel-default pl">
                    <div class="panel-heading">
                      Subject List
                    </div>
                    <div class="panel-body"> 
                      <span class='subjectSelected field' style="word-break: break-word;"></span>
                    </div>
                </div>
                {{ Form::select('subjectList', ['PHP' => 'Laravel', 'Ruby' => 'Ruby on rails'], null, ['placeholder' => 'Choose subject to course...']) }}
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">
            <i class="fa fa-btn fa-check"></i> Register
        </button>
        <button type="button" class="btn btn-default" data-dismiss="modal">
          <i class="fa fa-btn fa-cancel"></i> Close
        </button>
      </div>
    </div>

  </div>
</div> -->
<div class="row">
  <div class="col-lg-12 col-md-12 body-content">
  <h2 class="ui dividing header blue">
    Course Information
  </h2>
     {{ Form::open(['url' => route('course.store'), 'method' => 'POST', 'class' => 'ui form']) }}
        <div class="field">
          <div class="two fields">
            <div class="field">
              <label>Name</label>
              <input type="text" name="name" id="name" placeholder="Course Name">
            </div>
            <div class="field">
              <label>Description</label>
              <input type="text" name="description" id="description" placeholder="Description">
            </div>
          </div>

          <div class="two fields">
            <div class="field">
              <label>Start Date</label>
               {{ Form::date('start_date', \Carbon\Carbon::now()) }}
            </div>
            <div class="field">
              <label>End Date</label>
              {{ Form::date('end_date', \Carbon\Carbon::now()) }}
            </div>
          </div>
          <div class="two fields">
            <div class="field">
              <label>Course Image</label>
              {{ Form::file('image_url', ['class'=>'file']) }}  
            </div>
            <div class="field">
              <label>Status</label>
              <input type="hidden" value="1" name="status"/>
              <span>Created</span>
            </div>
          </div>
        </div>
        <div class="field">
              <label id="subject_list" data=""></label>
              <input type="hidden" name="subjectData"/>
              <div class="panel panel-default pl">
                  <div class="panel-heading">
                    Subject List
                  </div>
                  <div class="panel-body"> 
                    <span class='subjectSelected field' style="word-break: break-word;"></span>
                  </div>
              </div>
              {{ Form::select('subjectList', ['PHP' => 'Laravel', 'Ruby' => 'Ruby on rails'], null, ['placeholder' => 'Choose subject to course...']) }}
        </div>
        <div class="two field">
          <div class="field f-right">
            <button type="submit" class="ui facebook blue icon button">
                 <i class="checkmark icon"></i> Create
            </button>
           </div> 
        </div>
        
   {{ Form::close() }}
  </div>
 </div>       
@endsection
