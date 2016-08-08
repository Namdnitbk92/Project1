@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-lg-12 col-md-12 body-content">
            <h2 class="ui dividing header blue">
                Course Information
            </h2>
            {{ Form::open(['url' => (empty($course) ? route('course.store') : route('course.update', ['course'=>$course->id])), 'method' => (empty($course) ? 'POST' : 'PUT'), 'class' => 'ui form','name' => 'update-course']) }}
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
            @if(!empty($course))
            <div class="field">
                <input name="userInCourses" type="hidden"/>
                <div class="panel panel-default pl">
                    <div class="panel-heading">
                        User List &nbsp;
                        <button class="ui circular google plus icon button">
                            <value class="total-trainee"> 0 trainee in course </value>
                        </button>
                    </div>
                    <div class="panel-body">
                        @if(isset($trainees) && !empty($trainees))
                            <div class="ui middle aligned animated list">
                                @foreach($trainees as $trainee)
                                    <div class="item">
                                        <div class="right floated content">
                                            <label class="ui label tag yellow">In Course</label>
                                            <div class="ui buttons">
                                                <button class="ui button active red" onclick="removeTrainee('{{ $trainee->id }}')">
                                                    <i class="minus square icon"></i>
                                                </button>
                                                <div class="or"></div>
                                                <button class="ui blue button" onclick="addTrainee('{{ $trainee->id }}')">
                                                    <i class="add user icon"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <img class="ui avatar image"
                                             src="{{ empty($trainee->avatar) ? asset('images/trainee.png') : $trainee->avatar}}">
                                        <div class="content">
                                            <div class="header">{{ $trainee->name }}</div>
                                            <div class="field">{{ $trainee->email }}</div>
                                        </div>
                                    </div>
                                @endforeach
                                @foreach($allTrainees as $trainee)
                                    <div class="item">
                                        <div class="right floated content">
                                            <div class="ui buttons">
                                                <button class="ui button active red" onclick="removeTrainee('{{ $trainee->id }}')">
                                                    <i class="minus square icon"></i>
                                                </button>
                                                <div class="or"></div>
                                                <button class="ui blue button" onclick="addTrainee('{{ $trainee->id }}')">
                                                    <i class="add user icon"></i>
                                                </button>
                                            </div>
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
            @endif
            <div class="two field">
                <div class="field f-right">
                    <button type="submit" class="ui facebook blue icon button btn-submit">
                        <i class="checkmark icon"></i> {{ empty($course) ? 'Create' : 'Update' }}
                    </button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
    <script>

        $('form[name="update-course"]').submit(function(e){
            e.preventDefault();
        });

        var total_trainee = [];
        function initTrainee () {
            @if(isset($trainees))
                @foreach($trainees as $trainee)
                    total_trainee.push('{{ $trainee->id }}');
                @endforeach
            @endif
            $('.total-trainee').text(total_trainee.length + ' trainee in course');
        }

        function removeTrainee(userId) {
            var index = _.indexOf(total_trainee,userId);
            if(index != -1) {
                total_trainee.splice(_.indexOf(total_trainee,userId), 1);
            }
            $('.total-trainee').text(total_trainee.length + ' trainee in course');
        }

        function addTrainee(userId) {
            if(!_.contains(total_trainee,userId)) {
                total_trainee.push(userId);
            }
            $('.total-trainee').text(total_trainee.length + ' trainee in course');
        }
        initTrainee();

        $('.btn-submit').click(function(){
            $('input[name="userInCourses"]').val(total_trainee);
            $('form[name="update-course"]').unbind('submit');
        });
    </script>
@endsection
