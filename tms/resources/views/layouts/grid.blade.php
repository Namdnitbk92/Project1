<div class="responstable-toolbar">
    <button class="ui circular blue icon button add-course"
            onclick="app.redirect(&quot;{{route('course.create')}}&quot;)">
        <i class="add icon"></i>
    </button>

    <button class="ui circular red icon button del-course-multi">
        <i class="trash icon"></i>
    </button>

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
        <th></th>
        <th>Id</th>
        <th>Name</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th>Description</th>
        <th>Action</th>
    </tr>
    @if(empty($course))
        @foreach ($courses as $course)
            {{ Form::open(['method' => 'DELETE', 'route' => ['course.destroy', $course->id], 'name' => 'delRoute'.$course->id, 'id'=>'delRoute']) }}
            <tr>
                <td><input type="checkbox" name="radio-{{ $course->id }}" onclick="saveStorage('{{$course->id}}')"></td>
                <td>{{ $course->id }}</td>
                <td>{{ $course->name }}</td>
                <td>{{ $course->start_date }}</td>
                <td>{{ $course->end_date }}</td>
                <td>{{ $course->description }}</td>
                <td>
                    <div class="two field">
                        <div class="field">
                            <button class="ui circular facebook icon button"
                                    onclick="app.redirect(&quot;{{route('course.edit', ['course' => $course->id])}}&quot;)">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button class="ui circular twitter icon button"
                                    onclick="app.redirect(&quot;{{route('course.show', ['course' => $course->id])}}&quot;)">
                                <i class="info icon"></i>
                            </button>
                        </div>
                        <div class="field">
                            <button class="ui circular red icon button del-course" type="submit"
                                    onclick="saveSelect('{{$course->id}}')">
                                <i class="trash icon"></i>
                            </button>
                            <button class="ui circular yellow icon button btn-assign"
                                    onclick="openAssign('{{ $course->name }}', '{{ $course->id }}')">
                                <i class="add user icon"></i>
                            </button>
                        </div>
                    </div>
                </td>
            </tr>
            {{ Form::close() }}
        @endforeach
    @else
        <tr>
            <td>Data Empty</td>
        </tr>
    @endif
    </tbody>
</table>
<div class="paginate f-right">
    {{ $courses->links() }}
</div>
@include('layouts.confirm')
@include('layouts.course.assign_trainee')
<script>
    localStorage.clear();

    $('.add-course').popup !== undefined ? $('.add-course').popup({
        position : 'top center',
        content : 'Add New Course'
    }) : void 0;

    $('.del-course-multi').popup !== undefined ? $('.del-course-multi').popup({
        position : 'top center',
        content : 'Delete Course Selected'
    }) : void 0;

    $('.btn-excel').popup !== undefined ? $('.btn-excel').popup({
        position : 'top center',
        content : 'Export Excel'
    }) : void 0;

    $('.btn-csv').popup !== undefined ? $('.btn-csv').popup({
        position : 'top center',
        content : 'Export CSV'
    }) : void 0;

    $('form[id="delRoute"]').submit(function (e) {
        e.preventDefault();
    });

    function isset(val){
        return !_.isUndefined(val) && !_.isNull(val);
    }

    $('.btn-confirm').click(function () {

        var selected = localStorage.getItem('selected');
        var courses = localStorage.getItem('courseList');
        if (!isset(selected) && courses !== undefined) {
            $.ajax({
                url : 'destroySelected',
                data : {
                    ids : JSON.parse(courses)
                },
                type : 'POST',
                beforeSend : function (){
                    $('#confirmModal').modal('hide');
                    app.Loading('show');

                }
            }).done(function(res){
                setTimeout(function(){
                    app.Loading('hide');
                    $('.result-msg').show(1000);
                    $('.result-msg-content').text('Delete Courses Success!');
                   setTimeout(function(){
                       $('.result-msg').hide(1000);
                   },2000);
                },400)
            })
        } else {
            var formName = 'delRoute' + selected;
            $('form[name="' + formName + '"]').unbind('submit');
            $('form[name="' + formName + '"]').submit();
        }
    })

    $('.del-course').click(function () {
        $('#confirmModal').modal('show');
    })

    function saveSelect(id) {
        localStorage.setItem('selected', id);
    }

    function del(id) {
        var formName = 'delRoute' + id;
        $('form[name=' + formName + ']').submit();
    }

    $('.prompt').change(function () {
        app.Loading('show');
        $('input[name="term"]').val($('.prompt').val());
        setTimeout(function () {
            $('form[name="search"]').submit();
        }, 500);
    })

    function saveStorage(id) {
        var checked = $('input[name="radio-' + id + '"]').prop('checked');
        var list = localStorage.getItem('courseList');
        list = _.isUndefined(list) || _.isNull(list) ? null : JSON.parse(list);
        if (_.isArray(list)  && !_.isEmpty(list)) {
            var find = _.find(list, function (element) {
                return id === element;
            });
            if (find === undefined) {
                if(checked) {
                    list.push(id);
                }
                localStorage.setItem('courseList', JSON.stringify(list));
            } else {
                if(!checked) {
                    var index = _.indexOf(list, "" + id);
                    list.splice(index,1);
                    localStorage.setItem('courseList', JSON.stringify(list));
                }
            }

        } else {
            if (checked) {
                localStorage.setItem('courseList', JSON.stringify([id]));
            }
        }
    }

    $('#confirmModal').on('hidden.bs.modal',function(){
        $('.modal-body').text('Are you sure?');
        localStorage.removeItem('selected');
        $('.btn-confirm').prop('disabled',false);
    })

    $('.del-course-multi').click(function(){
        var courses = localStorage.getItem('courseList');
        if(_.isUndefined(courses) || _.isNull(courses))
        {
            $('.modal-body').text('Please select courses before delete!');
            $('.btn-confirm').prop('disabled',true);
            $('#confirmModal').modal('show');
            return;
        }else {
            $('#confirmModal').modal('show');
        }
    });

    function openAssign(courseName, courseId)
    {
        $('#assignModal').modal('show');
        $('course').text(courseName);
        $('#assignModal').attr('course-current', courseId);
        console.log($('#assignModal').attr('course-current'));
    }

</script>
