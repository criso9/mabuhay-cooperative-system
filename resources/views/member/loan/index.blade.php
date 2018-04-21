@extends('layout.panel')

@section('content')

<div class="flex-center position-ref full-height">
	<div class="custom-breadcrumb">
    {!! Breadcrumbs::render() !!}
  </div>
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>List of Applied Loans <small></small></h2>
				<div class="col-md-2 col-sm-2 col-xs-12 form-group pull-right" style="width: 143px;">
		          <button type="button" id="cash-loan" class="btn btn-round btn-info" data-toggle="modal" data-target="#cashLoanModal" onclick="applyCashLoan()"> Apply Cash Loan</button>
		        </div>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
			<!-- <div class="off-active" style="width: 120px;"><h4 style="margin-top: 3px;">Current Loans</h4></div> -->
			<br/>
			{{ Form::open(array('route' => 'member.loan.index.filter', 'method' => 'post', 'class' => 'form-horizontal form-label-left pending-type', 'style' => 'width: 22%;float: right; right: -15px;top: 18px;')) }}
	          <input type="hidden" name="_token" value="{{ csrf_token() }}">
	          <div class="form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" style="font-weight: normal;margin-right: -10px;">Status:</label>
	            <div class="col-md-9 col-sm-9 col-xs-12">
	              <select id="status-type" name="statusFilter" class="form-control" style="height: 30.5px;font-size: 12px;" onchange="this.form.submit()">
	                  <option value="all" {{ 'all' == $status_filter ? "selected" : "" }}>All</option>
	                  @foreach($stat as $s)
						<option value="{{$s}}" {{ $s == $status_filter ? "selected" : "" }}>{{$s}}</option>
	                  @endforeach
	              </select>
	            </div>
	          </div>
	        </form>
			<div>
          <table id="loans-list" class="table table-striped table-bordered" style="font-size: 13px;">
            <thead>
            <tr>
              <td>Transaction No.</td>
              <td>Date Applied</td>
              <td>Status</td>
              <td>Date Reviewed</td>
              <td>Reviewed By</td>
              <td>Amount Loan</td>
              <td>Amount Paid</td>
              <td>Interest Paid</td>
              <td>Remaining Balance</td>
              <td>Due Date</td>
              <td>Remarks</td>
            </tr>
            </thead>
            <tbody>
            	@if ($loans->count() > 1)
	                @foreach($loans as $l)
	                  <tr>
	                    <td>{{$l->transaction_no}}</td>
	                    <td>{{$l->date_applied}}</td>
	                    <td>{{$l->status}}</td>
	                    <td>{{$l->reviewed_at}}</td>
	                    <td>{{$l->reviewed_by}}</td>
	                    <td>{{$l->amount_loan}}</td>
	                    <td>{{$l->amount_paid}}</td>
	                    <td>{{$l->interest_amount}}</td>
	                    <td>{{$l->remaining_balance}}</td>
	                    <td>{{$l->due_date}}</td>
	                    <td>{{$l->remarks}}</td>
	                  </tr>
	                @endforeach
	              @elseif ($loans->count() > 0)
	                <tr>
						<td>{{$loans[0]->transaction_no}}</td>
						<td>{{$loans[0]->date_applied}}</td>
						<td>{{$loans[0]->status}}</td>
						<td>{{$loans[0]->reviewed_at}}</td>
						<td>{{$loans[0]->reviewed_by}}</td>
						<td>{{$loans[0]->amount_loan}}</td>
						<td>{{$loans[0]->amount_paid}}</td>
						<td>{{$loans[0]->interest_amount}}</td>
						<td>{{$loans[0]->remaining_balance}}</td>
						<td>{{$loans[0]->due_date}}</td>
						<td>{{$loans[0]->remarks}}</td>
	                </tr>
	              @endif
            </tbody>
          </table>
        </div>
        </div>
		</div>
	</div>
</div>

<div id="cashLoanModal" class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog" role="document" style="width: 65%;">
    <div class="modal-content custom-modal-content">
      <div class="modal-header">
        <button type="button" class="close stat-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="statusModalLabel">Cash Loan</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(array('route' => array('member.loan.store'), 'method' => 'post', 'class' => 'form-horizontal form-label-left', 'onsubmit' => 'return validate();')) }}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
            <div>
		      	<table width="100%">
		      		<tr>
		      			<td colspan="6"><b>Date:</b> {{ date('F d, Y') }}</td>
		      		</tr>
		      		<tr>
		      			<td colspan="6">
		      				<b>Transaction No:</b> 
		      				<span id="transNo"></span>
		      				<input type="hidden" id="_transNo" name="transaction_no"/>
		      			</td>
		      		</tr>

		      		<!-- <tr>
		      			<td align="right">{{ Form::radio('type', 'new') }}</td>
		      			<td>&nbsp;New</td>
		      			<td align="right">{{ Form::radio('type', 'renewal') }}</td>
		      			<td>&nbsp;Renewal</td>
		      			<td colspan="2"></td>
		      		</tr> -->
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
		      		<!-- <tr>
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
		      		</tr> -->
		      		<tr>
		      			<td colspan="6" style="padding-top: 10px;"><b>Loan Information</b></td>
		      		</tr>
		      		<tr>
		      			<td colspan="2">Total Contributions:</td>
		      			<td colspan="4">&#8369;{{$contribution->amount}}</td>
		      		</tr>
		      		<tr>
		      			<td colspan="2">Remaining Balance on Active Loans:</td>
		      			<td colspan="4">&#8369;{{number_format($activeLoan->balance, 2)}}</td>
		      		</tr>
		      		<tr>
		      			<td colspan="2">Loan Limit:</td>
		      			<td colspan="4">&#8369;{{number_format($loanable, 2)}}</td>
		      		</tr>
		      		<tr>
		      			<td colspan="2">Loan Amount:</td>	
		      			<td colspan="4">
		      				<input type="number" id="amount_loan" name="amount_loan" min="1" max="{{$loanable}}" required />
		      			</td>
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
		      			<td colspan="6" align="right">
		      				<button type="submit" class="btn btn-primary">Submit</button>
		      				<input type="hidden" id="confirm" name="confirm"/>
		      				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
		      			</td>
		      		</tr>
		      	</table>
		      </div>
		     
         {{Form::close()}}
      </div>
    </div>
</div>
  </div>



<script src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {
    @if (Session::has('flash_message'))
      Snackbar.show({
        pos: 'top-right', 
        text: '{{ Session::get('flash_message') }}',
      });
    @endif

    $('#loans-list').DataTable({
      // dom: 'B<"clear">lfrtip',
      // buttons: [
      //   'copy', 'csv', 'excel', 'pdf', 'print'
      // ],
      fixedHeader: {
        header: true,
        footer: false
      },
      "order": [[ 1, "desc" ]],
    });

    if(!{{$cashLoan}}){
    	document.getElementById("cash-loan").disabled = true;
    	document.getElementById("cash-loan").setAttribute("title", "Unable to make a loan");
    }

});

  // When the user clicks on the button, open the modal 
  function applyCashLoan() {
      var currentdate = moment().format('YYYYDDMM-HHmmssSS-{{Auth::user()->id}}');
      $('#transNo').text(currentdate);
      $('#_transNo').val(currentdate);
  }

  function validate(form) {
  	 if(confirm("Do you want to proceed?")){
    	// document.forms[1].submit();
    	$('#confirm').val('yes');
    	return true;
	 }else{
	 	$('#confirm').val('no');
	 	return false;
	 }

  }

</script>

@stop