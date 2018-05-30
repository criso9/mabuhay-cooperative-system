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
				<div class="col-md-2 col-sm-2 col-xs-12 form-group pull-right" style="width: 230px;">
		          <!-- <a href="{{route('member.loan.cash')}}" class="btn btn-round btn-info">Apply Cash Loan</a> -->
              {{ Form::open(array('route' => 'member.loan.motor', 'method' => 'get', 'style' => 'display: inline-table;')) }}
                <button type="submit" id="motor-loan" class="btn btn-round btn-info">Motor Loan</button>
              {{ Form::close() }}

              <!-- <a href="{{route('member.loan.motor')}}" id="motor-loan" class="btn btn-round btn-info">Motor Loan</a> -->
              <button type="button" id="cash-loan" class="btn btn-round btn-info" data-toggle="modal" data-target="#cashLoanModal">Cash Loan</button>
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
              <td>Type</td>
              <td>Date Reviewed</td>
              <td>Reviewed By</td>
              <td>Amount Loan</td>
              <td>Amount Repayable</td>
              <td>Amount Paid</td>
              <td>Interest</td>
              <td>Interest Paid</td>
              <td>Share Capital</td>
              <td>Share Capital Paid</td>
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
                      <td>{{$l->loan_type}}</td>
	                    <td>{{$l->reviewed_at}}</td>
	                    <td>{{$l->reviewed_by}}</td>
	                    <td>{{$l->amount_loan}}</td>
                      <td>{{$l->amount_repayable}}</td>
	                    <td>{{$l->amount_paid}}</td>
                      <td>{{$l->interest_amount}}</td>
	                    <td>{{$l->interest_amount_paid}}</td>
                      <td>{{$l->scapital_amount}}</td>
                      <td>{{$l->scapital_amount_paid}}</td>
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
                    <td>{{$loans[0]->loan_type}}</td>
        						<td>{{$loans[0]->reviewed_at}}</td>
        						<td>{{$loans[0]->reviewed_by}}</td>
        						<td>{{$loans[0]->amount_loan}}</td>
                    <td>{{$loans[0]->amount_repayable}}</td>
                    <td>{{$loans[0]->amount_paid}}</td>
                    <td>{{$loans[0]->interest_amount}}</td>
                    <td>{{$loans[0]->interest_amount_paid}}</td>
                    <td>{{$loans[0]->scapital_amount}}</td>
                    <td>{{$loans[0]->scapital_amount_paid}}</td>
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
      	<p><b>Loan Term (months): </b> 6</p>
      	<p><b>Interest Rate (monthly): </b> 2%</p>
      	<p><b>Share Capital (monthly): </b> 3%</p>
      	<p>Please choose the payment type for the Interest and Share Capital</p>
      	<br/>
        <p><b>Sample Computation:</b></p>
      	<table style="width: 30%;" class="cash-computation">
      		<tr>
      			<td>Loan:</td>
      			<td align="right">Php 1,000.00</td>
      		</tr>
      		<tr>
            <td>Interest:</td>
            <td align="right">Php 120.00</td>
      		</tr>
      		<tr>
            <td>Share Capital:</td>
            <td align="right">Php 180.00</td>
      		</tr>
          <tr>
            <td colspan="2"><b>Total Amount Repayable</b></td>
          </tr>
      		<tr>
      			<td>Deduction:</td>
      			<td align="right">Php 700.00</td>
      		</tr>
      		<tr>
      			<td>Additional:</td>
      			<td align="right">Php 1,300.00</td>
      		</tr>
      	</table>
      	<br/>
        <div style="text-align: center;">
          <a href="{{url('/member/loan/cash?t=d')}}" class="btn btn-primary">Deduction</a>
          <a href="{{url('/member/loan/cash?t=a')}}" class="btn btn-success">Additional</a>
        </div>
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

    if(!{{$motorLoan}}){
      document.getElementById("motor-loan").disabled = true;
      document.getElementById("motor-loan").setAttribute("title", "Unable to make a loan");
    }

});

  // When the user clicks on the button, open the modal 
  // function applyCashLoan() {
  //     var currentdate = moment().format('YYYYDDMM-HHmmssSS-{{Auth::user()->id}}');
  //     $('#transNo').text(currentdate);
  //     $('#_transNo').val(currentdate);
  // }

  // function validate(form) {
  // 	 if(confirm("Do you want to proceed?")){
  //   	// document.forms[1].submit();
  //   	$('#confirm').val('yes');
  //   	return true;
	 // }else{
	 // 	$('#confirm').val('no');
	 // 	return false;
	 // }

  // }

</script>

@stop