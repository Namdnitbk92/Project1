            
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav in" id="side-menu">
            <li>
                <a href="{{ route('dashboard') }}" class="active"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li class="">
                <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts<span class="fa arrow"></span></a>
            </li>
            <li>
                <a href="{{ course_list() }}"><i class="fa fa-table fa-fw"></i> Course</a>
            </li>
            <li>
            @can('is_user', Auth::user())
                <a href="{{ route('user.subject.index', ['user' => auth()->user()->id]) }}"><i class="fa fa-book fa-fw"></i> Subject</a>
            @else
                <a href=""><i class="fa fa-book fa-fw"></i> Subject</a>
            @endcan
            </li>
            <li>
                <a href="forms.html"><i class="fa fa-tasks fa-fw"></i> Task</a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
