@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 body-content">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Subjects List</h3>
                    <i class="fa fa-refresh" onclick="app.redirect(&quot;{{ route('user.subject.index', ['user' => Auth::user()->id]) }}&quot;)"></i>
                </div>
                <div class="panel-body">
                    <div class="responstable-toolbar">
                        @can('is_user', Auth::user())
                            <button class="ui circular blue icon button my-subject"
                                    onclick="app.redirect(&quot;{{ route('user.subject.index', ['user' => Auth::user()->id, 'view_subject_of_user' => true]) }}&quot;)">
                                <i class="list layout icon"></i>
                            </button>
                        @endcan
                        <button class="ui circular yellow icon button btn-excel"
                                onclick="app.redirect(&quot;{{route('exportExcel')}}&quot;)">
                            <i class="file excel outline icon"></i>
                        </button>

                        <button class="ui circular orange icon button btn-csv"
                                onclick="app.redirect(&quot;{{route('exportCSV')}}&quot;)">
                            <i class="file text outline icon"></i>
                        </button>

                        <div class="f-right">
                            <div class="ui fluid category search">
                                <div class="ui icon input">
                                    <form role="form" name="search" method="GET" action="{{ url('/search') }}">
                                        {{ csrf_field() }}
                                        <input name="term" type="hidden">
                                    </form>
                                    <input class="prompt" type="text" placeholder="Search course...">
                                    <i class="search icon"></i>

                                </div>
                                <div class="results"></div>
                            </div>
                        </div>
                    </div>
                    <table class="responstable">
                        <tbody>
                        <tr>
                            <th>Id</th>
                            <th>Course Id</th>
                            <th>Name</th>
                            <th>Progress</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                        @if(!empty($subjects))
                            @foreach ($subjects as $subject)
                                <tr>
                                    <td>{{ $subject->subject_id }}</td>
                                    <td>{{ $subject->course_id }}</td>
                                    <td>{{ $subject->subject_name }}</td>
                                    <td>
                                        <div class="progress">
                                            <div name="progress-{{ $subject->subject_id }}" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="{{ $subject->progress }}" aria-valuemin="0" aria-valuemax="100" style="width:{{ $subject->progress }}%">
                                                {{ $subject->progress }}%
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $subject->description }}</td>
                                    <td>
                                        <div class="field">
                                            <button class="ui circular twitter icon button btn-info-subject"
                                                    onclick="app.redirect(&quot;{{route('user.subject.show', ['user' => auth()->user()->id, 'subject' => $subject->subject_id])}}&quot;)">
                                                <i class="info icon"></i>
                                            </button>
                                            @if(app('request')->input('view_subject_of_user'))
                                            <button class="ui circular red icon button btn-finish"
                                                    onclick="finish('{{$subject->id}}')">
                                                <i class="check icon"></i>
                                            </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>Data Empty</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                    <div class="paginate f-right">
                        @if(method_exists($subjects, 'links'))
                            {{ $subjects->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.confirm')
    <script>
        $('.btn-finish').popup({
            position : 'top left',
            content : 'Finish Subject'
        })

        $('.btn-info-subject').popup({
            position : 'top left',
            content : 'View information of subject'
        })

        function finish(id){
            $('#confirmModal').modal('show');
            $('#confirmModal').attr('_id', id);
        }

        $('.btn-confirm').click(function(){
            var userSubjectId = $('#confirmModal').attr('_id');
            $.ajax({
                url : '{{ route('finishSubject') }}',
                type : 'POST',
                data : {
                    id : userSubjectId
                },
                dataType : 'json',
                beforeSend : function () {

                }
            }).done(function(res) {

            });
        });
    </script>
@endsection
