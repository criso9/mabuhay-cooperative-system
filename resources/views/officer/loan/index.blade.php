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
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
			<br/>
			{{ Form::open(array('route' => 'officer.loan.index.filter', 'method' => 'post', 'class' => 'form-horizontal form-label-left pending-type', 'style' => 'width: 22%;float: right; right: -15px;top: 18px;')) }}
	          <input type="hidden" name="_token" value="{{ csrf_token() }}">
	          <div class="form-group">
	            <label class="control-label col-md-3 col-sm-3 col-xs-12" style="font-weight: normal;margin-right: -10px;">Status:</label>
	            <div class="col-md-9 col-sm-9 col-xs-12">
	              <select id="status-type" name="statusFilter" class="form-control" style="height: 30.5px;font-size: 12px;" onchange="this.form.submit()">
	                  <option value="all" {{ 'all' == $status_filter ? "selected" : "" }}>All</option>
	                  @foreach($stat as $s)
	                  	@if($s == 'Pending')
							<option value="{{$s}}" {{ $s == $status_filter ? "selected" : "" }}>For Approval</option>
						@else
							<option value="{{$s}}" {{ $s == $status_filter ? "selected" : "" }}>{{$s}}</option>
	                  	@endif
	                  @endforeach
	              </select>
	            </div>
	          </div>
	        {{ Form::close() }}
			<div>
          <table id="loans-list" class="table table-striped table-bordered" style="font-size: 13px;">
            <thead>
            <tr>

          	  @if($status_filter == 'Pending')
  				      <td class="no-sort">Approve</td>
                <td class="no-sort">Reject</td>
          	  @endif

              <td>Transaction No.</td>
              <td>Date Applied</td>
              <td>Name</td>
              <td>Status</td>
              <td>Amount Loan</td>
              <td>Amount Paid</td>
              <td>Remaining Balance</td>
              <td>Due Date</td>
            </tr>
            </thead>
            <tbody>
            	@if ($loans->count() > 1)
	                @foreach($loans as $l)
	                  <tr>
	                  	@if($status_filter == 'Pending')
							         @if($position == 'President')
                          <td align="middle">
                            <a href="" id="approveBtn" data-toggle="modal" data-target = "#approveModal" onclick="approveStatus('{{$l->id}}', '{{$l->amount_loan}}')"><img id="{{$l->id}}-approve" src="/images/approve.png" style="width:25px; height: 25px;" onmouseover="onHover('{{$l->id}}-approve');" onmouseout="offHover('{{$l->id}}-approve');"/></a>
                          </td>
                          <td align="middle">
                            <a href="" id="rejectBtn" data-toggle="modal" data-target = "#rejectModal" onclick="rejectStatus('{{$l->id}}')"><img id="{{$l->id}}-reject" src="/images/reject.png" style="width:25px; height: 25px;" onmouseover="rejHover('{{$l->id}}-reject');" onmouseout="rejOffHover('{{$l->id}}-reject');"/></a>
                          </td>
                        @else if ($position == 'Treasurer')
                          @if($l->user_id == '')
                            <td align="middle">
                            <a href="" id="approveBtn" data-toggle="modal" data-target = "#approveModal" onclick="approveStatus('{{$l->id}}', '{{$l->amount_loan}}')"><img id="{{$l->id}}-approve" src="/images/approve.png" style="width:25px; height: 25px;" onmouseover="onHover('{{$l->id}}-approve');" onmouseout="offHover('{{$l->id}}-approve');"/></a>
                          </td>
                          <td align="middle">
                            <a href="" id="rejectBtn" data-toggle="modal" data-target = "#rejectModal" onclick="rejectStatus('{{$l->id}}')"><img id="{{$l->id}}-reject" src="/images/reject.png" style="width:25px; height: 25px;" onmouseover="rejHover('{{$l->id}}-reject');" onmouseout="rejOffHover('{{$l->id}}-reject');"/></a>
                          </td>
                          @else
                            <td align="middle">
                            <a href="" id="approveBtn" data-toggle="modal" data-target = "#approveModal" onclick="approveStatus('{{$l->id}}', '{{$l->amount_loan}}')"><img id="{{$l->id}}-approve" src="/images/approve.png" style="width:25px; height: 25px;" onmouseover="onHover('{{$l->id}}-approve');" onmouseout="offHover('{{$l->id}}-approve');"/></a>
                          </td>
                          <td align="middle">
                            <a href="" id="rejectBtn" data-toggle="modal" data-target = "#rejectModal" onclick="rejectStatus('{{$l->id}}')"><img id="{{$l->id}}-reject" src="/images/reject.png" style="width:25px; height: 25px;" onmouseover="rejHover('{{$l->id}}-reject');" onmouseout="rejOffHover('{{$l->id}}-reject');"/></a>
                          </td>
                          @endif
                       @endif
						          @endif
	                    <td>{{$l->transaction_no}}</td>
	                    <td>{{$l->date_applied}}</td>
	                    <td>{{$l->f_name}}, {{$l->l_name}}</td>
	                    <td>{{$l->status}}</td>
	                    <td>{{$l->amount_loan}}</td>
	                    <td>{{$l->amount_paid}}</td>
	                    <td>{{$l->remaining_balance}}</td>
	                    <td>{{$l->due_date}}</td>
	                  </tr>
	                @endforeach
	              @elseif ($loans->count() > 0)
	                <tr>
	                	@if($status_filter == 'Pending')
							       <td align="middle">
                    	<a href="" id="approveBtn" data-toggle="modal" data-target = "#approveModal" onclick="approveStatus('{{$loans[0]->id}}', '{{$loans[0]->amount_loan}}')"><img id="{{$loans[0]->id}}-approve" src="/images/approve.png" style="width:25px; height: 25px;" onmouseover="onHover('{{$loans[0]->id}}-approve');" onmouseout="offHover('{{$loans[0]->id}}-approve');"/></a>
                  	</td>
                  	<td align="middle">
                    	<a href="" id="rejectBtn" data-toggle="modal" data-target = "#rejectModal" onclick="rejectStatus('{{$loans[0]->id}}')"><img id="{{$loans[0]->id}}-reject" src="/images/reject.png" style="width:25px; height: 25px;" onmouseover="rejHover('{{$loans[0]->id}}-reject');" onmouseout="rejOffHover('{{$loans[0]->id}}-reject');"/></a>
                  	</td>
						        @endif
        						<td>{{$loans[0]->transaction_no}}</td>
        						<td>{{$loans[0]->date_applied}}</td>
                    <td>{{$loans[0]->f_name}}, {{$loans[0]->l_name}}</td>
        						<td>{{$loans[0]->status}}</td>
        						<td>{{$loans[0]->amount_loan}}</td>
        						<td>{{$loans[0]->amount_paid}}</td>
        						<td>{{$loans[0]->remaining_balance}}</td>
        						<td>{{$loans[0]->due_date}}</td>
	                </tr>
	              @endif
            </tbody>
          </table>
        </div>
        </div>
		</div>
	</div>
