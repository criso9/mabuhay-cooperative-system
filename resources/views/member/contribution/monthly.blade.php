@extends('layout.panel')

@section('title')
Monthly Contributions
@stop

@section('content')

<div class="flex-center position-ref full-height">
  <div class="custom-breadcrumb">
    {!! Breadcrumbs::render() !!}
  </div>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>Monthly Contributions <small></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      <br/>

      <!-- <div>
      	{{$contributions}}
      </div> -->
	
        <!-- <form class="form-horizontal form-label-left year-contribution" style="width: 15%;float: right;""> -->
        {{ Form::model($contributions, array('route' => array('member.contribution.monthly.year'), 'method' => 'post', 'class' => 'form-horizontal form-label-left year-contribution', 'style' => 'width: 15%;float: right;')) }}
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" style="font-weight: normal;margin-right: -10px;">Year:</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <select id="year-contribution" name="year" class="form-control" style="height: 30.5px;font-size: 12px;" onchange="this.form.submit()">
                @if (count($years) > 1)
                  @foreach($years as $y)
                    <option value="{{$y}}" {{ $y == $selected_year ? "selected" : "" }}>{{$y}}</option>
                  @endforeach
                @elseif (count($years) > 0)
                  <option value="{{$years[0]}}">{{$years[0]}}</option>
                @endif
              </select>
            </div>
          </div>
          <div class="form-group month-contribution">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" style="font-weight: normal;">Month:</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <select id="month-contribution" name="month" class="form-control" style="height: 30.5px;font-size: 12px;" onchange="this.form.submit()">
              <option>All</option>
              @if (count($months) > 1)
                @foreach($months as $m)
                  <option value="{{$m}}" {{ $m == $selected_month ? "selected" : "" }}>{{$m}}</option>
                @endforeach
              @elseif (count($months) > 0)
                <option value="{{$years[0]}}">{{$months[0]}}</option>
              @endif
              </select>
            </div>
          </div>
        </form>

        <div class="monthly-contribution">
          <table id="member-m-cont" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Month</th>
              <th>Amount</th>
              <th>Date Paid</th>
              <th>Payment Method</th>
              <th>Reference No</th>
            </tr>
          </thead>

          <tbody>
           @if ($contributions->count() > 1)
              @foreach($contributions as $cont)
                <tr>
                  <td>{{$cont->month}}</td>
                  <td>{{$cont->amount}}</td>
                  <td>{{$cont->date_paid}}</td>
                  <td>{{$cont->payment_type}}</td>
                  <td>{{$cont->receipt_no}}</td>
                </tr>
              @endforeach
            @elseif ($contributions->count() > 0)
              <tr>
				<td>{{$contributions[0]->month}}</td>
				<td>{{$contributions[0]->amount}}</td>
				<td>{{$contributions[0]->date_paid}}</td>
				<td>{{$contributions[0]->payment_type}}</td>
				<td>{{$contributions[0]->receipt_no}}</td>
              </tr>
            @endif
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
    $('#member-m-cont').DataTable({
      dom: 'B<"clear">lfrtip',
      buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
      ],
      fixedHeader: {
        header: true,
        footer: false
      },
      "order": [[ 2, "asc" ]]
    });
  });
</script>

@stop