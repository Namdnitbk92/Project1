@extends('layouts.app')

@section('content')
 <!-- <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
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
              New to us? <a class='sign-up' href="<!-- {{ url('/register') }} -->">Sign Up</a>
            </div>

            <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>

            <div class="social-container">
              <button class="ui circular facebook icon button">
                  <i class="facebook icon"></i>
                </button>
                <button class="ui circular twitter icon button">
                  <i class="twitter icon"></i>
                </button>
                <button class="ui circular linkedin icon button">
                  <i class="linkedin icon"></i>
                </button>
                <button class="ui circular google plus icon button">
                  <i class="google plus icon"></i>
                </button>
          </div> 
          </div>
        </div>

@endsection
