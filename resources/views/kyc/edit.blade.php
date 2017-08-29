@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-md-offset-">
            <div class="panel with-nav-tabs panel-default">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1default" data-toggle="tab">Primary</a></li>
                            <li><a href="#tab2default" data-toggle="tab">Extended</a></li>
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1default">
                            <div id="error-message" @if(!session()->has('response'))style="display: none;"@endif class="alert @if(session()->has('response')){{ session('response')->success ? "alert-success" : "alert-danger" }}@endif fade in">
                                <a href="#" class="close" data-dismiss="alert">&times;</a>
                                <span class="message">@if(session()->has('response')){{ session('response')->msg }}@endif</span>
                            </div>

                            <form method="POST" action="{{ route('profile/update', ['profileId'=>$user->profileId]) }}">
                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-5">
                                        <div class="form-group">
                                            <input type="text" name="firstname" id="firstname" class="form-control input-lg" placeholder="First Name*" required value="{{ (isset($user))  ? $user->firstname : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-2">
                                        <div class="form-group">
                                            <input type="text" name="middlename" id="middlename" class="form-control input-lg" placeholder="Middle Name" value="{{ (isset($user))  ? $user->middlename : '' }}">
                                        </div>

                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-5">
                                        <div class="form-group">
                                            <input type="text" name="lastname" id="lastname" class="form-control input-lg" placeholder="Last Name*" required value="{{ (isset($user))  ? $user->lastname : '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <!-- <select class="regions select2-form form-control" name="region" id="region"></select> -->
                                            <input type="text" name="region" id="region" class="region form-control input-lg" placeholder="Region" value="{{ (isset($user))  ? $user->p_region : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                                <!-- <select class="province select2-form form-control" name="province" id="province"></select> -->
                                            <input type="text" name="province" id="province" class="province form-control input-lg" placeholder="Province" value="{{ (isset($user))  ? $user->p_province : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <!-- <select class="city select2-form form-control" name="city" id="city"></select> -->
                                            <input type="text" name="city" id="city" class="city form-control input-lg" placeholder="City" value="{{ (isset($user))  ? $user->p_cityOrMunicipal : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <!-- <select class="barangay select2-form form-control" name="barangay" id="barangay"></select> -->
                                            <input type="text" name="barangay" id="barangay" class="barangay form-control input-lg" placeholder="Barangay" value="{{ (isset($user))  ? $user->p_barangay : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="street" id="street" class="form-control input-lg" placeholder="Street Address" value="{{ (isset($user))  ? $user->p_streetAddress : '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email*" value="{{ (isset($user))  ? $user->p_email : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="mobile" id="mobile" class="form-control input-lg" placeholder="Contact" value="{{ (isset($user))  ? $user->p_mobileNumber : '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="tab2default">
                            <div id="error-message" @if(!session()->has('response'))style="display: none;"@endif class="alert @if(session()->has('response')){{ session('response')->success ? "alert-success" : "alert-danger" }}@endif fade in">
                                <a href="#" class="close" data-dismiss="alert">&times;</a>
                                <span class="message">@if(session()->has('response')){{ session('response')->msg }}@endif</span>
                            </div>

                            <form method="POST" action="{{ route('profile/update', ['profileId'=>$user->profileId]) }}">
                                {{ csrf_field() }}

                               <!--  <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-5">
                                        <div class="form-group">
                                            <input type="text" name="firstname" id="firstname" class="form-control input-lg" placeholder="First Name*" required value="{{ (isset($user))  ? $user->firstname : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-2">
                                        <div class="form-group">
                                            <input type="text" name="middlename" id="middlename" class="form-control input-lg" placeholder="Middle Name" value="{{ (isset($user))  ? $user->middlename : '' }}">
                                        </div>

                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-5">
                                        <div class="form-group">
                                            <input type="text" name="lastname" id="lastname" class="form-control input-lg" placeholder="Last Name*" required value="{{ (isset($user))  ? $user->lastname : '' }}">
                                        </div>
                                    </div>
                                </div> -->

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <!-- <select class="regions select2-form form-control" name="region" id="region"></select> -->
                                            <input type="text" name="region" id="region" class="region form-control input-lg" placeholder="Region" value="{{ (isset($user))  ? $user->p_region : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                                <!-- <select class="province select2-form form-control" name="province" id="province"></select> -->
                                            <input type="text" name="province" id="province" class="province form-control input-lg" placeholder="Province" value="{{ (isset($user))  ? $user->p_province : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <!-- <select class="city select2-form form-control" name="city" id="city"></select> -->
                                            <input type="text" name="city" id="city" class="city form-control input-lg" placeholder="City" value="{{ (isset($user))  ? $user->p_cityOrMunicipal : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <!-- <select class="barangay select2-form form-control" name="barangay" id="barangay"></select> -->
                                            <input type="text" name="barangay" id="barangay" class="barangay form-control input-lg" placeholder="Barangay" value="{{ (isset($user))  ? $user->p_barangay : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="street" id="street" class="form-control input-lg" placeholder="Street Address" value="{{ (isset($user))  ? $user->p_streetAddress : '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email*" value="{{ (isset($user))  ? $user->p_email : '' }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="mobile" id="mobile" class="form-control input-lg" placeholder="Contact" value="{{ (isset($user))  ? $user->p_mobileNumber : '' }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="pull-right">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="tab3default">Default 3</div>
                        <div class="tab-pane fade" id="tab4default">Default 4</div>
                        <div class="tab-pane fade" id="tab5default">Default 5</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    $('form').on('click', 'button', function(e){
        var firstname = $("#firstname").val(),
            lastname = $("#lastname").val(),
            email = $("#email").val();
        if(!firstname || !password) {
            e.preventDefault();
            $("#error-message").show();
            $("#error-message .message").html("Please input all fields.");
            $("#error-message").addClass("alert-danger");
            if(!firstname) $("#firstname").parents('.form-group').addClass('has-error'); 
                else $("#firstname").parents('.form-group').removeClass('has-error');
            if(!lastname) $("#lastname").parents('.form-group').addClass('has-error'); 
                else $("#lastname").parents('.form-group').removeClass('has-error');
            if(!email) $("#email").parents('.form-group').addClass('has-error'); 
                else $("#email").parents('.form-group').removeClass('has-error');
        }
    });
</script>
@endsection