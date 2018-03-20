@extends('layout.main')

@section('content')

<div id="breadcrumb">
    <div class="container">
      <div class="breadcrumb">
        <li>Home</li>
      </div>
    </div>
  </div>

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

@stop