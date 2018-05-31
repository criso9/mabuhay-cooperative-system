@extends('layout.panel')

@section('title')
Monthly Contributions
@stop

@section('content')

<div class="flex-center position-ref full-height">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">

        <h2>Receipt <small></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      <br/>

        <div class="monthly-contribution">
          <table id="officer-m-cont" class="table table-striped table-bordered">
          <tbody>
           <tr>
            <td>Name</td>
            <td>{{$loanReceipt->user_loan}}</td>
          </tr>
          <tr>
            <td>Transaction No.</td>
            <td>{{$loanReceipt->transaction_no}}</td>
          </tr>
           <tr>
            <td>Amount Paid</td>
            <td>{{$loanReceipt->amount}}</td>
          </tr>
          <tr>
            <td>Interest Paid</td>
            <td>{{$loanReceipt->interest_amount}}</td>
          </tr>
          <tr>
            <td>Share Capital Paid</td>
            <td>{{$loanReceipt->sharecap_amount}}</td>
          </tr>
           <tr>
            <td>Date Paid</td>
            <td>{{$loanReceipt->date_paid}}</td>
          </tr>
          <tr>
            <td>Payment Type</td>
            <td>{{$loanReceipt->payment_type}}</td>
          </tr>
          <tr>
            <td>Receipt No.</td>
            <td>{{$loanReceipt->receipt_no}}</td>
          </tr>
          <tr>
            <td>Updated By</td>
            <td>{{$loanReceipt->updated_by}}</td>
          </tr>
          </tbody>
        </table>
        </div>

      </div>

    </div>
  </div>


</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function() {
        window.print();
  });


  </script>

@stop