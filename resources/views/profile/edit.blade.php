@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Profile</h3>
            <hr>
            <div class="col-md-8 col-md-offset-2">
                <div id="error-message" @if(!session()->has('response'))style="display: none;"@endif class="alert @if(session()->has('response')){{ session('response')->success ? "alert-success" : "alert-danger" }}@endif fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <span class="message">@if(session()->has('response')){{ session('response')->msg }}@endif</span>
                </div>
                <div class="panel with-nav-tabs panel-default">
                    <div class="panel-heading">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#Personal" data-toggle="tab">Personal</a></li>
                                <li><a href="#Contact" data-toggle="tab">Contact</a></li>
                                <li><a href="#Benefeciaries" data-toggle="tab">Benefeciaries</a></li>
                            </ul>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="Personal">

                                <form class="form-horizontal" method="POST" action="{{ route('profile/update/personal', ['profileId'=>$user->profileId]) }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="saveType" value="personal">

                                    <div class="form-group">
                                        <label for="firstName" class="col-md-4 control-label">First Name*</label>
                                        <div class="col-md-6">
                                            <input id="firstName" type="text" class="form-control" name="firstName" value="{{ (isset($user))  ? $user->firstname : '' }}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="lastName" class="col-md-4 control-label">Last Name*</label>
                                        <div class="col-md-6">
                                            <input id="lastName" type="text" class="form-control" name="lastName" value="{{ (isset($user))  ? $user->lastname : '' }}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="middleName" class="col-md-4 control-label">Middle Name*</label>
                                        <div class="col-md-6">
                                            <input id="middleName" type="text" class="form-control" name="middleName" value="{{ (isset($user))  ? $user->middlename : '' }}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="motherMaidenName" class="col-md-4 control-label">Mother's Maiden Name*</label>
                                        <div class="col-md-6">
                                            <input id="motherMaidenName" type="text" class="form-control" name="motherMaidenName" value="{{ (isset($user))  ? $user->motherMaidenName : '' }}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="gender" class="col-md-4 control-label">Gender*</label>
                                        <div class="col-md-6">
                                            {{ Form::select('gender', 
                                                ['Male'=>'Male', 'Female'=>'Female'], 
                                                (isset($user))  ? $user->gender : '', 
                                                ['id' => 'gender', 'class' => 'form-control','placeholder' => '-Select Gender-']) 
                                            }}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="birthdate" class="col-md-4 control-label">Birthdate*</label>
                                        <div class="col-md-6">
                                            <div class="input-group date" data-provide="datepicker">
                                                <input type="text" class="form-control" id="birthdate" name="birthdate" }}" value="{{ (isset($user))  ? Carbon\Carbon::parse($user->birthDate)->format('m/d/Y') : '' }}">
                                                <div class="input-group-addon">
                                                    <span class="glyphicon glyphicon-th"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="birthplace" class="col-md-4 control-label">Birthplace*</label>
                                        <div class="col-md-6">
                                            <input id="birthplace" type="text" class="form-control" name="birthplace" value="{{ (isset($user))  ? $user->birthPlace : '' }}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nationality" class="col-md-4 control-label">Nationality*</label>
                                        <div class="col-md-6">
                                            <input id="nationality" type="text" class="form-control" name="nationality" value="{{ (isset($user))  ? $user->nationality : '' }}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="maritalStatus" class="col-md-4 control-label">Marital Status*</label>
                                        <div class="col-md-6">
                                            {{ Form::select('maritalStatus', 
                                                ['Single'=>'Single', 'Married'=>'Married', 'Widow'=>'Widow'], 
                                                (isset($user))  ? $user->maritalStatus : '', 
                                                ['id' => 'maritalStatus', 'class' => 'form-control','placeholder' => '-Select Marital Status-']) 
                                            }}
                                        </div>
                                    </div>

                                    <div id="spouse" style="display: none;">
                                        <div class="form-group">
                                            <label for="sp_firstName" class="col-md-4 control-label">Spouse First Name*</label>
                                            <div class="col-md-6">
                                                <input id="sp_firstName" type="text" value="{{ (isset($user))  ? $user->sp_firstName : '' }}" class="form-control" name="sp_firstName" autofocus>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sp_lastName" class="col-md-4 control-label">Spouse Last Name*</label>
                                            <div class="col-md-6">
                                                <input id="sp_lastName" type="text" value="{{ (isset($user))  ? $user->sp_lastName : '' }}" class="form-control" name="sp_lastName" autofocus>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="sp_middleName" class="col-md-4 control-label">Spouse Middle Name*</label>
                                            <div class="col-md-6">
                                                <input id="sp_middleName" type="text" value="{{ (isset($user))  ? $user->sp_middleName : '' }}" class="form-control" name="sp_middleName" autofocus>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade in" id="Contact">
                                <form class="form-horizontal" method="POST" action="{{ route('profile/update/contact', ['profileId'=>$user->profileId]) }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="saveType" value="contact">

                                    <div class="form-group">
                                        <label for="p_mobileNumber" class="col-md-4 control-label">Mobile Number</label>
                                        <div class="col-md-6">
                                            <input id="p_mobileNumber" type="text" class="form-control" name="p_mobileNumber" value="{{ (isset($user))  ? $user->p_mobileNumber : '' }}" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="p_contact" class="col-md-4 control-label">Telephone Number</label>
                                        <div class="col-md-6">
                                            <input id="p_contact" type="text" class="form-control" name="p_contact" value="{{ (isset($user))  ? $user->p_contact : '' }}" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="p_email" class="col-md-4 control-label">Email</label>
                                        <div class="col-md-6">
                                            <input id="p_email" type="text" class="form-control" name="p_email" value="{{ (isset($user))  ? $user->p_email : '' }}" autofocus>
                                        </div>
                                    </div>

                                    <hr>

                                    <h3 class="col-md-offset-2">Present Address*:</h3>

                                    <div class="form-group">
                                        <label for="p_region" class="col-md-4 control-label">Region*</label>
                                        <div class="col-md-6">
                                            <select class="form-control" id="p_region" name="p_region">
                                                <option value="">-Select Region-</option>
                                                @foreach($regions as $key => $region)
                                                    <option value="{{ $key }}">{{ $key }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="p_province" class="col-md-4 control-label">Province*</label>
                                        <div class="col-md-6">
                                            <select class="form-control" id="p_province" name="p_province">
                                                <option value="">-Select Province-</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="p_cityOrMunicipal" class="col-md-4 control-label">City or Municipal*</label>
                                        <div class="col-md-6">
                                            <select class="form-control" id="p_cityOrMunicipal" name="p_cityOrMunicipal">
                                                <option value="">-Select Municipal-</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="p_barangay" class="col-md-4 control-label">Barangay*</label>
                                        <div class="col-md-6">
                                            <select class="form-control" id="p_barangay" name="p_barangay">
                                                <option value="">-Select Barangay-</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="p_streetAddress" class="col-md-4 control-label">Street Address*</label>
                                        <div class="col-md-6">
                                            <input id="p_streetAddress" type="text" class="form-control" name="p_streetAddress" value="{{ (isset($user))  ? $user->p_streetAddress : '' }}" autofocus>
                                        </div>
                                    </div>

                                    <hr>

                                    <h3 class="col-md-offset-2">Home Address:</h3>

                                    <div class="form-group">
                                        <label for="h_region" class="col-md-4 control-label">Region</label>
                                        <div class="col-md-6">
                                            <select class="form-control" id="p_region" name="p_region">
                                                <option value="">-Select Region-</option>
                                                @foreach($regions as $key => $region)
                                                    <option value="{{ $key }}">{{ $key }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="h_province" class="col-md-4 control-label">Province</label>
                                        <div class="col-md-6">
                                            <select class="form-control" id="h_province" name="h_province">
                                                <option value="">-Select Province-</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="h_cityOrMunicipal" class="col-md-4 control-label">City or Municipal</label>
                                        <div class="col-md-6">
                                            <select class="form-control" id="h_cityOrMunicipal" name="h_cityOrMunicipal">
                                                <option value="">-Select Municipal-</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="h_barangay" class="col-md-4 control-label">Barangay</label>
                                        <div class="col-md-6">
                                            <select class="form-control" id="h_barangay" name="h_barangay">
                                                <option value="">-Select Barangay-</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="h_streetAddress" class="col-md-4 control-label">Street Address</label>
                                        <div class="col-md-6">
                                            <input id="h_streetAddress" type="text" class="form-control" name="h_streetAddress" value="{{ (isset($user))  ? $user->h_streetAddress : '' }}" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-primary">
                                                Save
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane fade in" id="Benefeciaries">
                                <form class="form-inline" method="POST" action="{{ route('profile/update/beneficiary', ['profileId'=>$user->profileId]) }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="saveType" value="beneficiary">
                                    <div class="form-group col-md-12">
                                        <div class="pull-right">
                                            <input type="button" id="btnAdd" class="btn btn-success" value="Add" />
                                            <button type="submit" class="btn btn-primary">
                                                Save
                                            </button>
                                        </div>
                                    </div>

                                    <br><br>
                                    <div id="bens" style="clear:both">
                                        @foreach($user->beneficiaries as $beneficiary)
                                        <div class="beneficiary">
                                            <hr>
                                            <div class="form-group">
                                                <label for="name">Name: </label>
                                                <input id="name" type="text" class="form-control" name="name[]" autofocus value="{{ $beneficiary->name }}" style="width:25%;" >

                                                <label for="birthDate">Birth Date: </label>
                                                <input id="birthDate" type="text" style="width:15%;" class="form-control" name="birthDate[]"  autofocus value="{{ Carbon\Carbon::parse($beneficiary->birthDate)->format('Y-m-d') }}">



                                                <label for="relationship">Relationship: </label>
                                                {{ Form::select("relationship[]", 
                                                    ['Uncle'=>'Uncle', 'Auntie'=>'Auntie', 'Brother'=>'Brother', 'Sister'=>'Sister', 'Mother'=>'Mother', 'Father'=>'Father', 'Spouse'=>'Spouse'], 
                                                    $beneficiary->relationship,
                                                    ['id' => 'relationship', 'class' => 'form-control','placeholder' => '-Select Relationship-', 'style'=>'width:15%;']) 
                                                }}

                                                <input type="button" class="btnDel btn btn-danger" value="X" />
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </form>
                                <div id="beneficiary_hidden" style="display: none">
                                    <div class="beneficiary">
                                        <hr>
                                        <div class="form-group">
                                            <label for="name">Name: </label>
                                            <input id="name" type="text" class="form-control" name="name[]" autofocus style="width:25%;" >

                                            <label for="birthDate">Birth Date: </label>
                                            <input id="birthDate" type="text" style="width:15%;" class="form-control" name="birthDate[]"  autofocus >

                                            <label for="relationship">Relationship: </label>
                                            {{ Form::select("relationship[]", 
                                                ['Uncle'=>'Uncle', 'Auntie'=>'Auntie', 'Brother'=>'Brother', 'Sister'=>'Sister', 'Mother'=>'Mother', 'Father'=>'Father', 'Spouse'=>'Spouse'], 
                                                null,
                                                ['id' => 'relationship', 'class' => 'form-control','placeholder' => '-Select Relationship-', 'style'=>'width:15%;']) 
                                            }}

                                            <input type="button" class="btnDel btn btn-danger" value="X" />
                                        </div>
                                    </div>
                                </div>
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
</div>
@endsection

@section('script')
<script type="text/javascript">
    $(document).on('change', '#maritalStatus', function (e) {
        if(this.value == 'Married') {
            $("#spouse").show();
        } else {
            $("#spouse").hide();
            $("#spouse #sp_firstName").val("");
            $("#spouse #sp_lastName").val("");
            $("#spouse #sp_middleName").val("");
            $("#spouse #sp_firstName").parents('.form-group').removeClass('has-error');
            $("#spouse #sp_lastName").parents('.form-group').removeClass('has-error');
            $("#spouse #sp_middleName").parents('.form-group').removeClass('has-error');
        }
    });

    $('#btnAdd').click(function (e) {
        e.preventDefault();
        var beneficiary = $("#beneficiary_hidden").html();
        console.log(beneficiary);
        $("#bens").append(beneficiary);
    });
    $('#bens').on('click', ".btnDel", function (e) {
        e.preventDefault();
        $(this).parents('.beneficiary').remove();
        // var beneficiary = $("#beneficiary_hidden").html();
        // console.log(beneficiary);
        // $("#bens").append(beneficiary);
    });
    

    $('#Personal form').on('click', 'button', function(e){
        var firstName       = $("#firstName").val(),
            lastName        = $("#lastName").val(),
            middleName      = $("#middleName").val(),
            motherMaidenName= $("#motherMaidenName").val(),
            gender          = $("#gender").val(),
            birthdate       = $("#birthdate").val(),
            birthplace      = $("#birthplace").val(),
            nationality     = $("#nationality").val(),
            maritalStatus   = $("#maritalStatus").val(),
            sp_firstName    = $("#sp_firstName").val(),
            sp_lastName     = $("#sp_lastName").val(),
            sp_middleName   = $("#sp_middleName").val();
        if(!firstName || !lastName || !middleName || !gender || !birthdate || !birthplace || !nationality || !maritalStatus) {
            e.preventDefault();
            $("#error-message").show();
            $("#error-message .message").html("Please input all fields.");
            $("#error-message").addClass("alert-danger");
            if(!firstName) $("#firstName").parents('.form-group').addClass('has-error'); 
                else $("#firstName").parents('.form-group').removeClass('has-error');
            if(!lastName) $("#lastName").parents('.form-group').addClass('has-error'); 
                else $("#lastName").parents('.form-group').removeClass('has-error');
            if(!middleName) $("#middleName").parents('.form-group').addClass('has-error'); 
                else $("#middleName").parents('.form-group').removeClass('has-error');
            if(!motherMaidenName) $("#motherMaidenName").parents('.form-group').addClass('has-error'); 
                else $("#motherMaidenName").parents('.form-group').removeClass('has-error');
            if(!gender) $("#gender").parents('.form-group').addClass('has-error'); 
                else $("#gender").parents('.form-group').removeClass('has-error');
            if(!birthdate) $("#birthdate").parents('.form-group').addClass('has-error'); 
                else $("#birthdate").parents('.form-group').removeClass('has-error');
            if(!birthplace) $("#birthplace").parents('.form-group').addClass('has-error'); 
                else $("#birthplace").parents('.form-group').removeClass('has-error');
            if(!nationality) $("#nationality").parents('.form-group').addClass('has-error'); 
                else $("#nationality").parents('.form-group').removeClass('has-error');
            if(!maritalStatus) $("#maritalStatus").parents('.form-group').addClass('has-error'); 
                else $("#maritalStatus").parents('.form-group').removeClass('has-error');

            if(maritalStatus == 'Married' && (!sp_firstName || !sp_lastName || !sp_middleName)) {
                if(!sp_firstName) $("#spouse #sp_firstName").parents('.form-group').addClass('has-error'); 
                    else $("#spouse #sp_firstName").parents('.form-group').removeClass('has-error');
                if(!sp_lastName) $("#spouse #sp_lastName").parents('.form-group').addClass('has-error'); 
                    else $("#spouse #sp_lastName").parents('.form-group').removeClass('has-error');
                if(!sp_middleName) $("#spouse #sp_middleName").parents('.form-group').addClass('has-error'); 
                    else $("#spouse #sp_middleName").parents('.form-group').removeClass('has-error');
            }
        } else if(maritalStatus == 'Married' && (!sp_firstName || !sp_lastName || !sp_middleName)) {
            e.preventDefault();
            $("#error-message").show();
            $("#error-message .message").html("Please input all fields.");
            $("#error-message").addClass("alert-danger");
            if(!sp_firstName) $("#spouse #sp_firstName").parents('.form-group').addClass('has-error'); 
                else $("#spouse #sp_firstName").parents('.form-group').removeClass('has-error');
            if(!sp_lastName) $("#spouse #sp_lastName").parents('.form-group').addClass('has-error'); 
                else $("#spouse #sp_lastName").parents('.form-group').removeClass('has-error');
            if(!sp_middleName) $("#spouse #sp_middleName").parents('.form-group').addClass('has-error'); 
                else $("#spouse #sp_middleName").parents('.form-group').removeClass('has-error');
        }
    });

    $('#Contact form').on('click', 'button', function(e){
        var p_region            = $("#p_region").val(),
            p_province          = $("#p_province").val(),
            p_cityOrMunicipal   = $("#p_cityOrMunicipal").val(),
            p_barangay          = $("#p_barangay").val(),
            p_streetAddress     = $("#p_streetAddress").val();

        if(!p_region || !p_province || !p_cityOrMunicipal || !p_barangay || !p_streetAddress) {
            e.preventDefault();
            $("#error-message").show();
            $("#error-message .message").html("Please input all fields.");
            $("#error-message").addClass("alert-danger");
            if(!p_region) $("#p_region").parents('.form-group').addClass('has-error'); 
                else $("#p_region").parents('.form-group').removeClass('has-error');
            if(!p_province) $("#p_province").parents('.form-group').addClass('has-error'); 
                else $("#p_province").parents('.form-group').removeClass('has-error');
            if(!p_cityOrMunicipal) $("#p_cityOrMunicipal").parents('.form-group').addClass('has-error'); 
                else $("#p_cityOrMunicipal").parents('.form-group').removeClass('has-error');
            if(!p_barangay) $("#p_barangay").parents('.form-group').addClass('has-error'); 
                else $("#p_barangay").parents('.form-group').removeClass('has-error');
            if(!p_streetAddress) $("#p_streetAddress").parents('.form-group').addClass('has-error'); 
                else $("#p_streetAddress").parents('.form-group').removeClass('has-error');
        }
    });

    var json = (function() {
        var json = null;
        $.ajax({
            'async': false,
            'global': false,
            'url': '{{asset('address.json')}}',
            'dataType': "json",
            'success': function (data) {
                json = data;
            }
        });
        return json;
    })();

    var p_province, p_cityOrMunicipal, p_barangay;
    $(document).on("change", "#p_region", function(e){
        p_province = json[$(this).val()];
        $('#p_province')
            .empty()
            .append('<option selected="selected" value="">-Select Province-</option>')
        $.each(p_province, function( index, value ) {
            $('#p_province').append($('<option>', { 
                value: index,
                text : index 
            }));
        });
    });

    $(document).on("change", "#p_province", function(e){
        p_cityOrMunicipal = p_province[$(this).val()];
        $('#p_cityOrMunicipal')
            .empty()
            .append('<option selected="selected" value="">-Select Municipal-</option>')
        $.each(p_cityOrMunicipal, function( index, value ) { 
            $('#p_cityOrMunicipal').append($('<option>', { 
                value: index,
                text : index 
            }));
        });
    });

    $(document).on("change", "#p_cityOrMunicipal", function(e){
        p_barangay = p_cityOrMunicipal[$(this).val()];
        $('#p_barangay')
            .empty()
            .append('<option selected="selected" value="">-Select Barangay-</option>')
        $.each(p_barangay, function( index, value ) {
            $('#p_barangay').append($('<option>', { 
                value: index,
                text : index 
            }));
        });
    });

    var h_province, h_cityOrMunicipal, h_barangay;
    $(document).on("change", "#h_region", function(e){
        h_province = json[$(this).val()];
        $('#h_province')
            .empty()
            .append('<option selected="selected" value="">-Select Province-</option>')
        $.each(h_province, function( index, value ) {
            $('#h_province').append($('<option>', { 
                value: index,
                text : index 
            }));
        });
    });

    $(document).on("change", "#h_province", function(e){
        h_cityOrMunicipal = h_province[$(this).val()];
        $('#h_cityOrMunicipal')
            .empty()
            .append('<option selected="selected" value="">-Select Municipal-</option>')
        $.each(h_cityOrMunicipal, function( index, value ) { 
            $('#h_cityOrMunicipal').append($('<option>', { 
                value: index,
                text : index 
            }));
        });
    });

    $(document).on("change", "#h_cityOrMunicipal", function(e){
        h_barangay = h_cityOrMunicipal[$(this).val()];
        $('#h_barangay')
            .empty()
            .append('<option selected="selected" value="">-Select Barangay-</option>')
        $.each(h_barangay, function( index, value ) {
            $('#h_barangay').append($('<option>', { 
                value: index,
                text : index 
            }));
        });
    });







//     $(document).ready(function() {
//         var kycId = {{ Route::input('id') }};
// // http://52.74.115.167:703/index.php?mtmaccess_api=true&transaction=20020&userName=test6&imei=359861054037926
//         $.ajax({
//           type: 'GET',
//           url: 'http://52.74.115.167:703/index.php',
//           crossDomain: true,
//           data: {
//             mtmaccess_api: true, 
//             transaction: 20020, 
//             userName: "{{Session::get('user')}}",
//             passWord: "{{Session::get('password')}}"
//           },
//           cache: false,
//           success: function(data) {
//             var data = JSON.parse(data);
//             if(data.success) {
//                 console.log(data.result);
//                 $('#example').dataTable( {
//                     "aaData": data.result,
//                     'columns': [
//                     { "data": null, render: function ( data, type, row ) {
//                             return data.lastname+', '+data.firstname+' '+data.middlename;
//                         }
//                     },
//                     { "data": null, render: function ( data, type, row ) {
//                             return formatDate(data.birthDate);
//                         } 
//                     },
//                     { "data": "gender" },
//                     { "data": null, render: function ( data, type, row) {
//                             return "<a class='btn btn-success' href='"+data.profileId+"'>Print</a>";
//                         }
//                     }
//                     ],
//                 } );
//             }
//           }
//         });       
//     } );
</script>
@endsection