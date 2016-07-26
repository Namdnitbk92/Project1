@extends('layouts.app')

@section('content')

 <div id="_loader" class="loadingArea" style="display: none;">
      <img src="{{ URL::asset('images/loading.gif') }}" alt="Loading..."> 
      <p>Loading...</p>
</div>

<div class="login-container ui middle aligned center aligned grid">
       <!--  <img src="{{ URL::asset('images/framgia.png') }}" class="image"> -->
          <div class="column">
            <h2 class="ui teal image header">
              <div class="content">
                Log-in to your account
              </div>
            </h2>
            <form class="ui large form form-login" method="POST" action="{{ url('/login') }}">
            {{ csrf_field() }}
              <div class="ui stacked segment">
                <div class="field">
                  <div class="ui left icon input {{ $errors->has('email') ? ' has-error' : '' }}">
                    <i class="icon-login fa fa-user"></i>
                    <input type="email" name="email" placeholder="E-mail address" value="{{ old('email') }}">
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="field">
                  <div class="ui left icon input {{ $errors->has('password') ? ' has-error' : '' }}">
                    <i class="fa fa-lock icon-login"></i>
                    <input type="password" name="password" placeholder="Password" value="{{ old('password') }}">
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <button type="submit" class="ui fluid large teal submit button btn-login">Login</button>
              </div>

              <div class="ui error message"></div>

            </form>

            <div class="ui">
              New to us? <a class='sign-up' data-toggle="modal" data-target="#registerModal" >Sign Up</a>
            </div>
            <!-- href=" {{ url('/register') }} " --> 
            <a class="btn btn-link" data-toggle="modal" data-target="#resetPasswordModal">Forgot Your Password?</a>

            <div class="social-container">
                <a class="ui circular facebook icon button" href="login/facebook/redirect"> 
                  <i class="facebook icon"></i>
                </a>
                <a class="ui circular twitter icon button" href="login/twitter/redirect">
                  <i class="twitter icon"></i>
                </a>
                <a class="ui circular linkedin icon button">
                  <i class="linkedin icon"></i>
                </a>
                <a class="ui circular google plus icon button" href="login/google/redirect">
                  <i class="google plus icon"></i>
                </a>
          </div> 
          </div>
        </div>
        @if(Auth::guest())
            @include('auth.register')
            @include('auth.passwords.email')
        @endif
@endsection
