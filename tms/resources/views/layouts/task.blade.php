

@extends('layouts.master')

@section('title', 'Page Title')

@section('content')
    <!-- Create Task Form... -->

</div>
    <div class="row">
    	<div class="col-md-6 col-lg-6">
    		<div class="panel-body">
        <!-- New Task Form -->

		         <div class="panel panel-default">
			            <div class="panel-heading">
			               New Task
			            </div>

			            <div class="panel-body">
			                 <form action="{{ url('task') }}" method="POST" class="form-horizontal">
					            {{ csrf_field() }}
					            <!-- Task Name -->
					            <div class="form-group">
					                <label for="task" class="col-sm-3 control-label">Task</label>

					                <div class="col-sm-6">
					                    <input type="text" name="name" id="task-name" class="form-control">
					                </div>
					            </div>

					            <!-- Add Task Button -->
					            <div class="form-group">
					                <div class="col-sm-offset-3 col-sm-6">
					                    <button type="submit" class="btn btn-default btn-primary">
					                        <i class="fa fa-plus"></i> Add Task
					                    </button>
					                </div>
					            </div>
					        </form>
			            </div>
			    </div>

		         <div class="panel panel-default">
			            <div class="panel-heading">
			                Current Tasks
			            </div>

			            <div class="panel-body">
			                <table class="table table-striped task-table">
			                	 <!-- Table Headings -->
			                    <thead>
			                        <th col="80%">Task</th>
			                        <th>	
			                        	Action
			                        </th>
			                    </thead>
			                    <!-- Table Body -->
			                    <?php  $tasks = App\Task::paginate(2); ?>
			                    	@if (!empty($tasks))
				                        @foreach ($tasks as $task)
				                            <tr class="test">
				                                <!-- Task Name -->
				                                <td class="table-text">
				                                    <div>{{ $task->name }}</div>
				                                </td>

				                                <td>
				                                    <button class='btn btn-warning'><i class='fa fa-trash-o'></i></button>
				                                    <button class='btn btn-default'><i class='fa fa-edit'></i></button>
				                                </td>
				                            </tr>
				                        @endforeach
				                    @else
				                    	 <td class="text-center">Empty Task</td> 
				                    @endif   
			                    </tbody>
			                </table>
			                @if (!empty($tasks))
			                <div class="pagination" style="float:right;"> {{ $tasks->links() }} </div>
			                @endif
			            </div>
			    </div>
		    </div>
    	</div>
    	<div class="col-md-6 col-lg-6">
    		<div class="panel-body">
        <!-- New Trainee Form -->

		         <div class="panel panel-default">
			            <div class="panel-heading">
			               New Trainee
			            </div>

			            <div class="panel-body">
			                 <form action="{{ url('task') }}" method="POST" class="form-horizontal">
					            {{ csrf_field() }}
					            <!-- Task Name -->
					            <div class="form-group">
					                <label for="task" class="col-sm-3 control-label">Trainee Name</label>

					                <div class="col-sm-6">
					                    <input type="text" name="name" id="task-name" class="form-control">
					                </div>
					            </div>

					            <!-- Add Task Button -->
					            <div class="form-group">
					                <div class="col-sm-offset-3 col-sm-6">
					                    <button type="submit" class="btn btn-default btn-primary">
					                        <i class="fa fa-plus"></i> Add Trainee
					                    </button>
					                </div>
					            </div>
					        </form>
			            </div>
			    </div>

		         <div class="panel panel-default">
			            <div class="panel-heading">
			                Current Trainee
			            </div>

			            <div class="panel-body">
			                <table class="table table-striped task-table">
			                	 <!-- Table Headings -->
			                    <thead>
			                        <th>Trainee Name</th>
			                        <th>&nbsp;</th>
			                    </thead>
			                    <!-- Table Body -->
			                    <?php  $tasks = App\Trainee::all(); ?>
			                    	@if (!empty($tasks))
				                        @foreach ($tasks as $task)
				                            <tr>
				                                <!-- Task Name -->
				                                <td class="table-text">
				                                    <div>{{ $task->name }}</div>
				                                </td>

				                                <td>
				                                    <!-- TODO: Delete Button -->
				                                </td>
				                            </tr>
				                        @endforeach
				                    @else
				                    	 <td class="text-center">Empty Trainee</td> 
				                    @endif   
			                    </tbody>
			                </table>
			            </div>
			    </div>
		    </div>	
    	</div>
    </div>
     

     <h3 class="ui center aligned header">Responsive Item</h3>

<div class="ui container">
  <div class="ui relaxed divided items">
    <div class="item">
      <div class="ui small image">
        <img src="assets/images/wireframe/image.png">
      </div>
      <div class="content">
        <a class="header">Content Header</a>
        <div class="meta">
          <a>Date</a>
          <a>Category</a>
        </div>
        <div class="description">
          A description which may flow for several lines and give context to the content.
        </div>
        <div class="extra">
          <img src="assets/images/wireframe/square-image.png" class="ui circular avatar image"> Username
        </div>
      </div>
    </div>
    <div class="item">
      <div class="ui small image">
        <img src="assets/images/wireframe/image.png">
      </div>
      <div class="content">
        <a class="header">Content Header</a>
        <div class="meta">
          <a>Date</a>
          <a>Category</a>
        </div>
        <div class="description">
          A description which may flow for several lines and give context to the content.
        </div>
        <div class="extra">
          <div class="ui right floated primary button">
            Primary
            <i class="right chevron icon"></i>
          </div>
          <div class="ui label">Limited</div>
        </div>
      </div>
    </div>
    <div class="item">
      <div class="ui small image">
        <img src="assets/images/wireframe/image.png">
      </div>
      <div class="content">
        <a class="header">Content Header</a>
        <div class="meta">
          <a>Date</a>
          <a>Category</a>
        </div>
        <div class="description">
          A description which may flow for several lines and give context to the content.
        </div>
        <div class="extra">
          <div class="ui right floated primary button">
            Primary
            <i class="right chevron icon"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection