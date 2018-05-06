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
        <div class="col-md-2 col-sm-2 col-xs-12 form-group pull-right" style="width: 143px;">
          <a href="" id="myBtn" class="btn btn-round btn-info" data-toggle="modal" data-target = "#add-contribution" onclick="addContribution()">Add Contribution</a>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      <br/>

        <!-- <form class="form-horizontal form-label-left year-contribution" style="width: 15%;float: right;" action="{{route('officer.contribution.monthly.year')}}" method="POST"> -->
        {{ Form::model($contributions, array('route' => array('officer.contribution.monthly.year'), 'method' => 'post', 'class' => 'form-horizontal form-label-left year-contribution', 'style' => 'width: 15%;float: right;')) }}
        
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="_payment" value="{{ $payment->id }}">
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
          <table id="officer-m-cont" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Action</th>
              <th>Name</th>
              @if ($selected_month != "All" && $selected_month != "")
                <th>{{$selected_month}}</th>
              @else
                @if (count($months) > 1)
                  @foreach($months as $p)
                    <th>{{$p}}</th>
                  @endforeach
                @elseif (count($months) > 0)
                  <th>{{$months[0]}}</th>
                @endif
              @endif
            </tr>
          </thead>

          <tbody>
            @if ($contributions->count() > 1)
              @foreach($contributions as $cont)
                <tr>
                  <td align="center">
                    @if($selected_year && $selected_month)
                      <a href="{{url('/officer/contribution/month/'.$cont->id.'?y='.$selected_year.'&m='.$selected_month)}}" class="btn btn-xs btn-success">
                        <i class="fa fa-info-circle"></i> View
                      </a>
                    @else
                      <a href="{{url('/officer/contribution/month/'.$cont->id)}}" class="btn btn-xs btn-success">
                        <i class="fa fa-info-circle"></i> View
                      </a>
                    @endif
                  </td>
                  <td style="text-transform: capitalize;">{{$cont->l_name}}, {{$cont->f_name}}</td>
                  @if ($selected_month != "All" && $selected_month != "")
                    <td>
                      {{$cont->$selected_month}}
                    </td>
                  @else
                    @if (count($months) > 1)
                      @foreach($months as $p)
                        <?php
                          if($p == 'January'){echo '<td>'.$cont->January.'</td>';}
                          elseif($p == 'February'){echo '<td>'.$cont->February.'</td>';}
                          elseif($p == 'March'){echo '<td>'.$cont->March.'</td>';}
                          elseif($p == 'April'){echo '<td>'.$cont->April.'</td>';}
                          elseif($p == 'May'){echo '<td>'.$cont->May.'</td>';}
                          elseif($p == 'June'){echo '<td>'.$cont->June.'</td>';}
                          elseif($p == 'July'){echo '<td>'.$cont->July.'</td>';}
                          elseif($p == 'August'){echo '<td>'.$cont->August.'</td>';}
                          elseif($p == 'September'){echo '<td>'.$cont->September.'</td>';}
                          elseif($p == 'October'){echo '<td>'.$cont->October.'</td>';}
                          elseif($p == 'November'){echo '<td>'.$cont->November.'</td>';}
                          elseif($p == 'December'){echo '<td>'.$cont->December.'</td>';}
                        ?>
                      @endforeach
                    @elseif (count($months) > 0)
                      <?php
                          if($months[0] == 'January'){echo '<td>'.$cont->January.'</td>';}
                          elseif($months[0] == 'February'){echo '<td>'.$cont->February.'</td>';}
                          elseif($months[0] == 'March'){echo '<td>'.$cont->March.'</td>';}
                          elseif($months[0] == 'April'){echo '<td>'.$cont->April.'</td>';}
                          elseif($months[0] == 'May'){echo '<td>'.$cont->May.'</td>';}
                          elseif($months[0] == 'June'){echo '<td>'.$cont->June.'</td>';}
                          elseif($months[0] == 'July'){echo '<td>'.$cont->July.'</td>';}
                          elseif($months[0] == 'August'){echo '<td>'.$cont->August.'</td>';}
                          elseif($months[0] == 'September'){echo '<td>'.$cont->September.'</td>';}
                          elseif($months[0] == 'October'){echo '<td>'.$cont->October.'</td>';}
                          elseif($months[0] == 'November'){echo '<td>'.$cont->November.'</td>';}
                          elseif($months[0] == 'December'){echo '<td>'.$cont->December.'</td>';}
                        ?>
                    @endif
                  @endif
                </tr>
              @endforeach
            @elseif ($contributions->count() > 0)
              <tr>
                <td align="center">
                  @if($selected_year && $selected_month)
                    <a href="{{url('/officer/contribution/month/'.$contributions[0]->id.'?y='.$selected_year.'&m='.$selected_month)}}" class="btn btn-xs btn-success">
                      <i class="fa fa-info-circle"></i> View
                    </a>
                  @else
                    <a href="{{url('/officer/contribution/month/'.$contributions[0]->id)}}" class="btn btn-xs btn-success">
                      <i class="fa fa-info-circle"></i> View
                    </a>
                  @endif
                </td>
                <td style="text-transform: capitalize;">{{$contributions[0]->l_name}}, {{$contributions[0]->f_name}}</td>
                @if ($selected_month != "All" && $selected_month != "")
                    <td>
                      {{$contributions[0]->$selected_month}}
                    </td>
                  @else
                    @if (count($months) > 1)
                      @foreach($months as $p)
                        <?php
                          if($p == 'January'){echo '<td>'.$contributions[0]->January.'</td>';}
                          elseif($p == 'February'){echo '<td>'.$contributions[0]->February.'</td>';}
                          elseif($p == 'March'){echo '<td>'.$contributions[0]->March.'</td>';}
                          elseif($p == 'April'){echo '<td>'.$contributions[0]->April.'</td>';}
                          elseif($p == 'May'){echo '<td>'.$contributions[0]->May.'</td>';}
                          elseif($p == 'June'){echo '<td>'.$contributions[0]->June.'</td>';}
                          elseif($p == 'July'){echo '<td>'.$contributions[0]->July.'</td>';}
                          elseif($p == 'August'){echo '<td>'.$contributions[0]->August.'</td>';}
                          elseif($p == 'September'){echo '<td>'.$contributions[0]->September.'</td>';}
                          elseif($p == 'October'){echo '<td>'.$contributions[0]->October.'</td>';}
                          elseif($p == 'November'){echo '<td>'.$contributions[0]->November.'</td>';}
                          elseif($p == 'December'){echo '<td>'.$contributions[0]->December.'</td>';}
                        ?>
                      @endforeach
                    @elseif (count($months) > 0)
                      <?php
                          if($months[0] == 'January'){echo '<td>'.$contributions[0]->January.'</td>';}
                          elseif($months[0] == 'February'){echo '<td>'.$contributions[0]->February.'</td>';}
                          elseif($months[0] == 'March'){echo '<td>'.$contributions[0]->March.'</td>';}
                          elseif($months[0] == 'April'){echo '<td>'.$contributions[0]->April.'</td>';}
                          elseif($months[0] == 'May'){echo '<td>'.$contributions[0]->May.'</td>';}
                          elseif($months[0] == 'June'){echo '<td>'.$contributions[0]->June.'</td>';}
                          elseif($months[0] == 'July'){echo '<td>'.$contributions[0]->July.'</td>';}
                          elseif($months[0] == 'August'){echo '<td>'.$contributions[0]->August.'</td>';}
                          elseif($months[0] == 'September'){echo '<td>'.$contributions[0]->September.'</td>';}
                          elseif($months[0] == 'October'){echo '<td>'.$contributions[0]->October.'</td>';}
                          elseif($months[0] == 'November'){echo '<td>'.$contributions[0]->November.'</td>';}
                          elseif($months[0] == 'December'){echo '<td>'.$contributions[0]->December.'</td>';}
                        ?>
                    @endif
                  @endif
              </tr>
            @endif
          </tbody>
        </table>
        </div>

      </div>

    </div>
  </div>

  <div id="add-contribution" class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
		<div class="modal-content custom-modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="favoritesModalLabel">Add contribution</h4>
			</div>
			<div class="modal-body">
				{{ Form::model($contributions, array('route' => array('officer.contribution.store'), 'method' => 'post', 'class' => 'form-horizontal form-label-left')) }}
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="_year" name="_year">
        <input type="hidden" id="_month" name="_month">
        <input type="hidden" name="payment_id" value="{{ $payment->id }}">
				<div class="form-group">
	                <label class="control-label col-md-4 col-sm-4 col-xs-12">Name
	                </label>
	                 <div class="col-md-8 col-sm-8 col-xs-12">
	                  {!! Form::select('user_id', $users, null, ['class' => 'form-control', 'style' => 'text-transform: Capitalize;']) !!}
	                </div>
	            </div>
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">For the Month of
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12" style="height: 34px;">     
                  <div class="input-group date">
                    <input id="myDatepicker" type="text" class="form-control" name="date" required />
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
	                  <input type="number" name="amount" id="amount" class="form-control col-md-10" required>
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
                    <input type="text" name="receipt_no" id="receiptno" class="form-control col-md-10" readonly required>
                  </div>
              </div>
               <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Date Paid
                </label>
                <div class="col-md-8 col-sm-8 col-xs-12" style="height: 34px;">     
                  <div class="input-group date">
                    <input id="date_paid" type="text" class="form-control" name="date_paid" required />
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                  </div>
                </div>
              </div>
	             <br/>
	             <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-4">
	             	<button class="btn btn-success">Save</button>
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
    var year = document.getElementById("year-contribution");
    var month = document.getElementById("month-contribution");
    
    var yearVal = year.options[year.selectedIndex].value;
    var monthVal = month.options[month.selectedIndex].value;
    var fName = "";

    //prepend Month and Year on the fileName
    if(monthVal == 'All'){
      fName = yearVal + ' Monthly Contributions';
    } else {
      fName = yearVal +  ' ' + monthVal + ' Contributions';
    }

    @if (Session::has('flash_message'))
      Snackbar.show({
        pos: 'top-right', 
        text: '{{ Session::get('flash_message') }}',
      });
    @endif

    $('#officer-m-cont').DataTable({
      dom: 'B<"clear">lfrtip',
      // buttons: [
      //   'copy', 'csv', 'excel', 'pdf', 'print'
      // ],
      buttons: [
        'copy',
        {
            extend: 'csv',
            filename: fName,
        },
        {
            extend: 'excel',
            filename: fName,
        },
        {
            extend: 'pdfHtml5',
            orientation: 'landscape',
            filename: fName,
            customize: function(doc)
            {
              var img = new Image();
              img.src = '{{url('/uploads/')}}/{{ $coop->logo }}';
              // var logo = getBase64FromImageUrl(imgCoop);

              // var img = document.getElementById("coop-logo");

            //Remove the title created by datatTables
            doc.content.splice(0,1);
            //Create a date string that we use in the footer. Format is dd-mm-yyyy
            var now = new Date();
            var jsDate = now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear();

            // var logo = encodedBase;

            // var logo = "";

            // var logo = 'data:image/jpeg;base64,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ICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICA=';
           
            // It's important to create enough space at the top for a header !!!
            doc.pageMargins = [20,60,20,30];
            // Set the font size fot the entire document
            doc.defaultStyle.fontSize = 7;
            // Set the fontsize for the table header
            doc.styles.tableHeader.fontSize = 7;
            // Create a header object with 3 columns
            // Left side: Logo
            // Middle: brandname
            // Right side: A document title
            doc['header']=(function() {
              return {
                columns: [
                  // {
                  //   image: logo,
                  //   width: 24
                  // },
                  {
                    alignment: 'left',
                    italics: true,
                    text: '{{ $coop->coop_name }}',
                    fontSize: 18,
                    margin: [10,0]
                  },
                  {
                    alignment: 'right',
                    fontSize: 14,
                    text: fName
                  }
                ],
                margin: 20
              }
            });
            // Create a footer object with 2 columns
            // Left side: report creation date
            // Right side: current page and total pages
            doc['footer']=(function(page, pages) {
              return {
                columns: [
                  {
                    alignment: 'left',
                    text: ['Created on: ', { text: jsDate.toString() }]
                  },
                  {
                    alignment: 'right',
                    text: ['page ', { text: page.toString() },  ' of ', { text: pages.toString() }]
                  }
                ],
                margin: 20
              }
            });
            // Change dataTable layout (Table styling)
            // To use predefined layouts uncomment the line below and comment the custom lines below
            // doc.content[0].layout = 'lightHorizontalLines'; // noBorders , headerLineOnly
            var objLayout = {};
            objLayout['hLineWidth'] = function(i) { return .5; };
            objLayout['vLineWidth'] = function(i) { return .5; };
            objLayout['hLineColor'] = function(i) { return '#aaa'; };
            objLayout['vLineColor'] = function(i) { return '#aaa'; };
            objLayout['paddingLeft'] = function(i) { return 4; };
            objLayout['paddingRight'] = function(i) { return 4; };
            doc.content[0].layout = objLayout;
          }
        },
        {
            extend: 'print',
            customize: function(win)
            {
 
                var last = null;
                var current = null;
                var bod = [];
 
                var css = '@page { size: landscape; }',
                    head = win.document.head || win.document.getElementsByTagName('head')[0],
                    style = win.document.createElement('style');
 
                style.type = 'text/css';
                style.media = 'print';
 
                if (style.styleSheet)
                {
                  style.styleSheet.cssText = css;
                }
                else
                {
                  style.appendChild(win.document.createTextNode(css));
                }
 
                head.appendChild(style);

                $(win.document.body)
                  .prepend(
                      '<div style="text-align: center;font-size: 22px;color: black;margin-top: 10px;margin-bottom: 20px;height: 95px;line-height: 95px;"><div style="display: inline-block;vertical-align: middle;"><div style="display: inline; margin-right: 20px;"><img src="{{url('/uploads/')}}/{{ $coop->logo }}" style="width:100px;" /></div><h2 style="display: inherit;font-size:30px;">{{ $coop->coop_name }}</h2></div></div>'
                  );

                $(win.document.body).find('h1').addClass('display').css('font-size', '20px');
                $(win.document.body).find( 'table' )
                        .addClass( 'print-table' );

                //prepend Month and Year on the Title
                if(monthVal == 'All'){
                  $(win.document.body).find('h1').prepend(yearVal + ' ');
                } else {
                  $(win.document.body).find('h1').text(monthVal + ' ' + yearVal + ' Contributions');
                }
                
            }
        },
        
    ],
      fixedHeader: {
        header: true,
        footer: false
      },
      "order": [[ 1, "asc" ]],
      "columnDefs": [
        { "orderable": false, "targets": 0 }
      ]
    });
  });

	function addContribution() {
      $('#_year').val($('#year-contribution').find(":selected").text());
      $('#_month').val($('#month-contribution').find(":selected").text());
      $('#myDatepicker').datetimepicker({
        format: "MMMM YYYY",
        viewMode: "months",
        minDate: moment().add(1, 'h')
      });

      $('#date_paid').datetimepicker();

      var currentdate = moment().format('MMDDYYYY-HHmmssSS');
      $('#receiptno').val(currentdate);
	}

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

// var test = document.getElementById("test");

// test.onclick = function() {
//   $.ajax({
//     url: '/officer/contribution/month/info',
//     type: "post",
//     data: {id:data},
//     success: function(response){ // What to do if we succeed
//       if(data == "success")
//         alert(response); 
//       },
//     error: function(response){
//       alert('Error ' + response);
//     }
//   });
// }

  </script>

@stop