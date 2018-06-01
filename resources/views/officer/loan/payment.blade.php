@extends('layout.panel')

@section('content')

<div class="flex-center position-ref full-height">
  <div class="custom-breadcrumb">
    {!! Breadcrumbs::render() !!}
  </div>
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Loan Payment <small></small></h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
			<br/>
			<div>
        {{ Form::open(array('route' => 'officer.loan.store', 'method' => 'post', 'class' => 'form-horizontal form-label-left')) }}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_id">
        <input type="hidden" name="interest" value="{{$int}}">
        <input type="hidden" name="sharecap" value="{{$sh}}">
        <input type="hidden" name="type" value="{{$loans->type}}">
        <input type="hidden" name="repayable" value="{{$loans->amount_repayable}}">
        <div class="form-group">
          <label class="control-label col-md-2 col-sm-2 col-xs-12">Transaction No.
          </label>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <input type="text" name="transaction_no" id="transaction_no" class="form-control col-md-10" readonly value="{{$loans->transaction_no}}">
          </div>
      </div>
      <div class="form-group">
          <label class="control-label col-md-2 col-sm-2 col-xs-12">Amount Due
          </label>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <input type="text" name="amount_due" id="amount_due" class="form-control col-md-10" readonly value="{{$amount_due}}">
          </div>
      </div>
      <div class="form-group">
          <label class="control-label col-md-2 col-sm-2 col-xs-12">Minimum Amount Due
          </label>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <input type="text" name="minimum" id="minimum" class="form-control col-md-10" readonly value="{{$minimum}}">
          </div>
      </div>
      <div class="form-group">
          <label class="control-label col-md-2 col-sm-2 col-xs-12">Amount
          </label>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <input type="number" name="amount" id="amount" class="form-control col-md-10" min="{{$minimum}}" max="{{$amount_due}}" step=".01" required>
          </div>
      </div>
      <div class="form-group">
        <label class="control-label col-md-2 col-sm-2 col-xs-12">Date Paid
        </label>
        <div class="col-md-4 col-sm-4 col-xs-12" style="height: 34px;">     
          <div class="input-group date">
            <input id="date_paid" type="text" class="form-control" name="date_paid" required />
            <span class="input-group-addon">
              <span class="glyphicon glyphicon-calendar"></span>
            </span>
          </div>
        </div>
      </div>
      <div class="form-group">
          <label class="control-label col-md-2 col-sm-2 col-xs-12">Payment
          </label>
          <div class="col-md-4 col-sm-4 col-xs-12">
            {!! Form::select('payment_type', ['Cash' => 'Cash', 'Bank' => 'Bank', 'Palawan Express' => 'Palawan Express'], null, ['class' => 'form-control', 'onchange' => 'paymentMethod(this)']) !!}
          </div>
      </div>
       <div class="form-group">
          <label class="control-label col-md-2 col-sm-2 col-xs-12">Reference No.
          </label>
          <div class="col-md-4 col-sm-4 col-xs-12">
            <input type="text" name="receipt_no" id="receiptno" class="form-control col-md-10" readonly required>
          </div>
      </div>
       <br/>
       <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2">
        <a href="{{route('officer.loan.index')}}" class="btn btn-default">Back</a>
        <button class="btn btn-primary">Save</button>
       </div>
       
    {{Form::close()}}        
        </div>
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
    
    $('#date_paid').datetimepicker({
      maxDate: moment().add(1, 'h')
    });

    var currentdate = moment().format('MMDDYYYY-HHmmssSS');
    $('#receiptno').val(currentdate);

});

    function paymentMethod(val) {
    var method = val.value;
    if(method == 'Cash'){
      // $('#receiptno').val('');
      $('#receiptno').prop('readonly', true);
      var currentdate = moment().format('MMDDYYYY-HHmmssSS');
      $('#receiptno').val(currentdate);
    }else{
      $('#receiptno').val('');
      $('#receiptno').prop('readonly', false);
    }
  }

</script>

@stop