@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12 col-md-12 body-content">
            <h2 class="ui dividing header blue">
                Course Information
            </h2>
            {{ Form::open(['url' => (empty($course) ? route('course.store') : route('course.update', ['course'=>$course->id])), 'method' => (empty($course) ? 'POST' : 'PUT'), 'class' => 'ui form']) }}
            <div class="field">
                <div class="two fields">
                    <div class="field">
                        <label>Name</label>
                        <input type="text" name="name" id="name" placeholder="Course Name"
                               value="{{ render($course, 'name', null) }}">
                    </div>
                    <div class="field">
                        <label>Description</label>
                        <input type="text" name="description" id="description" placeholder="Description"
                               value="{{ render($course, 'description', null) }}">
                    </div>
                </div>

                <div class="two fields">
                    <div class="field">
                        <label>Start Date</label>
                        {{ Form::date('start_date', render($course, 'start_date', 'date')) }}
                    </div>
                    <div class="field">
                        <label>End Date</label>
                        {{ Form::date('end_date', render($course, 'end_date', 'date')) }}
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
                        <span class="ui red">Created</span>
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
                {{ Form::select('subjectList', $subjects, null, ['placeholder' => 'Choose subject to course...']) }}
            </div>
            <div class="field">
                <div class="panel panel-default pl">
                    <div class="panel-heading">
                        User List
                    </div>
                    <div class="panel-body">
                        @if(isset($trainees) && !empty($trainees))
                            <div class="ui middle aligned animated list">
                                @foreach($trainees as $trainee)
                                    <div class="item">
                                        <div class="right floated content">
                                            <button class="ui circular red icon button"><i class="fa fa-trash"></i></button>
                                        </div>
                                        <img class="ui avatar image"
                                             src="{{ empty($trainee->avatar) ? asset('images/trainee.png') : $trainee->avatar}}">
                                        <div class="content">
                                            <div class="header">{{ $trainee->name }}</div>
                                            <div class="field">{{ $trainee->email }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="two field">
                <div class="field f-right">
                    <button type="submit" class="ui facebook blue icon button">
                        <i class="checkmark icon"></i> {{ empty($course) ? 'Create' : 'Update' }}
                    </button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@endsection
