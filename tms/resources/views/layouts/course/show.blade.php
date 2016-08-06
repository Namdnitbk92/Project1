@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 body-content ui form">
            <h2 class="ui dividing header blue">
                Course Information Detail
            </h2>
            <div class="field">
                <div class="two fields">
                    <div class="field">
                        <label>Name</label>
                        <span>{{ $course->name }}</span>
                    </div>
                    <div class="field">
                        <label>Description</label>
                        <span>{{ $course->description }}</span>
                    </div>
                </div>

                <div class="two fields">
                    <div class="field">
                        <label>Start Date</label>
                        <span>{{ $course->start_date }}</span>
                    </div>
                    <div class="field">
                        <label>End Date</label>
                        <span>{{ $course->end_date }}</span>
                    </div>
                </div>
                <div class="two fields">
                    <div class="field">
                        <label>Course Image</label>

                    </div>
                    <div class="field">
                        <label>Status</label>
                        <input type="hidden" value="1" name="status"/>
                        <span class="ui red">Created</span>
                    </div>
                </div>
            </div>
            <div class="field">
                <div class="panel panel-default pl">
                    <div class="panel-heading">
                        Subject List
                    </div>
                    <div class="panel-body">

                        <div class="ui middle aligned selection list">
                            @if(!empty($subjects))
                                @foreach($subjects as $subject)
                                    <div class="item">
                                        <img class="ui avatar image" src="{{ asset('images/landing-page.jpg') }}">
                                        <div class="content">
                                            <div class="header">{{ $subject[0]->name }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
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
                    <button type="submit" class="ui facebook blue icon button"
                            onclick="app.redirect(&quot;{{ route('course.index') }}&quot;)">
                        <i class="back icon"></i> Back
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection