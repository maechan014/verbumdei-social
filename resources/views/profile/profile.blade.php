@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
          <div class="panel-head">    
              <center><h1>Profile</h1></center>
          </div>  
      </div>

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
                  <div class="tab-pane fade in active">
                    <div class="profile-info">
                      <h4>Name </h4>
                      <input id="name" class="profile-input-style" type="text" name="name" value="{{ (isset($user))  ? $user->name: '' }}" readonly>
                    </div>

                    <div class="profile-info">
                      <h4>Gender </h4>
                      <input id="gender" class="profile-input-style" type="text" name="gender" value="{{ (isset($user))  ? $user->gender: '' }}" readonly>
                    </div>

                    <div class="profile-info">
                      <h4>Birthday </h4>
                      <input id="birthdate" class="profile-input-style" type="text" name="birthdate" value="{{ (isset($user))  ? Carbon\Carbon::parse($user->birthDate)->format('m/d/Y') : '' }}" readonly>
                    </div>

                    <div class="profile-info">
                      <h4>Birth Place </h4>
                      <input id="birthplace" class="profile-input-style" type="text" name="birthplace" value="{{ (isset($user))  ? $user->birthPlace: '' }}" readonly>
                    </div>

                  </div>
              </div>

              <div class="form-group">
                  <div class="col-md-6 col-md-offset-4">
                      <button class="btn btn-primary" >
                          Edit
                      </button>
                  </div>
              </div>
          </div>
      </div>
    </div>
    <!-- .row -->
</div>
@endsection