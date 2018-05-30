@extends('layout.panel')

@section('title')
Motor Loan Application
@stop

@section('content')

<div class="flex-center position-ref full-height">
  <div class="custom-breadcrumb">
    {!! Breadcrumbs::render() !!}
  </div>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">

        <h2>Motor Loan Application <small></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      <div>
        <p><b>Note: </b>Processing will be based from Motortrade</p>
      
        {{ Form::open(array('route' => array('member.loan.motor.store'), 'method' => 'post', 'class' => 'form-horizontal form-label-left', 'onsubmit' => 'return validate();')) }}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div>
              <div><b>Date:</b> {{ date('F d, Y') }}</div>
              <div>
                <b>Transaction No:</b> 
                  <span id="transNo"></span>
                  <input type="hidden" id="_transNo" name="transaction_no"/>
              </div>
              <br/>
              <div><b>Applicant's Information</b></div>
              <div class="loan-left">
                <table style="width: 100%;">
                  <tr>
                    <td>Last Name:</td>
                    <td>{{$user->l_name}}</td>
                  </tr>
                  <tr>
                    <td>First Name:</td>
                    <td>{{$user->f_name}}</td>
                  </tr>
                  <tr>
                    <td>Middle Name:</td>
                    <td>{{$user->m_name}}</td>
                  </tr>
                  <tr>
                    <td>Address:</td>
                    <td>{{$user->address}}</td>
                  </tr>
                  <tr>
                    <td>Contact No:</td>
                    <td>{{$user->phone}}</td>
                  </tr>
                  <tr>
                    <td>Email:</td>
                    <td>{{$user->email}}</td>
                  </tr>
                </table>
              </div>
               <div class="loan-right">
                <table style="width: 100%;">
                  <tr>
                    <td colspan="1">Total Contributions:</td>
                    <td colspan="5">&#8369;{{$contribution->amount}}</td>
                  </tr>
                </table>
              </div>
              <div style="clear: both;margin-bottom: 20px;"></div>
              
              <div class="loan-left">
                <div><b>Loan Information</b></div>
                <table style="width: 100%;">
                  <tr>
                    <td>Loan Amount</td>
                    <td><input type="number" id="amount_loan" name="amount_loan" min="1" required onkeyup="compute(this.value)" onclick="compute(this.value)"/></td>
                  </tr>
                  <tr>
                    <td>Loan Term (months)</td>
                    <td><span id="terms">36</span></td>
                  </tr>
                  <tr>
                    <td>Interest (monthly)</td>
                    <td>2%</td>
                  </tr>
                </table>
              </div>
              <div class="loan-right">
                <div><b>Computation</b></div>
                <table style="width: 100%;background-color: beige;">
                  <tr>
                    <td colspan="1" style="width: 50%;">Monthly Payment:</td>
                    <td colspan="5">&#8369; 
                      <label id="m_pay"></label>
                      <input type="hidden" name="i_mpay" id="i_mpay">
                    </td>
                  </tr>
                  <tr>
                    <td colspan="1">Total Interest Payment:</td>
                    <td colspan="5">&#8369; <label id="int_pay"></label>
                      <input type="hidden" name="i_intpay" id="i_intpay">
                    </td>
                  </tr>
                  <tr>
                    <td colspan="1">Total Amount Repayable:</td>
                    <td colspan="5">&#8369; <label id="total_pay"></label>
                      <input type="hidden" name="i_tpay" id="i_tpay">
                    </td>
                  </tr>
                </table>
              </div>
              <div style="clear: both;margin-bottom: 20px;"></div>
              <br/>

              <button type="submit" class="btn btn-primary">Submit</button>
              <input type="hidden" id="confirm" name="confirm"/>
              <a href="{{route('member.loan.index')}}" class="btn btn-default">Cancel</a>

          </div>
         
         {{Form::close()}}	
      
      </div>

  	  </div>
  	</div>
  </div>
</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript">

$(document).ready(function() {

  var currentdate = moment().format('YYYYDDMM-HHmmssSS-{{Auth::user()->id}}');
  $('#transNo').text(currentdate);
  $('#_transNo').val(currentdate);

});


function compute(val) {
  var mpay = 0; 
  var tpay = 0; 
  var intpay = 0;

  // intpay = val * $('#terms').text();
  intpay = (val * 0.02) * $('#terms').text();
  var _intpay = Number(Math.round(intpay.valueOf()+'e2')+'e-2');
  $('#int_pay').text(commaSeparateNumber(_intpay));
  $('#i_intpay').val(_intpay);

  tpay = parseInt(intpay, 10) + parseInt(val, 10);
  var _tpay = Number(Math.round(tpay.valueOf()+'e2')+'e-2');
  $('#total_pay').text(commaSeparateNumber(_tpay));
  $('#i_tpay').val(_tpay);

  mpay = tpay.valueOf() / $('#terms').text();
  var _mpay = Number(Math.round(mpay.valueOf()+'e2')+'e-2');
  $('#m_pay').text(commaSeparateNumber(_mpay));
  $('#i_mpay').val(_mpay);
}

function commaSeparateNumber(val){
  while (/(\d+)(\d{3})/.test(val.toString())){
    val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
  }
  return val;
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