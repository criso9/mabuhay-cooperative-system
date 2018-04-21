@extends('layout.panel')

@section('content')

<div class="flex-center position-ref full-height">
	<div class="custom-breadcrumb">
    {!! Breadcrumbs::render() !!}
  </div>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>2018 Contributions <small></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div>
         <div class="panel-body" style="padding:5px;">
           <canvas id="bar-chart" height="200" width="600"></canvas>
        </div>
        </div>
      </div>
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
  var Year = new Array();
  var Amount = new Array();

	$(document).ready(function() {
		@if (Session::has('flash_message'))
	      $('#msgModal').modal('show');
	    @endif


    @foreach($contributions as $cont)
        Month.push('{{ $cont->month }}');
          Amount.push('{{ $cont->amount }}');
      @endforeach

      new Chart(document.getElementById("bar-chart"), {
          type: 'bar',
            data: {
                labels:Month,
                datasets: [{
                  label: 'Amount',
                    data: Amount,
                    borderWidth: 1
                }]
            },
            options: {
            scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                },
                legend: { display: false }
          }
        });
	});


</script>

@stop