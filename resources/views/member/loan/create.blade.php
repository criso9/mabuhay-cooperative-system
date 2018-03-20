@extends('layout.panel')

@section('title')
Loan Application
@stop

@section('content')

<div class="flex-center position-ref full-height">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">

        <h2>Loan Application <small></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      <br/>

      <div>
      	
      	<table width="100%">
      		<tr>
      			<td colspan="6"><b>Date:</b> {{ date('F d, Y') }}</td>
      		</tr>
      		<tr>
      			<td align="right">{{ Form::radio('type', 'new') }}</td>
      			<td>&nbsp;New</td>
      			<td align="right">{{ Form::radio('type', 'renewal') }}</td>
      			<td>&nbsp;Renewal</td>
      			<td colspan="2"></td>
      		</tr>
      		<tr>
      			<td colspan="6" style="padding-top: 10px;"><b>Applicant's Information</b></td>
      		</tr>
      		<tr>
      			<td>Last Name:</td>
      			<td>{{$user->l_name}}</td>
      			<td>First Name:</td>
      			<td>{{$user->f_name}}</td>
      			<td>Middle Name:</td>
      			<td>{{$user->m_name}}</td>
      		</tr>
      		<tr>
      			<td>Address:</td>
      			<td>{{$user->address}}</td>
      			<td>Contact No:</td>
      			<td>{{$user->phone}}</td>
      			<td>Email:</td>
      			<td>{{$user->email}}</td>
      		</tr>
      		<tr>
      			<td colspan="6" style="padding-top: 10px;"><b>Employment Information</b></td>
      		</tr>
      		<tr>
      			<td colspan="2">Current Employer:</td>
      			<td>{{ Form::text('employer') }}</td>
      			<td colspan="2">Employer Address:</td>
      			<td>{{ Form::text('emp_address') }}</td>
      		</tr>
      		<tr>
      			<td colspan="2"><i>If none, other source of income:</i></td>
      			<td colspan="4">{{ Form::text('other_source') }}</td>
      		</tr>
      		<tr>
      			<td colspan="2">Monthly Income:</td>
      			<td colspan="4">{{ Form::text('income') }}</td>
      		</tr>
      		<tr>
      			<td colspan="6" style="padding-top: 10px;"><b>Loan Information</b></td>
      		</tr>
      		<tr>
      			<td colspan="2">Total Contributions:</td>
      			<td>&#8369;{{$contribution->amount}}</td>
      			<td colspan="2">Loan Limit:</td>
      			<td>&#8369;{{number_format($contribution->loan_limit, 2)}}</td>
      		</tr>
      		<tr>
      			<td colspan="2">Loan Amount:</td>
      			<td colspan="4">{{ Form::input('number', 'loan_amount') }}</td>
      		</tr>
      		<tr>
      			<td colspan="6" style="padding-top: 20px;"></td>
      		</tr>
      		<!-- <tr>
      			<td colspan="6" style="padding-top: 10px;"><b>Applicant's Declaration</b></td>
      		</tr>
      		<tr>
      			<td align="right">{{ Form::checkbox('consent') }}</td>
      			<td colspan="5">&nbsp;I certify that information listed on this application are true and correct to the best of my knowledge and ability. I accept and agree to be bound by the terms and conditions as contained in the Cooperative’s Loans Policy.</td>
      		</tr> -->
      		<tr>
      			<td colspan="6" align="right"> <button type="button" id="myBtn" class="btn btn-primary" data-toggle="modal" data-target = "#change-status-modal">Submit</td>
      		</tr>
      	</table>

      </div>

      <div id="myModal" class="modal">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="favoritesModalLabel">Application Summary</h4>
			</div>
			<div class="modal-body">
				<div>
					<p>
						I hereby apply for loan in an amount of (&#8369; <label id="sum-amount"></label>) in consideration hereof, I promise to pay the said amount to the {{$coop->name}} with interest at the rate of {{$interest->rate}}% a month.
					</p>
				</div>
        
			</div>
		</div>
	</div>

  	  </div>
  	</div>
  </div>
</div>

<script type="text/javascript">

// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
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

</script>


@stop