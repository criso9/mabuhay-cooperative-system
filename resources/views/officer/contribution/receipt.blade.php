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
          <table id="contribution-tbl" class="table table-striped table-bordered">
          <tbody>
           <tr>
            <td>Name</td>
            <td>{{$contReceipt->user_id}}</td>
          </tr>
          @if($contReceipt->payment == "Monthly Contribution")
            <tr>
              <td>For the Month of</td>
              <td>{{$contReceipt->monthly}}</td>
            </tr>
          @elseif($contReceipt->payment == "Damayan")
            <tr>
              <td>For the Year of</td>
              <td>{{$contReceipt->damayan}}</td>
            </tr>
          @endif
          <tr>
            <td>Amount</td>
            <td>{{$contReceipt->amount}}</td>
          </tr>
          <tr>
            <td>Payment</td>
            <td>{{$contReceipt->payment_type}}</td>
          </tr>
          <tr>
            <td>Reference No.</td>
            <td>{{$contReceipt->receipt_no}}</td>
          </tr>
          <tr>
            <td>Date Paid</td>
            <td>{{$contReceipt->date_paid}}</td>
          </tr>
          <tr>
            <td>Updated By</td>
            <td>{{$contReceipt->updated_by}}</td>
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