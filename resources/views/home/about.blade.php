@extends('layout.main')

@section('breadcrumb')
  <li><a href="{{url('/')}}">Home</a></li>
  <li>About Us</li>
@stop

@section('content')

  <div class="aboutus" style="margin-top: 130px;">
    <div class="container">
      <h3>About 
        @if($coop)
          {{ $coop->coop_name }}
        @else
          [COOP Name here]
        @endif
        Cooperative
      </h3>
      <hr>
      <div class="col-md-7 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
        <img src="images/MBNHS.jpg" class="img-responsive">
        <h4>If we hold on together...Our dreams come true. </h4>
        <p>Bung-aw National High School is a secondary public school located in the municipality of Hilongos, Leyte. It was established on 1977.

        Mabuhay BNHS Cooperative is one of the cooperatives that has been formed and was founded by Mr. Reynaldo Ranuco and his batch mates. Mostly, the members of this cooperative was from BNHS.
       </p>
        <p>The cooperative aims to help the members by giving small interest of their loans, give opportunity to have business and if the member or its beneficiary got accident, he/she will received a financial support from the cooperative.  </p>
        <p><a href="{{url('/register')}}" class="about-link">Register here.</a></p>
      </div>
      <div class="col-md-5 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
          <img src="images/coop.png" class="img-responsive">
          <!-- <img src="images/MBNHS1.jpg" class="img-responsive"> -->
          <img src="images/MBNHS2.jpg" class="img-responsive">


          </div>

              </div>
            </div>
          </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="our-team">
    <div class="container">
      <h3>List of Officers</h3>
      <div class="text-center">
        <div class="col-md-12 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
          <img src="{{url('images/ListOfOfficers.png')}}" alt="" style="height: auto; max-width: 100%;margin-top: 0px;">
        </div>
        <!-- <div class="col-md-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
          <img src="images/boy.png" alt="" style="height:225px; width:225px;">
              <h4>Reynaldo Ranuco Sr. </h4>
              <p>President</p>
        </div>
        <div class="col-md-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="900ms">
          <img src="images/woman.png" alt="">
          <h4>Melodina Vales</h4>
          <p>Treasurer</p>
        </div>
         <div class="col-md-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
          <img src="images/woman.png" alt="">
          <h4>Ma. Teresa Navarroza</h4>
          <p>Secretary</p>
        </div> -->
      </div>
      <div> <a href="#" title="Officers" id="prevOfficers" data-toggle="modal" data-trigger="hover" data-target = "#previousOfficersModal" style="color:blue; text-decoration: underline;font-size: 18px;">Previous Officers</a> </div>
    </div>
  </div>

  <div class="aboutus" style="margin-top: 30px;">
    <div class="container">
      <h3>About the Developers
      </h3>
      <hr>
      <div class="col-md-7 wow fadeInDown dev1" data-wow-duration="1000ms" data-wow-delay="300ms" style="float: left;width: 40%;">
        <img src="images/68claudinegailmarfil.jpg" class="img-responsive" style="width: 220px;text-align: center;">
        <h4>Claudine Gail P. Marfil</h4>
        <h5 style="margin-top: -22px;margin-left: 50px;">Quality Tester</h5>
        <h5 style="margin-top: 5px;margin-left: 46px;">+63908724793</h5>
        <h5 style="margin-top: 5px;margin-left: 27px;">claudmarfil@gmail.com</h5>
      </div>
      <div class="col-md-7 wow fadeInDown dev2" data-wow-duration="1000ms" data-wow-delay="300ms" style="float: left;width: 40%;margin-bottom: 50px;">
        <img src="images/67carissanavarroza.jpg" class="img-responsive" style="width: 220px;text-align: center;">
        <h4>Carissa M. Navarroza</h4>
        <h5 style="margin-top: -22px;margin-left: 24px;">Web Developer/Analyst</h5>
        <h5 style="margin-top: 5px;margin-left: 46px;">+639151178289</h5>
        <h5 style="margin-top: 5px;margin-left: 0px;">carissanavarroza@outlook.com</h5>
      </div>
              </div>
            </div>
          </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="previousOfficersModal" class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content custom-modal-content">
      <div class="modal-header">
        <button type="button" id="reject-close" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="statusModalLabel">List of Previous Officers</h4>
      </div>
      <div class="modal-body">
        <!-- History of officers -->
        <div>
          <table class="table table-bordered" style="color: black;font-size: 14px;">
            <thead>
              <tr>
                <th> Position </th>
                <th> Name </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td> President </td>
                <td> Reynaldo Ranuco </td>
              </tr>
              <td> Vice President </td>
              <td> Richard Lunjas</td>
            </tr>
            <tr>
                <td> Secretary </td>
                <td> Ma. Teresa Navarroza </td>
              </tr>
              <td> Treasurer </td>
              <td> Melodina Vales</td>
            </tr>
             <tr>
                <td> Asst. Treasurer </td>
                <td> Mary Jane Bacalso</td>
              </tr>
              <td> Auditor </td>
              <td> Virgenia Lor</td>
            </tr>
             </a>
            </tbody>
          </table>
        </div>
        <!-- End of history -->
      </div>
    </div>
  </div>
  </div>

<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script type="text/javascript">
  $("#prevOfficers").hover(function () {
    $('#previousOfficersModal').modal({
        show: true,
        backdrop: false
    })
});
</script>

@stop