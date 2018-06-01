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

  <link rel="icon" href="{{url('/uploads/'.$coop->icon)}}"/>

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
   


   <!-- Generic page styles -->
<link rel="stylesheet" href="{{asset('css/fileupload/style.css')}}">
<!-- blueimp Gallery styles -->
<link rel="stylesheet" href="https://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
<!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
<link rel="stylesheet" href="{{asset('css/fileupload/jquery.fileupload.css')}}">
<link rel="stylesheet" href="{{asset('css/fileupload/jquery.fileupload-ui.css')}}">
<!-- CSS adjustments for browsers with JavaScript disabled -->
<noscript><link rel="stylesheet" href="{{asset('css/fileupload/jquery.fileupload-noscript.css')}}"></noscript>
<noscript><link rel="stylesheet" href="{{asset('css/fileupload/jquery.fileupload-ui-noscript.css')}}"></noscript>


   
  <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" type="text/css" />

  

</head>
<body class="nav-md">

   <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed" id="side-panel">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
             <div class="site_title">
                @if (Auth::user()->role_id == '1' || Auth::user()->role_id == '4')
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
                <img src="{{ '/uploads/profile/'.Auth::user()->avatar }}" alt="..." class="img-circle profile_img">
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
              @if (Auth::user()->role_id == '1' || Auth::user()->role_id == '4')

                <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li>
                    <a href="{{url('/admin')}}"><i class="fa fa-dashboard"></i> Admin Dashboard </a>
                  </li>
                  <li><a><i class="fa fa-users"></i> Users <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="{{url('/admin/users/member')}}">Members</a></li>
                      <li><a href="{{route('admin.officer.index')}}">Officers</a></li>
                      <li><a href="{{route('admin.admin.index')}}">Admins</a></li>
                       <li><a href="{{route('admin.pending.index')}}">Membership Approval</a></li>
                    </ul>
                  </li>
                  <li>
                    <a href="{{route('admin.business.index')}}"><i class="fa fa-briefcase"></i> Business </a>
                  </li>
                  <li>
                    <a href="{{route('admin.poll.index')}}"><i class="fa fa-question-circle"></i> Poll </a>
                  </li>
                  <li>
                    <a href="{{route('admin.backup.index')}}"><i class="fa fa-database"></i> Backup </a>
                  </li>
                </ul>
              </div>
              <div class="menu_section">
                <h3>Others</h3>
                <ul class="nav side-menu">
                  @if($position != '' || Auth::user()->role_id == '4')
                    <li>
                      <a href="#" id="officer-links" data-toggle="modal" data-target="#officerModal"><i class="fa fa-external-link-square"></i> Officer Links</a>
                    </li>
                  @endif
                  <li>
                    <a href="#" id="member-links" data-toggle="modal" data-target="#memberModal"><i class="fa fa-external-link-square"></i> Member Links</a>
                  </li>
                </ul>
              </div>
              <div class="menu_section">
                <h3>SETTINGS</h3>
                <ul class="nav side-menu">
                  <li><a href="{{url('admin/coop')}}"><i class="fa fa-gear"></i> Setup</a>
                  </li>
                </ul>
              </div>
              @elseif (Auth::user()->role_id == '2')
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li>
                    <a href="{{route('officer.index')}}"><i class="fa fa-dashboard"></i> Officer Dashboard </a>
                  </li>
                  @if($position == 'Treasurer' || Auth::user()->role_id == '4')
                    <li><a><i class="fa fa-money"></i> Contributions </a>
                      <ul class="nav child_menu">
                        <li><a href="{{route('officer.contribution.monthly')}}">Monthly</a></li>
                        <li><a href="{{route('officer.contribution.damayan')}}">Damayan</a></li>
                        <li><a href="{{route('officer.contribution.sharecapital')}}">Share Capital</a></li>
                      </ul>
                    </li>
                  <li>
                    <a href="{{url('/officer/loan')}}"><i class="fa fa-home"></i> List of Loan </a>
                  </li>
                  @elseif($position == 'President')
                  <li>
                    <a href="{{url('/officer/loan')}}"><i class="fa fa-home"></i> List of Loan </a>
                  </li>
                  @endif
                  <li>
                    <a href="{{route('officer.member.index')}}"><i class="fa fa-users"></i> Members </a>
                  </li>
                  <li>
                    <a href="{{route('officer.business.index')}}"><i class="fa fa-briefcase"></i> Business </a>
                  </li>
                  <li>
                    <a href="{{route('officer.documents.index')}}"><i class="fa fa-file-text"></i> Documents </a>
                  </li>
                  <li>
                    <a href="{{route('officer.announcements.index')}}"><i class="fa fa-bullhorn"></i> Announcements </a>
                  </li>
                </ul>
              </div>
              <div class="menu_section">
                <h3>Others</h3>
                <ul class="nav side-menu">
                  <li>
                    <a href="#" id="member-links" data-toggle="modal" data-target="#memberModal"><i class="fa fa-external-link-square"></i> Member Links</a>
                  </li>
                </ul>
              </div>
              @elseif (Auth::user()->role_id == '3')
                <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li>
                    <a href="{{route('member.index')}}"><i class="fa fa-dashboard"></i> Dashboard </a>
                  </li>
                  <li><a><i class="fa fa-money"></i> Contributions </a>
                    <ul class="nav child_menu">
                      <li><a href="{{route('member.contribution.monthly')}}">Monthly</a></li>
                      <li><a href="{{route('member.contribution.damayan')}}">Damayan</a></li>
                      <li><a href="{{route('member.contribution.sharecapital')}}">Share Capital</a></li>
                    </ul>
                  </li>
                  <li>
                    <a href="{{route('member.loan.index')}}"><i class="fa fa-credit-card"></i> Loans </a>
                  </li>
                  <!-- <li>
                    <a href="{{route('member.report')}}"><i class="fa fa-pie-chart"></i> Reports </a>
                  </li> -->
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
                <a href="{{url('/')}}">
                <div class="logo-panel">
                  @if($coop)
                    <img src="{{url('/uploads/'.$coop->logo)}}" alt="..." class="img-circle logo-img" id="coop-logo">
                  @else
                    <img src="{{url('/images/na.png')}}" alt="..." class="img-circle logo-img">
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
                <li class="profile">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <!-- <img src="images/img.jpg" alt=""> -->
                    <span style="text-transform: capitalize;">{{ Auth::user()->f_name }} {{ Auth::user()->l_name }}  </span>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-animated">
                    <li class="profile-img">
                        <img src="{{ '/uploads/profile/'.Auth::user()->avatar }}" alt="..." class="profile-img">
                        <div class="profile-body">
                            <h5>{{ Auth::user()->f_name }} {{ Auth::user()->l_name }}</h5>
                            <h6>{{ Auth::user()->email }}</h6>
                        </div>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{route('home.index')}}">
                            <i class="voyager-home"></i>Home
                        </a>
                    </li>
                    <li class="class-full-of-rum">
                        <a href="{{route('member.profile.edit')}}">Edit Profile</a>
                    </li>
                    <li class="class-full-of-rum">
                        <a href="{{route('member.password.edit')}}">Change Password</a>
                    </li>
                    <li class="class-full-of-rum">
                        <a href="{{url('/uploads/Mabuhay BNHS.apk')}}">Download Mobile Application</a>
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
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->
        <div class="preloader"><span class="preloader-gif"></span></div>
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

    <div class="modal fade custom-modal" id="officerModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content custom-modal-content" style="width: 100%;">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Officer Links</h4>
          </div>
          <div class="modal-body">
            @if (Auth::user()->role_id == '1' || Auth::user()->role_id == '4')
              <a href="{{route('officer.index')}}" class="btn btn-app">
                <i class="fa fa-dashboard"></i> Dashboard
              </a>
              @if($position == 'President' || $position == 'Treasurer' || Auth::user()->role_id == '4')
              <br/>
              <div style="background: rgb(51, 102, 51) none repeat scroll 0% 0%;;color: #fff;font-weight: bold;text-align: center;"><h5 style="padding: 2px;">Contributions</h5></div>
              <a href="{{route('officer.contribution.monthly')}}" class="btn btn-app">
                <i class="fa fa-calendar"></i> Monthly
              </a>
              <a href="{{route('officer.contribution.damayan')}}" class="btn btn-app">
                <i class="fa fa-medkit"></i> Damayan
              </a>
              <a href="{{route('officer.contribution.sharecapital')}}" class="btn btn-app">
                <i class="fa fa-line-chart"></i> Share Capital
              </a>
              <br/>
              <div style="background: rgb(51, 102, 51) none repeat scroll 0% 0%;;color: #fff;font-weight: bold;text-align: center;"><h5 style="padding: 2px;">Others</h5></div>
              <a href="{{url('/officer/loan')}}" class="btn btn-app">
                <i class="fa fa-credit-card"></i> List of Loan
              </a>
              <a href="{{route('officer.member.index')}}" class="btn btn-app">
                <i class="fa fa-users"></i> Members
              </a>
              <a href="{{route('officer.business.index')}}" class="btn btn-app">
                <i class="fa fa-briefcase"></i> Business
              </a>
              <a href="{{route('officer.documents.index')}}" class="btn btn-app">
                <i class="fa fa-file-text"></i> Documents 
              </a>
              <a href="{{route('officer.announcements.index')}}" class="btn btn-app">
                <i class="fa fa-bullhorn"></i> Announcements 
              </a>

              @endif
            @endif
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade custom-modal" id="memberModal">
      <div class="modal-dialog" role="document">
        <div class="modal-content custom-modal-content" style="width: 100%;">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Member Links</h4>
          </div>
          <div class="modal-body">
            @if (Auth::user()->role_id != '3')
              <a href="{{route('member.index')}}" class="btn btn-app">
                <i class="fa fa-dashboard"></i> Dashboard
              </a>
              <br/>
              <div style="background: rgb(0, 107, 179) none repeat scroll 0% 0%;;color: #fff;font-weight: bold;text-align: center;"><h5 style="padding: 2px;">Contributions</h5></div>
              <a href="{{route('member.contribution.monthly')}}" class="btn btn-app">
                <i class="fa fa-calendar"></i> Monthly
              </a>
              <a href="{{route('member.contribution.damayan')}}" class="btn btn-app">
                <i class="fa fa-medkit"></i> Damayan
              </a>
              <a href="{{route('member.contribution.sharecapital')}}" class="btn btn-app">
                <i class="fa fa-line-chart"></i> Share Capital
              </a>
              <br/>
              <div style="background: rgb(0, 107, 179) none repeat scroll 0% 0%;;color: #fff;font-weight: bold;text-align: center;"><h5 style="padding: 2px;">Others</h5></div>
              <a href="{{route('member.loan.index')}}" class="btn btn-app">
                <i class="fa fa-credit-card"></i> Loans
              </a>
              <!-- <a href="{{route('member.report')}}" class="btn btn-app">
                <i class="fa fa-pie-chart"></i> Reports
              </a> -->
            @endif

          </div>
        </div>
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
    <!-- <script src="{{ asset('js/dropzone.min.js') }}"></script> -->
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
   
    <script src="{{ asset('js/Chart.js') }}" charset="utf-8"></script>
    <script src="{{ asset('js/snackbar.js') }}"></script>
    <!-- Custom Js -->
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('js/loader.js') }}"></script>
    <script src="{{ asset('js/jquery.inputmask.bundle.js') }}"></script>
    <script type="text/javascript">

      var role = {{ Auth::user()->role_id }};

      // console.log(role);

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
