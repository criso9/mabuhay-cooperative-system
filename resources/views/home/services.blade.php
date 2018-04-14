@extends('layout.main')

@section('content')

<div id="breadcrumb">
    <div class="container">
      <div class="breadcrumb">
        <li><a href="{{url('/')}}">Home</a></li>
        <li>Services</li>
      </div>
    </div>
  </div>

  <div class="services">
    <div class="container">
      <h3>BNHS Cooperative Services</h3>
      <hr>
      <div class="col-md-6">
        <img src="images/motmot.png" class="img-responsive">
        <p> Mabuhay BNHS Cooperative is a partnership of Motortrade. So, if you are planning to have the motorcycle you like. Inquire and Apply for you to have it! </p>
      </div>

      <div class="col-md-6">
        <div class="media">
          <ul>
            <li>
              <div class="media-left">
                <i class="fa fa-user"></i>
              </div>
              <div class="media-body">
                <h4 class="media-heading">Who can avail</h4>
                <i class="fa fa-check" style="font-size:17px"> Mabuhay BNHS Cooperative Regular Member.</i> <p></p>
              </div>
            </li>
            <li>
              <div class="media-left">
                <i class="fa fa-pencil"></i>
              </div>
            <div class="media-body">
                <h4 class="media-heading">Requirement</h4>
                <i class="fa fa-check" style="font-size:17px"> Filled-out motorcycle loan form. </i> <p></p>
              </div>
            </li>
            
          </ul>
        </div>
      </div>
    </div>
  </div>

  <div class="sub-services">
    <div class="container">
      <div class="col-md-6">
        <div class="media">
          <ul>
            <li>
              <div class="media-left">
                <i class="fa fa-user"></i>
              </div>
              <div class="media-body">
                <h4 class="media-heading">Who can avail</h4>
                <i class="fa fa-check" style="font-size:17px"> Mabuhay BNHS Cooperative Member.</i> <p></p>
              </div>
            </li>
            <li>
              <div class="media-left">
                <i class="fa fa-pencil"></i>
              </div>
            <div class="media-body">
                <h4 class="media-heading">Requirement</h4>
                <i class="fa fa-check" style="font-size:17px"> Filled-out cash loan form. </i> <p></p>
              </div>
            </li>
           
          </ul>
        </div>
      </div>

      <div class="col-md-6">
        <img src="images/cashcash.png" class="img-responsive">
        <p></p>
      </div>
    </div>
  </div>


@stop
