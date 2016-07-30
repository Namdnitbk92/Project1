@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 body-content">
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
