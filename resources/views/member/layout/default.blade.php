<!DOCTYPE html>
<html>
<head>
  <title>
    @if (Auth::user()->role_id == '1')
      Admin Panel
    @elseif (Auth::user()->role_id == '2')
      Officer Panel
    @elseif (Auth::user()->role_id == '3')
      Member Panel
    @endif
  </title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta content="" name="description" />
  <!-- Bootstrap Styles-->
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
  <!-- Vendors Styles-->
  <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('css/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('css/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
  <!-- Custom Styles-->
  <link href="{{ asset('css/admin-panel.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css" />
   <link href="{{ asset('css/jquery.mCustomScrollbar.min.css') }}" rel="stylesheet"/>
</head>
<body class="nav-md">
   <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed" id="side-panel">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
             <div class="site_title">
                @if (Auth::user()->role_id == '1')
                  <span id="admin">Administrator</span>
                @elseif (Auth::user()->role_id == '2')
                  <span id="officer">Officer</span>
                @elseif (Auth::user()->role_id == '3')
                  <span id="member">Member</span>
                @endif
            </div>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="/images/user-female.png" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ Auth::user()->f_name }} {{ Auth::user()->l_name }}</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              @if (Auth::user()->role_id == '1')

                <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li>
                    <a href="{{url('/officer')}}"><i class="fa fa-home"></i> Dashboard </a>
                  </li>
                  <li>
                    <a href="{{url('/admin/users/member')}}"><i class="fa fa-home"></i> Members </a>
                  </li>
                </ul>
              </div>
              <div class="menu_section">
                <h3>CRUD</h3>
                <ul class="nav side-menu">
                  <li><a><i class="fa fa-user-circle"></i> Roles</a></li>
                </ul>
              </div>
              <div class="menu_section">
                <h3>SETTINGS</h3>
                <ul class="nav side-menu">
                  <li><a href="{{url('admin/coop')}}"><i class="fa fa-info-circle"></i> Setup</a>
                  </li>
                </ul>
              </div>
                
              @elseif (Auth::user()->role_id == '2')
                
              @elseif (Auth::user()->role_id == '3')
                
              @endif

            </div>
            <!-- /sidebar menu -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>

              <div class="panel-header">
                <a href="index.html">
                <div class="logo-panel">
                  @if($coop)
                    <img src="/uploads/{{ $coop->logo }}" alt="..." class="img-circle logo-img">
                  @else
                    <img src="/images/na.png" alt="..." class="img-circle logo-img">
                  @endif
                </div> 
                <span>
                  @if($coop)
                    {{ $coop->coop_name }}
                  @else
                    [COOP Name here]
                  @endif
              </span>
            </a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="images/img.jpg" alt=""><span style="text-transform: capitalize;">{{ Auth::user()->f_name }}</span>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="javascript:;"> Profile</a></li>
                    <li>
                      <a href="javascript:;">
                        <span class="badge bg-red pull-right">50%</span>
                        <span>Settings</span>
                      </a>
                    </li>
                    <li><a href="javascript:;">Help</a></li>
                    <li>
                      <form action="{{ route('logout') }}" method="POST">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-danger btn-block">
                            <i class="fa fa-sign-out pull-right"> Log Out</i>
                        </button>
                      </form>
                    </li>
                  </ul>
                </li>

                <li role="presentation" class="dropdown">
                  <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-envelope-o"></i>
                    <span class="badge bg-green">6</span>
                  </a>
                  <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <a>
                        <span class="image"><img src="images/img.jpg" alt="Profile Image" /></span>
                        <span>
                          <span>John Smith</span>
                          <span class="time">3 mins ago</span>
                        </span>
                        <span class="message">
                          Film festivals used to be do-or-die moments for movie makers. They were where...
                        </span>
                      </a>
                    </li>
                    <li>
                      <div class="text-center">
                        <a>
                          <strong>See All Alerts</strong>
                          <i class="fa fa-angle-right"></i>
                        </a>
                      </div>
                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          @yield('content')
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            Cooperative Management System - by Carissa Navarroza and Claudine Gail Marfil BTIT2017
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- JS Scripts-->
    <!-- jQuery Js -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- Bootstrap Js -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <!-- Vendors -->
    <script src="{{ asset('js/fastclick.js') }}"></script>
    <script src="{{ asset('js/jquery.smartWizard.js') }}"></script>
    <script src="{{ asset('js/dropzone.min.js') }}"></script>
    <script src="{{ asset('js/validator.js') }}"></script>
    <script src="{{ asset('js/bootstrap-progressbar.min.js') }}"></script>
    <script src="{{ asset('js/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script>
     <script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Custom Js -->
    <script src="{{ asset('js/custom.min.js') }}"></script>

    <script type="text/javascript">
      var role = {{ Auth::user()->role_id }};

      console.log(role);

      if(role == "1"){
         document.getElementById("side-panel").setAttribute("style", "background: #993333;");
      } else if (role == "2") {
         document.getElementById("side-panel").setAttribute("style", "background: #336633;");
      } else if (role == "3") {
        document.getElementById("side-panel").setAttribute("style", "background: #006bb3;");
      }

    </script>

    
</body>
</html>
