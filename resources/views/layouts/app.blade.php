<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <!-- Styles -->
    <link href="{{ url('css/bootstrap.min.css') }}" rel="stylesheet" >
    <link href="{{ url('css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('css/font-awesome.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
    <link href="{{ url('css/style.css') }}" rel="stylesheet" >
    <link href="{{ url('css/myStyle.css') }}" rel="stylesheet" >
    <link href="{{ url('css/login.css') }}" rel="stylesheet" >
    <link href="{{ url('css/accounting.css') }}" rel="stylesheet" >
    <script src="{{ url('js/jquery-3.2.0.min.js') }}"></script>
    
    @yield('style')
    

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>

        $(window).scroll(function() {
          if ($(document).scrollTop() > 50) {
            $('nav').addClass('shrink');
          } else {
            $('nav').removeClass('shrink');
          }
        });
    </script>
</head>
<body>
    <nav class="navbar navbar-fixed-top">
      <div id="navigation">
        <div id="navbar-logo" class="navbar-header">
            <button type="button" class="navbar-toggle pull-right" data-toggle="collapse" data-target="#navbar-menu-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-left" href="{{ url('/') }}"><img src="{{ url('images/logo.png') }}"></a>
        </div>

        <div id="navbar-menu">
            <div class="navbar-collapse collapse" id="navbar-menu-collapse">
                <ul class="nav navbar-nav pull-right">
                @if (Session::has('username') && Session::get('usertype') == 'MERCHANT')
                    <li><a href="{{ url('admin/event') }}">Events</a></li>
                    <li><a href="{{ url('admin/kyc') }}">Members</a></li>
                @elseif (Session::has('username') && Session::get('usertype') == 'CLIENT')
                    <li><a href="{{ url('event') }}">Events</a></li>
                @endif

                @if (!Session::has('username'))
                    <li class="{{ Request::is('login') ? 'active' : '' }}">
                        <a href="{{ url('/login') }}">Login</a>
                    </li>
                    <li class="{{ Request::is('register') ? 'active' : '' }}">
                        <a href="{{ url('/register') }}">Register</a>
                        </li>
                @else
                    <li class="dropdown">
                        <a href="#" style="text-transform: uppercase;" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Session::get('username') }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                @if(Session::get('usertype') == 'CLIENT')
                                    <a href="{{ url('profile') }}">Profile</a>
                                    <a href="{{ url('accounting') }}">Personal Accounting</a>
                                @endif
                                <a href="{{ url('/logout') }}">Logout</a>
                            </li>
                        </ul>
                    </li>
                @endif
    <!--             <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Page</a></li>
                <li><a href="#">Link</a></li> -->
                </ul>
            </div>
            <!--.nav-collapse -->
        </div>
        <!-- #navigation -->
        
      </div>
    </nav>

    @yield('content')
        

    <!-- Scripts -->
    <!-- <script src="{{ url('js/app.js') }}"></script> -->
    <!-- <script src="{{ url('js/jquery-3.2.0.min.js') }}"></script> -->
    <script src="{{ url('js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ url('js/myScript.js') }}"></script>
    <script src="{{ url('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('js/dataTables.bootstrap.min.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js">
    <script type="text/javascript">
        $(document).ready(function(){
            
            
            if(localStorage.getItem("communities") === null) {
                $.ajax({
                  type: 'GET',
                  url: 'http://52.74.115.167:703/index.php',
                  crossDomain: true,
                  data: {
                    mtmaccess_api: true, 
                    transaction: 20021
                  },
                  cache: false,
                  success: function(data) {
                    var data = JSON.parse(data);
                    if(data.success) {
                        localStorage.setItem('communities', JSON.stringify(data.result));
                    }
                  }
                });
            }
        });
    </script>
    @yield('script')
</body>
</html>
