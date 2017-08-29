@extends('layouts.app')

@section('content')
<div class="bg"></div>
<div class="jumbotron" style="text-align: center;">
  <h1>WELCOME TO OUR FAMILY IN CEBU!</h1>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Events</h1>
            <hr>

            @foreach($events as $event)
            <div class="col-md-4">
                <div class="card">
                    <a href="{{ route('viewEvent', [$event->iiId]) }}">
                    <div class="card-image">
                        <img class="img-responsive" style="width: 100%; height: 200px;" src="http://52.74.115.167:703/{{ $event->iiImg }}">
                    </div><!-- card image -->
                    
                    <div class="card-content">
                        <span class="card-title">{{$event->iiName}}{{($event->iiDesc) ? "({$event->iiDesc})" : ""}}</span>
                        <p>₱{{$event->iiUnitPrice}}</p>                    
                    </div><!-- card content -->
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
    var jumboHeight = $('.jumbotron').outerHeight();
    var navHeight = $('nav').outerHeight();
    function parallax(){
        var scrolled = $(window).scrollTop();
        $('.bg').css('height', (jumboHeight-scrolled+navHeight) + 'px');
    }

    $(window).scroll(function(e){
        parallax();
    });
</script>
@endsection