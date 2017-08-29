@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>New Member</h3>
            <hr>
            <div class="col-md-10 col-md-offset-1">
                <div id="error-message" @if(!session()->has('response'))style="display: none;"@endif class="alert @if(session()->has('response')){{ session('response')->success ? "alert-success" : "alert-danger" }}@endif fade in">
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <span class="message">@if(session()->has('response')){{ session('response')->msg }}@endif</span>
                </div>
                <div class="panel with-nav-tabs panel-default">
                    <form class="form-horizontal" method="POST" action="{{ url('admin/kyc/new') }}">
                        <div class="panel-heading">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#Personal" data-toggle="tab">1. Personal</a></li>
                                <li><a href="#Contact" data-toggle="tab">2. Contact</a></li>
                                <li><a href="#Financial" data-toggle="tab">3. Financial</a></li>
                                <li><a href="#Benefeciaries" data-toggle="tab">4. Benefeciaries</a></li>
                                <button type="submit" class="btn btn-success btn-sm stepfour pull-right"><span class="fa fa-save"></span> Save</button>
                            </ul>
                        </div>
                        <div class="panel-body">
                            <div class="tab-content">
                                <div class="tab-pane fade in active" id="Personal">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="byUsername" value="{{ Session::get('username') }}">
                                    <input type="hidden" name="byPassword" value="{{ Session::get('password') }}">
                                    <input type="hidden" name="suffix" value="">
                                    <input type="hidden" name="m_id1type" value="">
                                    <input type="hidden" name="id1Type" value="">
                                    <input type="hidden" name="id1Num" value="">
                                    <input type="hidden" name="id1Rem" value="">
                                    <input type="hidden" name="id2Type" value="">
                                    <input type="hidden" name="id2Num" value="">
                                    <input type="hidden" name="id2Rem" value="">

                                    <div class="form-group">
                                        <label for="firstName" class="col-md-4 control-label">First Name*</label>
                                        <div class="col-md-6">
                                            <input id="firstName" type="text" class="form-control" name="firstName" value="{{ old('firstName') }}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="lastName" class="col-md-4 control-label">Last Name*</label>
                                        <div class="col-md-6">
                                            <input id="lastName" type="text" class="form-control" name="lastName" value="{{ old('lastName') }}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="middleName" class="col-md-4 control-label">Middle Name*</label>
                                        <div class="col-md-6">
                                            <input id="middleName" type="text" class="form-control" name="middleName" value="{{ old('middleName') }}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="maiden" class="col-md-4 control-label">Mother's Maiden Name*</label>
                                        <div class="col-md-6">
                                            <input id="maiden" type="text" class="form-control" name="maiden" value="{{ old('maiden') }}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="gender" class="col-md-4 control-label">Gender*</label>
                                        <div class="col-md-6">
                                            {{ Form::select('gender', 
                                                ['Male'=>'Male', 'Female'=>'Female'], 
                                                old('gender'), 
                                                ['id' => 'gender', 'class' => 'form-control','placeholder' => '-Select Gender-']) 
                                            }}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="bday" class="col-md-4 control-label">Birthdate*</label>
                                        <div class="col-md-6">
                                            <div class="input-group date" data-provide="datepicker">
                                                <input type="text" class="form-control" id="bday" name="bday" value="{{ old('bday') }}" required>
                                                <div class="input-group-addon">
                                                    <span class="glyphicon glyphicon-th"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="bplace" class="col-md-4 control-label">Birthplace*</label>
                                        <div class="col-md-6">
                                            <input id="bplace" type="text" class="form-control" name="bplace" value="{{ old('bplace') }}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="nationality" class="col-md-4 control-label">Nationality*</label>
                                        <div class="col-md-6">
                                            <input id="nationality" type="text" class="form-control" name="nationality" value="{{ old('nationality') }}" required autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="civStat" class="col-md-4 control-label">Civil Status*</label>
                                        <div class="col-md-6">
                                            {{ Form::select('civStat', 
                                                ['Single'=>'Single', 'Married'=>'Married', 'Widow'=>'Widow'], 
                                                old('civStat'), 
                                                ['id' => 'civStat', 'class' => 'form-control','placeholder' => '-Select Civil Status-']) 
                                            }}
                                        </div>
                                    </div>

                                    <div id="spouse" style="display: none;">
                                        <div class="form-group">
                                            <label for="spFname" class="col-md-4 control-label">Spouse First Name*</label>
                                            <div class="col-md-6">
                                                <input id="spFname" type="text" value="{{ old('spFname') }}" class="form-control" name="spFname" autofocus>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="spLname" class="col-md-4 control-label">Spouse Last Name*</label>
                                            <div class="col-md-6">
                                                <input id="spLname" type="text" value="{{ old('spLname') }}" class="form-control" name="spLname" autofocus>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="spMname" class="col-md-4 control-label">Spouse Middle Name*</label>
                                            <div class="col-md-6">
                                                <input id="spMname" type="text" value="{{ old('spMname') }}" class="form-control" name="spMname" autofocus>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-success stepone">
                                                Proceed Step 2
                                            </button>
                                        </div>
                                    </div>                   
                                </div>
                                <!-- ---------------------------------------------------------------------- -->
                                <div class="tab-pane fade in" id="Contact">
                                    <div class="form-group">
                                        <label for="mobile" class="col-md-4 control-label">Mobile Number</label>
                                        <div class="col-md-6">
                                            <input id="mobile" type="text" class="form-control" name="mobile" value="{{ old('mobile') }}" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="telNum" class="col-md-4 control-label">Telephone Number</label>
                                        <div class="col-md-6">
                                            <input id="telNum" type="text" class="form-control" name="telNum" value="{{ old('telNum') }}" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="col-md-4 control-label">Email</label>
                                        <div class="col-md-6">
                                            <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" autofocus>
                                        </div>
                                    </div>

                                    <hr>

                                    <h3 class="col-md-offset-2">Present Address*:</h3>

                                    <div class="form-group">
                                        <label for="country" class="col-md-4 control-label">Country*</label>
                                        <div class="col-md-6">
                                        {{ Form::select('country', 
                                            ['Philippines'=>'Philippines'], 
                                            'Philippines', 
                                            ['id' => 'country', 'class' => 'form-control','placeholder' => '-Select Country-', 'disabled']) 
                                        }}
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label for="region" class="col-md-4 control-label">Region*</label>
                                        <div class="col-md-6">
                                            <select class="form-control" id="region" name="region">
                                                <option value="">-Select Region-</option>
                                                @foreach($regions as $key => $region)
                                                    <option value="{{ $key }}">{{ $key }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="province" class="col-md-4 control-label">Province*</label>
                                        <div class="col-md-6">
                                            <select class="form-control" id="province" name="province">
                                                <option value="">-Select Province-</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="municipal" class="col-md-4 control-label">City or Municipal*</label>
                                        <div class="col-md-6">
                                            <select class="form-control" id="municipal" name="municipal">
                                                <option value="">-Select Municipal-</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="brgy" class="col-md-4 control-label">Barangay*</label>
                                        <div class="col-md-6">
                                            <select class="form-control" id="brgy" name="brgy">
                                                <option value="">-Select Barangay-</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="streetAdd" class="col-md-4 control-label">Street Address*</label>
                                        <div class="col-md-6">
                                            <input id="streetAdd" type="text" class="form-control" name="streetAdd" value="{{ old('streetAdd') }}" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="zipcode" class="col-md-4 control-label">Zip Code*</label>
                                        <div class="col-md-6">
                                            <input id="zipcode" type="text" class="form-control" name="zipcode" value="{{ old('zipcode') }}" autofocus>
                                        </div>
                                    </div>

                                    <hr>

                                    <h3 class="col-md-offset-2">Home Address:</h3>

                                    <div class="form-group">
                                        <label for="h_country" class="col-md-4 control-label">Country</label>
                                        <div class="col-md-6">
                                        {{ Form::select('h_country', 
                                            ['Philippines'=>'Philippines'], 
                                            'Philippines', 
                                            ['id' => 'h_country', 'class' => 'form-control','placeholder' => '-Select Country-', 'disabled']) 
                                        }}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="h_region" class="col-md-4 control-label">Region</label>
                                        <div class="col-md-6">
                                            <select class="form-control" id="h_region" name="h_region">
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
                                        <label for="h_municipal" class="col-md-4 control-label">City or Municipal</label>
                                        <div class="col-md-6">
                                            <select class="form-control" id="h_municipal" name="h_municipal">
                                                <option value="">-Select Municipal-</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="h_brgy" class="col-md-4 control-label">Barangay</label>
                                        <div class="col-md-6">
                                            <select class="form-control" id="h_brgy" name="h_brgy">
                                                <option value="">-Select Barangay-</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="h_streetAdd" class="col-md-4 control-label">Street Address</label>
                                        <div class="col-md-6">
                                            <input id="h_streetAdd" type="text" class="form-control" name="h_streetAdd" value="{{ old('h_streetAdd') }}" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="h_zipcode" class="col-md-4 control-label">Zip Code</label>
                                        <div class="col-md-6">
                                            <input id="h_zipcode" type="text" class="form-control" name="h_zipcode" value="{{ old('h_zipcode') }}" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-success steptwo">
                                                Proceed Step 3
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- ------------------------------------------------------------------------- -->
                                <div class="tab-pane fade in" id="Financial">
                                    <div class="form-group">
                                        <label for="empType" class="col-md-4 control-label">Employee Type</label>
                                        <div class="col-md-6">
                                            {{ Form::select('empType', 
                                                ['Unemployed'=>'Unemployed', 'Employed'=>'Employed', 'Other'=>'Other'], 
                                                old('empType'), 
                                                ['id' => 'empType', 'class' => 'form-control','placeholder' => '-Select Employee Status-']) 
                                            }}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="empBizCo" class="col-md-4 control-label">Componany Name</label>
                                        <div class="col-md-6">
                                            <input id="empBizCo" type="text" class="form-control" name="empBizCo" value="{{ old('empBizCo') }}" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="empOccupation" class="col-md-4 control-label">Occupation</label>
                                        <div class="col-md-6">
                                            <input id="empOccupation" type="text" class="form-control" name="empOccupation" value="{{ old('empOccupation') }}" autofocus>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label for="empRegion" class="col-md-4 control-label">Region</label>
                                        <div class="col-md-6">
                                            <select class="form-control" id="empRegion" name="empRegion">
                                                <option value="">-Select Region-</option>
                                                @foreach($regions as $key => $region)
                                                    <option value="{{ $key }}">{{ $key }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="empProvince" class="col-md-4 control-label">Province</label>
                                        <div class="col-md-6">
                                            <select class="form-control" id="empProvince" name="empProvince">
                                                <option value="">-Select Province-</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="empMunicipal" class="col-md-4 control-label">City or Municipal</label>
                                        <div class="col-md-6">
                                            <select class="form-control" id="empMunicipal" name="empMunicipal">
                                                <option value="">-Select Municipal-</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="empBrgy" class="col-md-4 control-label">Barangay</label>
                                        <div class="col-md-6">
                                            <select class="form-control" id="empBrgy" name="empBrgy">
                                                <option value="">-Select Barangay-</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="empStreetAdd" class="col-md-4 control-label">Street Address</label>
                                        <div class="col-md-6">
                                            <input id="empStreetAdd" type="text" class="form-control" name="empStreetAdd" value="{{ old('empStreetAdd') }}" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="empZipcode" class="col-md-4 control-label">Zip Code</label>
                                        <div class="col-md-6">
                                            <input id="empZipcode" type="text" class="form-control" name="empZipcode" value="{{ old('empZipcode') }}" autofocus>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4">
                                            <button type="submit" class="btn btn-success stepthree">
                                                Proceed Step 4
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- ---------------------------------------------------------------- -->
                                <div class="tab-pane fade in" id="Benefeciaries">
                                    <div class="form-group col-md-12">
                                        <div class="">
                                            <input type="button" id="btnAdd" class="btn btn-success" value="Add more beneficiary" />
                                        </div>
                                    </div>

                                    <br><br>
                                    <div id="bens" style="clear:both">
                                        <div class="beneficiary col-md-12">
                                            <hr>
                                            <div class="form-group row">
                                                <label class="col-md-1" for="name">Name: </label>
                                                <div class="col-md-2">
                                                    <input id="name" type="text" class="form-control" name="name[]" autofocus>
                                                </div>

                                                <label class="col-md-1" for="birthDate">Birth Date: </label>
                                                <div class="col-md-2">
                                                    <div class="input-group date" data-provide="datepicker">
                                                        <input type="text" class="form-control" id="birthDate" name="birthDate[]" }}">
                                                        <div class="input-group-addon">
                                                            <span class="glyphicon glyphicon-th"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <label for="relationship" class="col-md-2">Relationship: </label>
                                                <div class="col-md-3">
                                                    {{ Form::select("relationship[]", 
                                                        ['Uncle'=>'Uncle', 'Auntie'=>'Auntie', 'Brother'=>'Brother', 'Sister'=>'Sister', 'Mother'=>'Mother', 'Father'=>'Father', 'Spouse'=>'Spouse'], 
                                                        null,
                                                        ['id' => 'relationship', 'class' => 'form-control','placeholder' => '-Select Relationship-']) 
                                                    }}
                                                </div>

                                                <input type="button" class="btnDel btn btn-danger col-md-1" value="X" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div id="beneficiary_hidden" style="display: none">
                        <div class="beneficiary col-md-12">
                            <hr>
                            <div class="form-group row">
                                <label class="col-md-1" for="name">Name: </label>
                                <div class="col-md-2">
                                    <input id="name" type="text" class="form-control" name="name[]" autofocus>
                                </div>

                                <label class="col-md-1" for="birthDate">Birth Date: </label>
                                <div class="col-md-2">
                                    <input id="birthDate" type="text" class="form-control" name="birthDate[]"  autofocus >
                                </div>
                                <label for="relationship" class="col-md-2">Relationship: </label>
                                <div class="col-md-3">
                                    {{ Form::select("relationship[]", 
                                        ['Uncle'=>'Uncle', 'Auntie'=>'Auntie', 'Brother'=>'Brother', 'Sister'=>'Sister', 'Mother'=>'Mother', 'Father'=>'Father', 'Spouse'=>'Spouse'], 
                                        null,
                                        ['id' => 'relationship', 'class' => 'form-control','placeholder' => '-Select Relationship-']) 
                                    }}
                                </div>

                                <input type="button" class="btnDel btn btn-danger col-md-1" value="X" />
                            </div>
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
    

    $('form').on('click', 'button.stepone', function(e){
        e.preventDefault();

        var firstName       = $("#firstName").val(),
            lastName        = $("#lastName").val(),
            middleName      = $("#middleName").val(),
            maiden          = $("#maiden").val(),
            gender          = $("#gender").val(),
            bday            = $("#bday").val(),
            bplace          = $("#bplace").val(),
            nationality     = $("#nationality").val(),
            civStat         = $("#civStat").val(),
            spFname         = $("#spFname").val(),
            spLname         = $("#spLname").val(),
            spMname         = $("#spMname").val();
        if(!firstName || !lastName || !middleName || !gender || !bday || !bplace || !nationality || !civStat) {
            
            $("#error-message").show();
            $("#error-message .message").html("Please input all required fields.");
            $("#error-message").addClass("alert-danger");
            if(!firstName) $("#firstName").parents('.form-group').addClass('has-error'); 
                else $("#firstName").parents('.form-group').removeClass('has-error');
            if(!lastName) $("#lastName").parents('.form-group').addClass('has-error'); 
                else $("#lastName").parents('.form-group').removeClass('has-error');
            if(!middleName) $("#middleName").parents('.form-group').addClass('has-error'); 
                else $("#middleName").parents('.form-group').removeClass('has-error');
            if(!maiden) $("#maiden").parents('.form-group').addClass('has-error'); 
                else $("#maiden").parents('.form-group').removeClass('has-error');
            if(!gender) $("#gender").parents('.form-group').addClass('has-error'); 
                else $("#gender").parents('.form-group').removeClass('has-error');
            if(!bday) $("#bday").parents('.form-group').addClass('has-error'); 
                else $("#bday").parents('.form-group').removeClass('has-error');
            if(!bplace) $("#bplace").parents('.form-group').addClass('has-error'); 
                else $("#bplace").parents('.form-group').removeClass('has-error');
            if(!nationality) $("#nationality").parents('.form-group').addClass('has-error'); 
                else $("#nationality").parents('.form-group').removeClass('has-error');
            if(!civStat) $("#civStat").parents('.form-group').addClass('has-error'); 
                else $("#civStat").parents('.form-group').removeClass('has-error');

            if(civStat == 'Married' && (!spFname || !spLname || !spMname)) {
                if(!spFname) $("#spouse #sp_firstName").parents('.form-group').addClass('has-error'); 
                    else $("#spouse #sp_firstName").parents('.form-group').removeClass('has-error');
                if(!spLname) $("#spouse #spLname").parents('.form-group').addClass('has-error'); 
                    else $("#spouse #spLname").parents('.form-group').removeClass('has-error');
                if(!spMname) $("#spouse #spMname").parents('.form-group').addClass('has-error'); 
                    else $("#spouse #spMname").parents('.form-group').removeClass('has-error');
            }
        } else if(civStat == 'Married' && (!spFname || !spLname || !spMname)) {
            $("#error-message").show();
            $("#error-message .message").html("Please input all required fields.");
            $("#error-message").addClass("alert-danger");
            if(!spFname) $("#spouse #spFname").parents('.form-group').addClass('has-error'); 
                else $("#spouse #spFname").parents('.form-group').removeClass('has-error');
            if(!spLname) $("#spouse #spLname").parents('.form-group').addClass('has-error'); 
                else $("#spouse #spLname").parents('.form-group').removeClass('has-error');
            if(!spMname) $("#spouse #spMname").parents('.form-group').addClass('has-error'); 
                else $("#spouse #spMname").parents('.form-group').removeClass('has-error');
        } else {
            $('.nav-tabs a[href="#Contact"]').tab('show');
        }
    });

    $('form').on('click', 'button.steptwo', function(e){
        e.preventDefault();

        var country         = $("#country").val(),
            region          = $("#region").val(),
            province        = $("#province").val(),
            municipal       = $("#municipal").val(),
            brgy            = $("#brgy").val(),
            streetAdd       = $("#streetAdd").val(),
            zipcode         = $("#zipcode").val();


        if(!country || !region || !province || !municipal || !brgy || !streetAdd || !zipcode) {
            e.preventDefault();
            $("#error-message").show();
            $("#error-message .message").html("Please input all required fields.");
            $("#error-message").addClass("alert-danger");
            if(!country) $("#country").parents('.form-group').addClass('has-error'); 
                else $("#country").parents('.form-group').removeClass('has-error');
            if(!region) $("#region").parents('.form-group').addClass('has-error'); 
                else $("#region").parents('.form-group').removeClass('has-error');
            if(!province) $("#province").parents('.form-group').addClass('has-error'); 
                else $("#province").parents('.form-group').removeClass('has-error');
            if(!municipal) $("#municipal").parents('.form-group').addClass('has-error'); 
                else $("#municipal").parents('.form-group').removeClass('has-error');
            if(!brgy) $("#brgy").parents('.form-group').addClass('has-error'); 
                else $("#brgy").parents('.form-group').removeClass('has-error');
            if(!streetAdd) $("#streetAdd").parents('.form-group').addClass('has-error'); 
                else $("#streetAdd").parents('.form-group').removeClass('has-error');
            if(!zipcode) $("#zipcode").parents('.form-group').addClass('has-error'); 
                else $("#zipcode").parents('.form-group').removeClass('has-error');
        } else {
            $('.nav-tabs a[href="#Financial"]').tab('show');
        }
    });

    $('form').on('click', 'button.stepthree', function(e){
        e.preventDefault();

        $('.nav-tabs a[href="#Benefeciaries"]').tab('show');
    });

    $('form').on('click', 'button.stepfour', function(e){
        var firstName       = $("#firstName").val(),
            lastName        = $("#lastName").val(),
            middleName      = $("#middleName").val(),
            maiden          = $("#maiden").val(),
            gender          = $("#gender").val(),
            bday            = $("#bday").val(),
            bplace          = $("#bplace").val(),
            nationality     = $("#nationality").val(),
            civStat         = $("#civStat").val(),
            spFname         = $("#spFname").val(),
            spLname         = $("#spLname").val(),
            spMname         = $("#spMname").val();

        var country         = $("#country").val(),
            region          = $("#region").val(),
            province        = $("#province").val(),
            municipal       = $("#municipal").val(),
            brgy            = $("#brgy").val(),
            streetAdd       = $("#streetAdd").val(),
            zipcode         = $("#zipcode").val();

        if(!firstName || !lastName || !middleName || !gender || !bday || !bplace || !nationality || !civStat || !country || !region || !province || !municipal || !brgy || !streetAdd || !zipcode) {
             e.preventDefault();
            $("#error-message").show();
            $("#error-message .message").html("Please input all required fields.");
            $("#error-message").addClass("alert-danger");
            if(!firstName) $("#firstName").parents('.form-group').addClass('has-error'); 
                else $("#firstName").parents('.form-group').removeClass('has-error');
            if(!lastName) $("#lastName").parents('.form-group').addClass('has-error'); 
                else $("#lastName").parents('.form-group').removeClass('has-error');
            if(!middleName) $("#middleName").parents('.form-group').addClass('has-error'); 
                else $("#middleName").parents('.form-group').removeClass('has-error');
            if(!maiden) $("#maiden").parents('.form-group').addClass('has-error'); 
                else $("#maiden").parents('.form-group').removeClass('has-error');
            if(!gender) $("#gender").parents('.form-group').addClass('has-error'); 
                else $("#gender").parents('.form-group').removeClass('has-error');
            if(!bday) $("#bday").parents('.form-group').addClass('has-error'); 
                else $("#bday").parents('.form-group').removeClass('has-error');
            if(!bplace) $("#bplace").parents('.form-group').addClass('has-error'); 
                else $("#bplace").parents('.form-group').removeClass('has-error');
            if(!nationality) $("#nationality").parents('.form-group').addClass('has-error'); 
                else $("#nationality").parents('.form-group').removeClass('has-error');
            if(!civStat) $("#civStat").parents('.form-group').addClass('has-error'); 
                else $("#civStat").parents('.form-group').removeClass('has-error');

            if(civStat == 'Married' && (!spFname || !spLname || !spMname)) {
                if(!spFname) $("#spouse #sp_firstName").parents('.form-group').addClass('has-error'); 
                    else $("#spouse #sp_firstName").parents('.form-group').removeClass('has-error');
                if(!spLname) $("#spouse #spLname").parents('.form-group').addClass('has-error'); 
                    else $("#spouse #spLname").parents('.form-group').removeClass('has-error');
                if(!spMname) $("#spouse #spMname").parents('.form-group').addClass('has-error'); 
                    else $("#spouse #spMname").parents('.form-group').removeClass('has-error');
            }

            if(!country) $("#country").parents('.form-group').addClass('has-error'); 
                else $("#country").parents('.form-group').removeClass('has-error');
            if(!region) $("#region").parents('.form-group').addClass('has-error'); 
                else $("#region").parents('.form-group').removeClass('has-error');
            if(!province) $("#province").parents('.form-group').addClass('has-error'); 
                else $("#province").parents('.form-group').removeClass('has-error');
            if(!municipal) $("#municipal").parents('.form-group').addClass('has-error'); 
                else $("#municipal").parents('.form-group').removeClass('has-error');
            if(!brgy) $("#brgy").parents('.form-group').addClass('has-error'); 
                else $("#brgy").parents('.form-group').removeClass('has-error');
            if(!streetAdd) $("#streetAdd").parents('.form-group').addClass('has-error'); 
                else $("#streetAdd").parents('.form-group').removeClass('has-error');
            if(!zipcode) $("#zipcode").parents('.form-group').addClass('has-error'); 
                else $("#zipcode").parents('.form-group').removeClass('has-error');
        } else if(civStat == 'Married' && (!spFname || !spLname || !spMname)) {
             e.preventDefault();
            $("#error-message").show();
            $("#error-message .message").html("Please input all required fields.");
            $("#error-message").addClass("alert-danger");
            if(!spFname) $("#spouse #spFname").parents('.form-group').addClass('has-error'); 
                else $("#spouse #spFname").parents('.form-group').removeClass('has-error');
            if(!spLname) $("#spouse #spLname").parents('.form-group').addClass('has-error'); 
                else $("#spouse #spLname").parents('.form-group').removeClass('has-error');
            if(!spMname) $("#spouse #spMname").parents('.form-group').addClass('has-error'); 
                else $("#spouse #spMname").parents('.form-group').removeClass('has-error');
        } else {
            $('.nav-tabs a[href="#Contact"]').tab('show');
        }
    });
    
    var province, municipal, brgy;
    $(document).on("change", "#region", function(e){
        province = json[$(this).val()];
        $('#province')
            .empty()
            .append('<option selected="selected" value="">-Select Province-</option>')
        $.each(province, function( index, value ) {
            $('#province').append($('<option>', { 
                value: index,
                text : index 
            }));
        });
    });

    $(document).on("change", "#province", function(e){
        municipal = province[$(this).val()];
        $('#municipal')
            .empty()
            .append('<option selected="selected" value="">-Select Municipal-</option>')
        $.each(municipal, function( index, value ) { 
            $('#municipal').append($('<option>', { 
                value: index,
                text : index 
            }));
        });
    });

    $(document).on("change", "#municipal", function(e){
        brgy = municipal[$(this).val()];
        $('#brgy')
            .empty()
            .append('<option selected="selected" value="">-Select Barangay-</option>')
        $.each(brgy, function( index, value ) {
            $('#brgy').append($('<option>', { 
                value: index,
                text : index 
            }));
        });
    });

    var h_province, h_municipal, h_brgy;
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
        h_municipal = h_province[$(this).val()];
        $('#h_municipal')
            .empty()
            .append('<option selected="selected" value="">-Select Municipal-</option>')
        $.each(h_municipal, function( index, value ) {
            $('#h_municipal').append($('<option>', { 
                value: index,
                text : index 
            }));
        });
    });

    $(document).on("change", "#h_municipal", function(e){
        h_brgy = h_municipal[$(this).val()];
        $('#h_brgy')
            .empty()
            .append('<option selected="selected" value="">-Select Barangay-</option>')
        $.each(h_brgy, function( index, value ) {
            $('#h_brgy').append($('<option>', { 
                value: index,
                text : index 
            }));
        });
    });

    var empProvince, empMunicipal, empBrgy;
    $(document).on("change", "#empRegion", function(e){
        empProvince = json[$(this).val()];
        $('#empProvince')
            .empty()
            .append('<option selected="selected" value="">-Select Province-</option>')
        $.each(empProvince, function( index, value ) {
            $('#empProvince').append($('<option>', { 
                value: index,
                text : index 
            }));
        });
    });

    $(document).on("change", "#empProvince", function(e){
        empMunicipal = empProvince[$(this).val()];
        $('#empMunicipal')
            .empty()
            .append('<option selected="selected" value="">-Select Municipal-</option>')
        $.each(empMunicipal, function( index, value ) {
            $('#empMunicipal').append($('<option>', { 
                value: index,
                text : index 
            }));
        });
    });

    $(document).on("change", "#empMunicipal", function(e){
        empBrgy = empMunicipal[$(this).val()];
        $('#empBrgy')
            .empty()
            .append('<option selected="selected" value="">-Select Barangay-</option>')
        $.each(empBrgy, function( index, value ) {
            $('#empBrgy').append($('<option>', { 
                value: index,
                text : index 
            }));
        });
    });
</script>
@endsection