<html>
    <head>
        <title>App Name - @yield('title')</title>
        <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/font-awesome/css/1.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/font-awesome/css/2.css') }}">
        <link rel="stylesheet" href="{{ URL::asset('css/semantic.min.css') }}">

        <script type="text/javascript" src="{{ URL::asset('js/jquery.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/semantic.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('js/all.js') }}"></script>
    </head>
    <?php $currentPath = Route::getCurrentRoute()->getPath();?>
    @if($currentPath !== 'login')
    <body class="task-content">
    @else
     <body class="task-content" style="background:aliceblue;">
    @endif
        <div id="_loader" class="loadingArea" style="display: none;">
          <img src="{{ URL::asset('images/loading.gif') }}" alt="Loading..."> 
          <p>Loading...</p>
        </div>
       
        @if($currentPath !== 'login')
            <div id="_globalHeader" class="globalHeader">
                  <!-- start header -->
                <div id="_inner" role="banner" class="inner"></div>
                <h1 id="_logo">
                   <img class="logo_framgia" src="{{ URL::asset('images/framgia.png') }}" alt="Framgia">
                </h1>
                <div id="_headerSearch" class="headerSearch">
                  <div class="search"><span class="icoFontSearch icSearch"><i class="fa fa-search"></i></span><span class="_cwSBCancel icoFontCancel icSearchCancel icoSizeLarge" style="display:none"></span><input id="_search" class="_searchBox inputLong _cwSB searchBox" type="text" name="search" placeholder="Type to search for chat/message" role="search"></div>
                </div>
            </div>  
        @endif
        @section('sidebar')
        @show
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>