@extends('layout.panel')

@section('content')

<div class="flex-center position-ref full-height">
	<div class="custom-breadcrumb">
    {!! Breadcrumbs::render() !!}
  </div>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Monthly Profit Report<small></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content" style="margin-bottom: 30px;">
        <canvas id="monthly-report" width="500" height="350"></canvas>
      </div>
      <div class="x_title">
        <h2>Yearly Profit Report<small></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content" style="margin-bottom: 30px;">
        <canvas id="yearly-report" width="500" height="350"></canvas>
      </div>
    </div>
  </div>
</div>

<div id="msgModal" class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content custom-modal-content">
          <div class="modal-header">
              <h3 class="modal-title">Message</h3>
          </div>

          <div class="modal-body">
          	 <br/>
             <p>{{ Session::get('flash_message') }}</p>
             <br/>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="ok-button" data-dismiss="modal">OK</button>
          </div>
      </div>
  </div>
</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript">
  var Month = new Array();
  var Loan = new Array();
  var Business = new Array();

  var Year = new Array();
  var LoanY = new Array();
  var BusinessY = new Array();

	$(document).ready(function() {
		@if (Session::has('flash_message'))
      $('#msgModal').modal('show');
    @endif

    @foreach($monthly as $m)
        Month.push('{{ $m->monthname }}');
    @endforeach

    @foreach($loanMonthly as $lm)
        Loan.push('{{ $lm->amount }}');
    @endforeach

    @foreach($businessMonthly as $bm)
        Business.push('{{ $bm->amount }}');
    @endforeach

    new Chart(document.getElementById("monthly-report"), {
      type: 'bar',
        data: {
            labels:Month,
            datasets: [
              {
                label: "Loan",
                backgroundColor: "#3e95cd",
                data: Loan
              }, {
                label: "Business",
                backgroundColor: "#8e5ea2",
                data: Business
              }
            ]
        },
        options: {
          responsive: false,
          scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
          },
          legend: { display: true }
      }
    });

    //yearly
    @foreach($yearly as $y)
        Year.push('{{ $y->yearname }}');
    @endforeach

    @foreach($loanYearly as $ly)
        LoanY.push('{{ $ly->amount }}');
    @endforeach

    @foreach($businessYearly as $by)
        BusinessY.push('{{ $by->amount }}');
    @endforeach

    new Chart(document.getElementById("yearly-report"), {
      type: 'bar',
        data: {
            labels:Year,
            datasets: [
              {
                label: "Loan",
                backgroundColor: "#3e95cd",
                data: LoanY
              }, {
                label: "Business",
                backgroundColor: "#8e5ea2",
                data: BusinessY
              }
            ]
        },
        options: {
          responsive: false,
          scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
          },
          legend: { display: true }
      }
    });

	});
</script>

@stop