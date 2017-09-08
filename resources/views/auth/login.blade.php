@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <center><h1>LOGIN</h1></center>
            <hr>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="error-message" @if(!session()->has('response'))style="display: none;"@endif class="alert alert-danger fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Error!</strong> <span class="message">@if(session()->has('response')){{ session('response')->msg }}@endif</span>
                    </div>
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input id="username" type="username" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                                <a class="btn btn-default" href="{{url('register')}}">Register</a>
                                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>

                         <!-- SOCIAL AUTH BUTTONS -->
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <a href="{{ url('/auth/twitter') }}" class="btn btn-twitter"><i class="fa fa-twitter"></i> Twitter</a>
                                <a href="{{ url('/auth/facebook') }}" class="btn btn-facebook"><i class="fa fa-facebook"></i> Facebook</a>
                                <a href="{{ url('/auth/google') }}" class="btn btn-google"><i class="fa fa-google"></i> Google</a>
                                <a href="{{ url('/auth/linkedin') }}" class="btn btn-linkedin"><i class="fa fa-linkedin"></i> LinkedIn</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<!-- http://52.74.115.167:703/index.php?mtmaccess_api=true&transaction=20020&userName=test6&passWord=81dc9bdb52d04dc20036dbd8313ed055&profileId=314 -->
<script type="text/javascript">

    $('form').on('click', 'button', function(e){
        var username = $("#username").val(),
            password = $("#password").val();

        if(!username || !password) {
            e.preventDefault();
            $("#error-message").show();
            $("#error-message .message").html("Please input all fields.");
            if(!username) $("#username").parents('.form-group').addClass('has-error'); 
                else $("#username").parents('.form-group').removeClass('has-error');
            if(!password) $("#password").parents('.form-group').addClass('has-error'); 
                else $("#password").parents('.form-group').removeClass('has-error');
        }
    });
</script>
@endsection