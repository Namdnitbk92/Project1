@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 body-content">
        @if(session()->has('success') || session()->has('errors'))
        <div class="ui message {{ session()->has('success') ? ' info' : ' warning'  }}}}">
            <div class="header">
                Notifcation
            </div>
            <p>{{ session()->has('success') ? session('success') : session('errors') }}</p>
        </div>
        @endif
        <div class="panel panel-default">
            <div class="panel-heading">
            	Course List
            </div>
            <div class="panel-body">
            	@include('layouts.grid')
            </div>
        </div>
    </div>
</div>
@endsection
