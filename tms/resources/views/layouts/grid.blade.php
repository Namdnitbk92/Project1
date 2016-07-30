<div class="responstable-toolbar">
  <button class="ui circular blue icon button add-course" onclick="app.redirect(&quot;{{route('course.create')}}&quot;)">
       <i class="add icon"></i>
  </button>

  <button class="ui circular red icon button del-course">
       <i class="trash icon"></i>
  </button>

  <div class="f-right">
      <div class="ui fluid category search">
        <div class="ui icon input">
          <input class="prompt" type="text" placeholder="Search animals...">
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
      <th><span>Name</span></th>
      <th>Subject of course</th>
      <th>Start Date</th>
      <th>End Date</th>
      <th>Description</th>
      <th>Status</th>
      <th>Image</th>
      <th>Action</th>
    </tr>
    @foreach ($courses as $course)
    <tr>
      <td><input type="radio"></td>
      <td>{{ $course->name }}</td>
      <td>{{ $course->name }}</td>
      <td>{{ $course->start_date }}</td>
      <td>{{ $course->end_date }}</td>
      <td>{{ $course->description }}</td>
      <td>{{ $course->status }}</td>
      <td>{{ $course->image_url }}</td>
      <td>
      <button class="ui circular facebook icon button">
  		  <i class="facebook icon"></i>
  		</button>
  		<button class="ui circular twitter icon button">
  		  <i class="twitter icon"></i>
  		</button>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
<div class="paginate f-right">
  {{ $courses->links() }}
</div>
