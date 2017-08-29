@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3><a href="{{ url('event') }}">Events</a> / {{ $event->iiName }}</h3>
            <hr>
            <div id="error-message" @if(!session()->has('response'))style="display: none;"@endif class="alert @if(session()->has('response')){{ session('response')->success ? "alert-success" : "alert-danger" }}@endif fade in">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <span class="message">@if(session()->has('response')){{ session('response')->msg }}@endif</span>
            </div>
            <div class="col-md-9"> 
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h1>{{ $event->iiName }}</h1>
                        <hr>
                        <center>
                            <img class="img-responsive" style="height: 200px;" src="http://52.74.115.167:703/{{ $event->iiImg }}">
                        </center>
                        <br><br>
                        <p><b>Localtion:</b> {{$event->location}}</p>
                        <p><b>Price:</b> {{$event->iiUnitPrice}}</p>
                        <p>
                            <b>Description:</b><br>
                            {{ $event->iiDesc }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3"> 
                <div class="panel panel-default">
                    <div class="panel-body">
                        <center>
                            @if(Session::get('username'))
                            <form method="POST" action="{{ route('joinEvent', $event->iiId) }}">
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-success btn-block">JOIN EVENT</button>
                            </form>
                            @else
                            <a class="btn btn-success btn-block" href="{{url('login')}}">JOIN EVENT</a>
                            @endif
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
@endsection