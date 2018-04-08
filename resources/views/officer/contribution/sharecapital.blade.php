@extends('layout.panel')

@section('title')
Share Capital
@stop

@section('content')

<div class="flex-center position-ref full-height">
	<div class="custom-breadcrumb">
    {!! Breadcrumbs::render() !!}
  </div>
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">

				<h2>Share Capital <small></small></h2>
				<div class="col-md-2 col-sm-2 col-xs-12 form-group pull-right" style="width: 143px;">
					<button type="button" id="myBtn" class="btn btn-primary" data-toggle="modal" data-target = "#change-status-modal"> Add Contribution</button>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">

				<div class="monthly-contribution">
					<table id="officer-sc-cont" class="table table-striped table-bordered">
						<thead>
						<tr>
						  <th>Name</th>
						</tr>
						</thead>

						<tbody>
						@if ($sharecapital->count() > 1)
						  @foreach($sharecapital as $sc)
						    <tr>
						      <td style="text-transform: capitalize;">{{$sc->l_name}}, {{$sc->f_name}}</td>
						    </tr>
						  @endforeach
						@elseif ($sharecapital->count() > 0)
						  <tr>
						    <td style="text-transform: capitalize;">{{$sharecapital[0]->l_name}}, {{$sharecapital[0]->f_name}}</td>
						  </tr>
						@endif
						</tbody>
					</table>
		        </div>
			</div>
		</div>
	</div>

	<div id="myModal" class="modal custom-modal">
		<div class="modal-content custom-modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="favoritesModalLabel">Add contribution</h4>
			</div>
			<div class="modal-body">
				{{ Form::model($sharecapital, array('route' => array('officer.contribution.store'), 'method' => 'post', 'class' => 'form-horizontal form-label-left')) }}
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
		       <!--  <input type="hidden" id="_year" name="_year"> -->
		        <input type="hidden" name="payment_id" value="{{ $payment->id }}">
				<div class="form-group">
	                <label class="control-label col-md-4 col-sm-4 col-xs-12">Name
	                </label>
	                 <div class="col-md-8 col-sm-8 col-xs-12">
	                  {!! Form::select('user_id', $users, null, ['class' => 'form-control', 'style' => 'text-transform: Capitalize;']) !!}
	                </div>
	            </div>
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Date
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12" style="height: 34px;">     
                  <div class="input-group date">
                    <input id="myDatepicker" type="text" class="form-control" name="date" />
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                  </div>
                </div>
              </div>
	            <div class="form-group">
	                <label class="control-label col-md-4 col-sm-4 col-xs-12">Amount
	                </label>
	                <div class="col-md-8 col-sm-8 col-xs-12">
	                  <input type="text" name="amount" id="amount" class="form-control col-md-10">
	                </div>
	            </div>
	            <div class="form-group">
	                <label class="control-label col-md-4 col-sm-4 col-xs-12">Payment
	                </label>
	                <div class="col-md-8 col-sm-8 col-xs-12">
	                  {!! Form::select('payment_type', ['Cash' => 'Cash', 'Bank' => 'Bank', 'Palawan Express' => 'Palawan Express'], null, ['class' => 'form-control', 'onchange' => 'paymentMethod(this)']) !!}
	                </div>
	            </div>
               <div class="form-group">
                  <label class="control-label col-md-4 col-sm-4 col-xs-12">Reference No.
                  </label>
                  <div class="col-md-8 col-sm-8 col-xs-12">
                    <input type="text" name="receipt_no" id="receiptno" class="form-control col-md-10" readonly>
                  </div>
              </div>
	             <br/>
	             <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-4">
	             	<button class="btn btn-success">Save</button>
	             </div>
	             
	         	</form>
			</div>
		</div>
	</div>
</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript">

$(document).ready(function() {
    $('#officer-sc-cont').DataTable({
      dom: 'B<"clear">lfrtip',
      buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
      ],
      fixedHeader: {
        header: true,
        footer: false
      }
    });
  });

	// Get the modal
	var modal = document.getElementById('myModal');

	// Get the button that opens the modal
	var btn = document.getElementById("myBtn");

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks on the button, open the modal 
	btn.onclick = function() {
	    modal.style.display = "block";
      //$('#_year').val($('#year-contribution').find(":selected").text());
      $('#myDatepicker').datetimepicker({
      	minDate: moment().add(1, 'h')
      });
	}

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
	    modal.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	    if (event.target == modal) {
	        modal.style.display = "none";
	    }
	}

  function paymentMethod(val) {
    var method = val.value;
    if(method == 'Cash'){
      $('#receiptno').val('');
      $('#receiptno').prop('readonly', true);
    }else{
      $('#receiptno').val('');
      $('#receiptno').prop('readonly', false);
    }
  }

</script>

@stop