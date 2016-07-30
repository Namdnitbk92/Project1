<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ URL::asset('css/font-awesome/css/1.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/font-awesome/css/2.css') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/semantic.min.css') }}">

    <!-- data tables css -->
     <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">

    <style>
        body {
            font-family: 'Lato';
        }
    </style>
</head>
<body id="app-layout">

    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <i class="fa fa-dropbox"></i>
                <a style="outline : none;" href="{{url('/')}}">TMS System</a>
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <!-- <a class="navbar-brand" href="{{ url('/') }}">
                    Laravel
                </a> -->
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <div class="input-group custom-search-form input-search col-md-5 col-sm-5 col-lg-5">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
                <!-- Left Side Of Navbar -->
                <!-- <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}"> <i class="fa fa-home"></i>  Home</a></li>
                </ul> -->

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right margin-top-3">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}"> <i class="fa fa-sign-in"></i>    Login</a></li>
                        <!-- <li><a href="{{ url('/register') }}">Register</a></li> -->
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                <img class="avatar" src="{{Auth::user()->avatar }}"/>
                                &nbsp;&nbsp;{{ Auth::user()->name}} <span class="caret"></span>
                                <!-- <img src="{{ Gravatar::src(Auth::user()->email,50) }}"> -->
                            </a>
                            <!-- <mail>{{ Auth::user()->email}}</mail> --> 
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out fa-fw"></i>Logout</a></li>
                                <li><a href="{{ url('/profile') }}"><i class="fa fa-btn fa-user fa-fw"></i>Profile</a></li>
                                <li><a href="{{ url('/profile') }}"><i class="fa fa-btn fa-bolt fa-fw"></i>Languages</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        @if (!Auth::guest())
        @include('layouts.navbar')
        <!-- <div class="top-left ui breadcrumb">
              <a class="section">Home</a>
              <i class="right angle icon divider"></i>
              <div class="active section">Course</div>
        </div> -->
        @endif
    </nav>
    <script type="text/javascript" src="{{ URL::asset('js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/semantic.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/underscore.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/bootstrap.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/all.js') }}"></script>

    <!-- data tables JQuery -->
   <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
        $.ajaxSetup({
           headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
        });
    </script>
    @if (!Auth::guest())
    <div id="page-wrapper">
        @yield('content')    
    </div>
    @else
         @yield('content')    
    @endif
</body>
</html>