</div>

<div id="rejectModal" class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content custom-modal-content">
    <div class="modal-header">
      <button type="button" id="reject-close" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <h4 class="modal-title" id="statusModalLabel">Reject Loan Application</h4>
    </div>
    <div class="modal-body">
      {{ Form::open(array('route' => array('officer.email.loan.approval'), 'method' => 'post', 'id' => 'reg-approval-form', 'class' => 'form-horizontal form-label-left')) }}
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="_status" value="reject">
          <input type="hidden" name="_id" id="rej_id">

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Remarks <span class="req">*</span>
            </label>
            <div class="col-md-9 col-sm-9 col-xs-12">     
              <textarea name="remarks" placeholder="Enter text here" style="width: 100%;" required></textarea>
            </div>
          </div>
         <br/>
         <div style="float: right;">
            <button type="submit" class="btn btn-primary">Proceed</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
         </div>
      {{ Form::close() }}
    </div>
  </div>
</div>
</div>

<div id="approveModal" class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content custom-modal-content">
    <div class="modal-header">
      <button type="button" id="reject-close" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <h4 class="modal-title" id="statusModalLabel">Approve Loan Application</h4>
    </div>
    <div class="modal-body">
      {{ Form::open(array('route' => array('officer.email.loan.approval'), 'method' => 'post', 'id' => 'reg-approval-form', 'class' => 'form-horizontal form-label-left')) }}
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="_status" value="approve">
          <input type="hidden" name="_id" id="app_id">
          <input type="hidden" name="_remBal" id="app_remBal">
          
          <div class="form-group">
           <p>Are you sure you want to approve this loan application?</p>
          </div>
         <br/>
         <div style="float: right;">
            <button type="submit" class="btn btn-primary">Proceed</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
         </div>
      {{ Form::close() }}
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

    @if ($status_filter == 'Pending')
      $('#loans-list').DataTable({
        fixedHeader: {
          header: true,
          footer: false
        },
        "order": [[ 3, "desc" ]],
        "columnDefs": [
          { "orderable": false, "targets": "no-sort" }
        ]
      });
    @else
      $('#loans-list').DataTable({
        fixedHeader: {
          header: true,
          footer: false
        },
        "order": [[ 1, "desc" ]]
      });
    @endif
    

});


  	function onHover(idVal)
    {
        $("#" + idVal).attr('src', '/images/approve-hover.png');
    }

    function offHover(idVal)
    {
        $("#" + idVal).attr('src', '/images/approve.png');
    }

    function rejHover(idVals)
    {
        $("#" + idVals).attr('src', '/images/reject-hover.png');
    }

    function rejOffHover(idVals)
    {
        $("#" + idVals).attr('src', '/images/reject.png');
    }

    function approveStatus(id, remBal) {
      $('#app_id').val(id);
      $('#app_remBal').val(remBal);
    }

    function rejectStatus(id) {
      $('#rej_id').val(id);
    }

</script>

@stop