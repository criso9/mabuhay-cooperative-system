<!DOCTYPE html>
<html>
<head>
  <title>
    @yield('title')
  </title>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta content="" name="description" />

  <link rel="icon" href="/uploads/{{$coop->icon}}"/>

  <!-- Bootstrap Styles-->
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
  <!-- Vendors Styles-->
  <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="{{ asset('css/material-design-iconic-font.min.css') }}"/>
  <link href="{{ asset('css/dropzone.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('css/daterangepicker.css') }}" rel="stylesheet" type="text/css" />
  <!-- For tables -->
  <link href="{{ asset('css/tables/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('css/tables/buttons.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('css/tables/fixedHeader.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
  <!-- <link href="{{ asset('css/tables/responsive.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('css/tables/scroller.bootstrap.min.css') }}" rel="stylesheet" type="text/css" /> -->
  <link href="{{ asset('css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('css/snackbar.css') }}" rel="stylesheet" type="text/css" />
  <!-- <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
  <link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" /> -->

  <!-- Custom Styles-->
  <link href="{{ asset('css/admin-panel.min.css') }}" rel="stylesheet" type="text/css" />
   <link href="{{ asset('css/jquery.mCustomScrollbar.min.css') }}" rel="stylesheet"/>
   
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css" />
  

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
                    <a href="{{url('/admin')}}"><i class="fa fa-home"></i> Dashboard </a>
                  </li>
                  <li><a><i class="fa fa-users"></i> Users <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/admin/users/member')}}">Members</a></li>
                      <li><a href="{{route('admin.officer.index')}}">Officers</a></li>
                      <li><a href="{{route('admin.admin.index')}}">Admins</a></li>
                       <li><a href="{{route('admin.pending.index')}}">Membership Approval</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-database"></i> Database <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="tables.html">Backup</a></li>
                      <li><a href="tables_dynamic.html">Restore</a></li>
                    </ul>
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
                 <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li>
                    <a href="{{route('officer.index')}}"><i class="fa fa-home"></i> Dashboard </a>
                  </li>
                  <li><a><i class="fa fa-money"></i> Contributions </a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('officer.contribution.monthly')}}">Monthly</a></li>
                      <li><a href="{{route('officer.contribution.damayan')}}">Damayan</a></li>
                      <li><a href="{{route('officer.contribution.sharecapital')}}">Share Capital</a></li>
                    </ul>
                  </li>
                </ul>
              </div>

              @elseif (Auth::user()->role_id == '3')
                <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li>
                    <a href="{{route('member.index')}}"><i class="fa fa-home"></i> Dashboard </a>
                  </li>
                  <li><a><i class="fa fa-money"></i> Contributions </a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('member.contribution.monthly')}}">Monthly</a></li>
                      <li><a href="{{route('member.contribution.other')}}">Others</a></li>
                    </ul>
                  </li>
                  <li>
                    <a href="{{route('member.loan.apply')}}"><i class="fa fa-credit-card"></i> Loans </a>
                  </li>
                  <li>
                    <a href="{{route('member.report')}}"><i class="fa fa-bar-chart"></i> Reports </a>
                  </li>
                </ul>
              </div>
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
                    <img src="/uploads/{{ $coop->logo }}" alt="..." class="img-circle logo-img" id="coop-logo">
                  @else
                    <img src="/images/na.png" alt="..." class="img-circle logo-img">
                  @endif
                </div> 
                <span>
                  @if($coop)
                    {{ $coop->name }}
                  @else
                    [COOP Name here]
                  @endif
              </span>
            </a>
              </div>

              <ul class="nav navbar-nav navbar-right">
                <li class="profile">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <!-- <img src="images/img.jpg" alt=""> -->
                    <span style="text-transform: capitalize;">{{ Auth::user()->f_name }}</span>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-animated">
                    <li class="profile-img">
                        <img src="/images/user-female.png" alt="..." class="profile-img">
                        <div class="profile-body">
                            <h5>{{ Auth::user()->f_name }} {{ Auth::user()->l_name }}</h5>
                            <h6>{{ Auth::user()->email }}</h6>
                        </div>
                    </li>
                    <li class="divider"></li>
                    <li class="class-full-of-rum">
                        {{ link_to_route('admin.member.show', 'Profile', array(Auth::user()->id)) }}
                    </li>
                    <li>
                        <a href="{{route('home.index')}}">
                            <i class="voyager-home"></i>Home
                        </a>
                    </li>
                    <li>
                      <form action="{{route('logout')}}" method="POST">
                          {{ csrf_field() }}
                          <button type="submit" class="btn btn-danger btn-block">
                            Logout
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
            Cooperative Management System - by Carissa Navarroza and Claudine Gail Marfil BTIT 2017-2018
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

    <!-- JS Scripts-->
    <!-- jQuery Js -->
    
     <script src="{{ asset('js/moment.min.js') }}"></script>

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
    
    <script src="{{ asset('js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- For tables -->
    <script src="{{ asset('js/tables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/tables/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/tables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/tables/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/tables/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/tables/jszip.min.js') }}"></script>
     <script src="{{ asset('js/tables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/tables/vfs_fonts.js') }}"></script>

    <script src="{{ asset('js/tables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/tables/buttons.print.min.js') }}"></script>

    <script src="{{ asset('js/tables/dataTables.fixedHeader.min.js') }}"></script>
    <!-- <script src="{{ asset('js/tables/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('js/tables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/tables/responsive.bootstrap.js') }}"></script>
    <script src="{{ asset('js/tables/dataTables.scroller.min.js') }}"></script> -->
    <script src="{{ asset('js/tables/dataTables.fixedHeader.min.js') }}"></script>
   
    <script src="{{ asset('js/snackbar.js') }}"></script>
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
