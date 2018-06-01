<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{{$coop->coop_name}}</title>

  <link rel="icon" href="{{url('/uploads/'.$coop->icon)}}"/>
  
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}"/>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}"/>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/material-design-iconic-font.min.css') }}"/>
  <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.min.css') }}" type="text/css" />
  <link rel="stylesheet" type="text/css" href="{{ asset('css/animate.css') }}"/>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/hamburgers.min.css') }}"/>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/animsition.min.css') }}"/>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/select2.min.css') }}"/>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}"/>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}"/>
  <link href="{{ asset('css/prettyPhoto.css') }}" rel="stylesheet">
  <link href="{{ asset('css/style-home.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
  <header style="margin-bottom: 100px;">
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <!--<div class="navigation">-->
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse.collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <div class="nav navbar-brand" style="max-width: 550px;height: auto;">
              <a href="{{url('/')}}"><h1>
                @if($coop)
                  <img src="{{url('/uploads/'.$coop->logo)}}" alt="..." class="img-circle logo-img" id="coop-logo">
                  <span>{{ $coop->coop_name }}</span>
                @else
                  <img src="{{url('/images/na.png')}}" alt="..." class="img-circle logo-img">
                  <span>[COOP Name here] </span>
                @endif
              </h1></a>
            </div>
          </div>
          <div class="navbar-collapse collapse">
            <div class="top-menu">
              <ul class="nav nav-tabs navbar-nav" role="tablist">
                <li role="presentation"><a href="{{url('/')}}">Home</a></li>
                <li role="presentation"><a href="{{url('/about')}}">About Us</a></li>
                <li role="presentation"><a href="{{url('/services')}}">Services</a></li>
                <!-- <li role="presentation"><a href="{{url('/contacts')}}">Contact Us</a></li> -->
              </ul>
              <ul class="nav nav-tabs navbar-nav navbar-right login-menu">
                <li>
                    @if(Auth::check())
                      @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 4)
                          <a href="{{route('admin.index')}}">
                      @elseif(Auth::user()->role_id == 2)
                          <a href="{{route('officer.index')}}">
                      @elseif(Auth::user()->role_id == 3)
                          <a href="{{route('member.index')}}">
                      @endif
                        <div class="logo-panel" style="margin-top: -6px;">
                            <img src="{{ '/uploads/profile/'.Auth::user()->avatar }}" class="img-circle logo-img">
                        </div>
                        <span>
                            {{ Auth::user()->f_name }} {{ Auth::user()->l_name }}
                        </span>
                      </a>
                    @else
                        <a href="{{route('login')}}"><span style="margin-right: 5px;"></span><i class="fa fa-sign-in"></i> Login</a>
                    @endif
                </li>
              </ul>
            </div>
          </div>

        </div>
        <div id="breadcrumb">
            <div class="container">
              <div class="breadcrumb" style="padding: 0px;font-size: 14px;">
                @yield('breadcrumb')
              </div>
            </div>
          </div>
      <!--</div>-->
    </nav>
  </header>
        <div class="preloader"><span class="preloader-gif"></span></div>
        <!-- page content -->
        <div>
          @yield('content')
        </div>
        <!-- /page content -->

  <!--===============================================================================================-->
  <script src="{{ asset('js/moment.min.js') }}"></script>
  <!-- <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script> -->
  <script src="{{ asset('js/jquery.min.js') }}"></script>
  <!--===============================================================================================-->
    <script src="{{ asset('js/animsition.min.js') }}"></script>
  <!--===============================================================================================-->
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
     <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
  <!--===============================================================================================-->
    <script src="{{ asset('js/select2.min.js') }}"></script>
  <!--===============================================================================================-->
    <script src="{{ asset('js/countdowntime.js') }}"></script>
  <!--===============================================================================================-->
    <script src="{{ asset('js/main.js') }}"></script>

  <script src="js/jquery.prettyPhoto.js"></script>
  <script src="js/jquery.isotope.min.js"></script>
  <script src="js/wow.min.js"></script>
  <!-- <script src="js/functions.js"></script> -->
  <script src="{{ asset('js/loader.js') }}"></script>
  <script src="{{ asset('js/jquery.inputmask.bundle.js') }}"></script>
  <script type="text/javascript">
 
    $(document).ready(function () {

        var url = window.location;
        $('ul.nav a[href="'+ url +'"]').addClass('active');
        $('ul.nav a').filter(function() {
             return this.href == url;
        }).addClass('active');


    });
  
  </script>

  

</body>

</html>