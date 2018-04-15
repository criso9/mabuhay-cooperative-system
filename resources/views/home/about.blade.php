@extends('layout.main')

@section('content')

  <div id="breadcrumb">
    <div class="container">
      <div class="breadcrumb">
        <li><a href="{{url('/')}}">Home</a></li>
        <li>About Us</li>
      </div>
    </div>
  </div>

  <div class="aboutus">
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

        Mabuhay BNHS Cooperative is one of the cooperatives that has been formed and was founded by Mr. Reynaldo Ranuco and his batch mates. Mostly, the members of this cooperative was from BNHS. They did not accept members easily, to accept you in our cooperative, you should have referral. 
       </p>
        <p>The cooperative aims to help the members by giving small interest of their loans, give opportunity to have business and if the member or its beneficiary got accident, he/she will received a financial support from the cooperative. </p>
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
      <a href="#" title="Officers" id="prevOfficers" data-toggle="modal" data-trigger="hover" data-target = "#previousOfficersModal">Previous Officers</a> 
      <div class="text-center">
        <div class="col-md-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
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