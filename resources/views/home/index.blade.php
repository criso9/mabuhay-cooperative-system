<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Mabuhay BNHS Coop Page</title>

  <!-- Bootstrap -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/animate.css">
  <link href="css/prettyPhoto.css" rel="stylesheet">
  <link href="css/style-home.css" rel="stylesheet" />
</head>

<body>
  <header>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="navigation">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse.collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <div class="navbar-brand">
              <a href="index.html"><h1>
                @if($coop)
                  <span>{{ $coop->name }}</span>
                @else
                  <span>[COOP Name here] </span>
                @endif
              </h1></a>
            </div>
          </div>

          <div class="navbar-collapse collapse">
            <div class="menu">
              <ul class="nav nav-tabs" role="tablist">
                <li role="presentation"><a href="index.html" class="active">Home</a></li>
                <li role="presentation"><a href="about.html">About Us</a></li>
                <li role="presentation"><a href="services.html">Services</a></li>
                <li><a href="{{ url('/login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>

  <section id="main-slider" class="no-margin">
    <div class="carousel slide">
      <div class="carousel-inner">
        <div class="item active" style="background-image: url(/images/bmember2.jpg)">
          <div class="container">
            <div class="row slide-margin">
              <div class="col-sm-6">
                <div class="carousel-content">
                  <h2 class="animation animated-item-1">BE A <span>MEMBER</span></h2>
                  <!-- <p class="animation animated-item-2">Accusantium doloremque laudantium totam rem aperiam, eaque ipsa...</p> -->
                  <a class="btn-slide animation animated-item-3" href="{{ url('/register') }}">Join Us!</a>
                </div>
              </div>

             <!--  <div class="col-sm-6 hidden-xs animation animated-item-4">
                <div class="slider-img">
                  <img src="images/motto.jpg" class="img-responsive">
                </div> -->
              </div>


            </div>
          </div>
        </div>
        <!--/.item-->
      </div>
      <!--/.carousel-inner-->
    </div>
    <!--/.carousel-->
  </section>
  <!--/#main-slider-->

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="js/jquery-3.2.1.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.prettyPhoto.js"></script>
  <script src="js/jquery.isotope.min.js"></script>
  <script src="js/wow.min.js"></script>
  <script src="js/functions.js"></script>

</body>

</html>
