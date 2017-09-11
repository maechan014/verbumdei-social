@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel-head">    
                <center><h1>Register</h1></center>
            </div>  
        </div>
        <div class="col-md-8 col-md-offset-2">
            <!-- <center><h1>Register</h1></center> -->
            <!-- <hr> -->
            <div class="panel panel-default">

                <div class="panel-body">
                    @if(session()->has('response') || $errors->count() > 0)
                    <div class="alert alert-danger fade in">
                        <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <strong>Failed to register!</strong> 
                        <span class="message">
                            @if(session()->has('response')){{ session('response')->msg }}@endif
                            @if($errors->count() > 0)
                                  <ul>
                                    @foreach( $errors->all() as $message )
                                      <li>{{ $message }}</li>
                                    @endforeach
                                  </ul>
                            @endif
                        </span>
                    </div>
                    @endif
                    <form class="form-horizontal" method="POST" action="{{ url('register') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <!-- <label for="username" class="col-md-4 control-label">Username</label> -->

                            <div class="col-md-6 col-md-offset-3">
                                <input id="username" type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <!-- <label for="password" class="col-md-4 control-label">Password</label> -->

                            <div class="col-md-6 col-md-offset-3">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Password" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <!-- <label for="password_confirmation" class="col-md-4 control-label">Password Confirmation</label> -->

                            <div class="col-md-6 col-md-offset-3">
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <!-- <label for="firstName" class="col-md-4 control-label">First Name</label> -->

                            <div class="col-md-6 col-md-offset-3">
                                <input id="firstName" type="text" class="form-control" name="firstName" placeholder="First Name" required autofocus>
                            </div>
                        </div>


                        <div class="form-group">
                            <!-- <label for="lastName" class="col-md-4 control-label">Last Name</label> -->

                            <div class="col-md-6 col-md-offset-3">
                                <input id="lastName" type="text" class="form-control" name="lastName" placeholder="Last Name" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <!-- <label for="middleName" class="col-md-4 control-label">Middle Name</label> -->

                            <div class="col-md-6 col-md-offset-3">
                                <input id="middleName" type="text" class="form-control" name="middleName" placeholder="Middle Name" required autofocus>
                            </div>
                        </div>


                        <div class="form-group">
                            <!-- <label for="email" class="col-md-4 control-label">Email Address</label> -->

                            <div class="col-md-6 col-md-offset-3">
                                <input id="email" type="email" class="form-control" name="email" placeholder="Email" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <!-- <label for="mobile" class="col-md-4 control-label">Mobile Number</label> -->

                            <div class="col-md-6 col-md-offset-3">
                                <input id="mobile" type="text" class="form-control" name="mobile" placeholder="Mobile" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <!-- <label for="name" class="col-md-4 control-label">Community</label> -->

                            <div class="col-md-6 col-md-offset-3">
                                <select id="community" class="form-control" name="community">
                                    <option value="">Select Community</option>
                                    @if($communities->success)
                                        @foreach($communities->result as $community)
                                            <option value="{{$community->branchId}}">{{$community->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="form-group logreg-btn">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>

                        <hr class="divider">

                         <!-- SOCIAL AUTH BUTTONS -->
                        <div class="form-group text-center">
                            <div class="col-md-6 col-md-offset-3" id="social-btn">

                                <a href="{{ url('/auth/twitter') }}" class="btn btn-twitter social-login-btn social-twt"><i class="fa fa-twitter"></i></a>
                                <a href="{{ url('/auth/facebook') }}" class="btn btn-facebook social-login-btn social-fb"><i class="fa fa-facebook"></i></a>
                                <a href="{{ url('/auth/google') }}" class="btn btn-google social-login-btn social-google"><i class="fa fa-google"></i></a>
                                <a href="{{ url('/auth/linkedin') }}" class="btn btn-linkedin social-login-btn social-linkedin"><i class="fa fa-linkedin"></i></a>
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
<script type="text/javascript">
    $('form').on('click', 'button', function(e){
        var username    = $("#username").val(), 
            password    = $("#password").val(),
            password_confirmation = $("#password_confirmation").val(),
            firstName   = $("#firstName").val(),
            middleName  = $("#middleName").val(),
            lastName    = $("#lastName").val(),
            email       = $("#email").val(),
            mobile      = $("#mobile").val(),
            community   = $("#community").val();
        

        if(!username || !password || !firstName || !middleName || !lastName || !email || !mobile || !community) {
            e.preventDefault();
            if(!username) $("#username").parents('.form-group').addClass('has-error'); 
                else $("#username").parents('.form-group').removeClass('has-error');
            if(!password) $("#password").parents('.form-group').addClass('has-error'); 
                else $("#password").parents('.form-group').removeClass('has-error');
            if(!password_confirmation) $("#password_confirmation").parents('.form-group').addClass('has-error'); 
                else $("#password_confirmation").parents('.form-group').removeClass('has-error');
            if(!firstName) $("#firstName").parents('.form-group').addClass('has-error'); 
                else $("#firstName").parents('.form-group').removeClass('has-error');
            if(!middleName) $("#middleName").parents('.form-group').addClass('has-error'); 
                else $("#middleName").parents('.form-group').removeClass('has-error');
            if(!lastName) $("#lastName").parents('.form-group').addClass('has-error'); 
                else $("#lastName").parents('.form-group').removeClass('has-error');
            if(!email) $("#email").parents('.form-group').addClass('has-error'); 
                else $("#email").parents('.form-group').removeClass('has-error');
            if(!mobile) $("#mobile").parents('.form-group').addClass('has-error'); 
                else $("#mobile").parents('.form-group').removeClass('has-error');
            if(!community) $("#community").parents('.form-group').addClass('has-error'); 
                else $("#community").parents('.form-group').removeClass('has-error');
        } else {
            // $("#error-message").hide();
            // $('.form-group').each(function() {
            //     $(this).removeClass('has-error');
            // });
            // $.ajax({
            //   type: 'POST',
            //   url: 'http://52.74.115.167:703/index.php',
            //   crossDomain: true,
            //   data: {
            //     mtmaccess_api: true, 
            //     transaction: 20004, 
            //     userName: username,
            //     passWord: MD5(password),
            //     firstName: firstName,
            //     middleName: middleName,
            //     lastName: lastName,
            //     email: email,
            //     mobile: mobile,
            //     community: community
            //   },
            //   cache: false,
            //   success: function(data) {
            //     var data = JSON.parse(data);
            //     console.log(data);
            //     if(!data.success) {
            //         $("#error-message .message").html(data.msg);
            //         $("#error-message").show();
            //     } else {
            //         window.location = "{{ url('/') }}?usertype=client&username="+username+"&password="+password;
            //     }
            //   }
            // });
        }
    });
</script>
@endsection