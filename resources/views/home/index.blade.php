@extends('layout.main')

@section('content')

<div id="breadcrumb">
    <div class="container">
      <div class="breadcrumb" style="padding: 0px;font-size: 14px;">
        <li>Home</li>
      </div>
    </div>
  </div>

  <!-- for carousel -->
  <div class="container">
    <div id="myCarousel" class="carousel slide" data-ride="carousel" style="margin-top: 25px;height: 570px;">
      <!-- <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol> -->

      <ol class="carousel-indicators">
        @if ($carousel->count() > 1)
          @for($i=0; $i<count($carousel); $i++)
            @if ($i == 0)
              <li data-target="#myCarousel" data-slide-to="{{$i}}" class="active"></li>
            @else
              <li data-target="#myCarousel" data-slide-to="{{$i}}"></li>
            @endif
          @endfor
        @elseif ($carousel->count() > 0)
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        @endif
      </ol>

      <!-- <div class="carousel-inner" style="height: 570px;">
        <div class="item active">
            <a href="{{ url('/about') }}">
          <img src="{{ url('images/bmember2.jpg') }}" alt="image" style="width:200%; height:650px!important"></a>
        </div>
 <div class="item">
  <a href="{{ url('/services') }}">
          <img src="{{ url('images/cashcash.png') }}" alt="image" style="width:200%; height:650px!important"></a>
        </div>

        <div class="item">
          <a href="{{ url('/services') }}">
          <img src="{{ url('images/motmot.png') }}" alt="image" style="width:200%; height:650px!important"></a>
        </div>
      </div> -->

      <div class="carousel-inner" style="height: 570px;">
          <?php
            if ($carousel->count() > 1){
              $i = 0;

              foreach ($carousel as $c) {
                if($i == 0){
                  echo '<div class="item active">';
                  echo '<a href="'.url($c->url).'">';
                  echo '<img src="'.url($c->path).'" alt="image" style="height: 570px;
    max-width: 100%;margin:auto;"></a>';
                  echo '</div>';
                }else{
                  echo '<div class="item">';
                  echo '<a href="'.url($c->url).'">';
                  echo '<img src="'.url($c->path).'" alt="image" style="height: 570px;
    max-width: 100%;margin:auto;"></a>';
                  echo '</div>';
                }
                $i++;
              }

            }else if ($carousel->count() > 0){
              echo '<div class="item active">';
              echo '<a href="'.url($carousel[0]->url).'">';
              echo '<img src="'.url($carousel[0]->path).'" alt="image" style="height: 570px;max-width: 100%;margin:auto;"></a>';
              echo '</div>';
            }
            
          ?>
      </div>
     

      <!-- left & right arrows -->
       <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
      </a>

      <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
          </div>
        </div>
        <!--/.item-->
      </div>
      <!--/.carousel-inner-->
    </div>
    <!--end of carousel-->
    <br/>
    <!-- action for announcement -->
    <div class="container">
      <h4>List of Announcements</h4>
      <table class="table table-bordered" style="font-size: 14px;margin-top: 10px;">
        <thead>
          <tr>
            <th> Event Date </th>
            <th> Details </th>
          </tr>
        </thead>
        <tbody style="color:black;">
          <tr>
            <td> April 3, 2018 </td>
            <td> Ongoing development </td>
          </tr>
          <td> April 4, 2018 </td>
          <td> Continuation of development</td>
        </tr>
         </a>
        </tbody>
      </table>
    </div>
    <!-- End of action for announcement -->

@stop