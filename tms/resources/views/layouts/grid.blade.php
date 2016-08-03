<div class="responstable-toolbar">
    <button class="ui circular blue icon button add-course"
            onclick="app.redirect(&quot;{{route('course.create')}}&quot;)">
        <i class="add icon"></i>
    </button>

    <button class="ui circular red icon button del-course">
        <i class="trash icon"></i>
    </button>

    <button class="ui circular yellow icon button btn-excel">
        <i class="file excel outline icon"></i>
    </button>

    <div class="f-right">
        <div class="ui fluid category search">
            <div class="ui icon input">
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
    @foreach ($courses as $course)
        {{ Form::open(['method' => 'DELETE', 'route' => ['course.destroy', $course->id], 'name' => 'delRoute'.$course->id, 'id'=>'delRoute']) }}
        <tr>
            <td><input type="radio"></td>
            <td>{{ $course->id }}</td>
            <td>{{ $course->name }}</td>
            <td>{{ $course->start_date }}</td>
            <td>{{ $course->end_date }}</td>
            <td>{{ $course->description }}</td>
            <td>
                <div class="field">
                    <button class="ui circular facebook icon button"
                            onclick="app.redirect(&quot;{{route('course.edit', ['course' => $course->id])}}&quot;)">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button class="ui circular twitter icon button"
                            onclick="app.redirect(&quot;{{route('course.show', ['course' => $course->id])}}&quot;)">
                        <i class="info icon"></i>
                    </button>
                    <button class="ui circular red icon button del-course" type="submit" onclick="saveSelect('{{$course->id}}')">
                        <i class="trash icon"></i>
                    </button>
                </div>
            </td>
        </tr>
        {{ Form::close() }}
    @endforeach
    </tbody>
</table>
<div class="paginate f-right">
    {{ $courses->links() }}
</div>
@include('layouts.confirm')
<script>

    $('form[id="delRoute"]').submit(function(e){
        e.preventDefault();
    });

    $('.btn-confirm').click(function(){

        var selected  = localStorage.getItem('selected');
        if(typeof selected === undefined)
            return;

        var formName = 'delRoute' + selected;
        $('form[name="'+ formName +'"]').unbind('submit');
        $('form[name="'+ formName +'"]').submit();
    })

    $('.del-course').click(function(){
        $('#confirmModal').modal('show');
    })

    function saveSelect(id){
        localStorage.setItem('selected',id);
    }

   function del(id){
       var formName = 'delRoute' + id;
       $('form[name='+ formName +']').submit();
   }

</script>
