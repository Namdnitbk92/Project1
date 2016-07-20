@extends('layouts.master')

@section('title', 'Login app')

@section('content')
	 
	 <div class="login-container ui middle aligned center aligned grid">
		  <div class="column">
		    <h2 class="ui teal image header">
		      <img src="{{ URL::asset('images/framgia.png') }}" class="image">
		      <div class="content">
		        Log-in to your account
		      </div>
		    </h2>
		    <form class="ui large form form-login">
		     {{ csrf_field() }}
		      <div class="ui stacked segment">
		        <div class="field">
		          <div class="ui left icon input">
		            <i class="icon-login fa fa-user"></i>
		            <input type="text" name="email" placeholder="E-mail address">
		          </div>
		        </div>
		        <div class="field">
		          <div class="ui left icon input">
		            <i class="fa fa-lock icon-login"></i>
		            <input type="password" name="password" placeholder="Password">
		          </div>
		        </div>
		        <div class="ui fluid large teal submit button btn-login">Login</div>
		      </div>

		      <div class="ui error message"></div>

		    </form>

		    <div class="ui message">
		      New to us? <a href="#">Sign Up</a>
		    </div>
		  </div>
		</div>

@endsection