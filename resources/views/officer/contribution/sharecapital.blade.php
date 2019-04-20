@extends('layout.panel')

@section('title')
Share Capital
@stop

@section('content')

<div class="flex-center position-ref full-height">
  <div class="custom-breadcrumb">
    {!! Breadcrumbs::render() !!}
  </div>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">

        <h2>Share Capital <small></small></h2>
        <div class="col-md-2 col-sm-2 col-xs-12 form-group pull-right" style="width: 143px;">
          <a href="" id="myBtn" class="btn btn-round btn-info" data-toggle="modal" data-target = "#add-contribution" onclick="addContribution()">Add Contribution</a>
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br/>
        {{ Form::open(array('route' => 'officer.contribution.monthly.year', 'method' => 'post', 'class' => 'form-horizontal form-label-left year-contribution', 'style' => 'width: 15%;float: right;right: 0px;')) }}
        
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
            {{ Form::close() }}

        <div class="monthly-contribution">
          <table id="officer-d-cont" class="table table-striped table-bordered">
            <thead>
            <tr>
              <th>Name</th>
              <th>Amount</th>
                    <th>Date Paid</th>
                    <th>Payment Method</th>
                    <th>Reference No</th>
                    <th>Received By</th>
            </tr>
            </thead>

            <tbody>
            @if ($sharecapital->count() > 1)
              @foreach($sharecapital as $d)
                <tr>
                  <td style="text-transform: capitalize;">{{$d->l_name}}, {{$d->f_name}}</td>
                  <td>{{$d->amount}}</td>
                        <td>{{$d->date}}</td>
                        <td>{{$d->payment_type}}</td>
                        <td>{{$d->receipt_no}}</td>
                        <td>{{$d->updated_by}}</td>
                </tr>
              @endforeach
            @elseif ($sharecapital->count() > 0)
              <tr>
                <td style="text-transform: capitalize;">{{$sharecapital[0]->l_name}}, {{$sharecapital[0]->f_name}}</td>
                <td>{{$sharecapital[0]->amount}}</td>
                        <td>{{$sharecapital[0]->date}}</td>
                        <td>{{$sharecapital[0]->payment_type}}</td>
                        <td>{{$sharecapital[0]->receipt_no}}</td>
                        <td>{{$sharecapital[0]->updated_by}}</td>
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
        {{ Form::model($sharecapital, array('route' => array('officer.contribution.store'), 'method' => 'post', 'class' => 'form-horizontal form-label-left')) }}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
           <!--  <input type="hidden" id="_year" name="_year"> -->
            <input type="hidden" name="payment_id" value="{{ $payment->id }}">
            <input type="hidden" id="_year" name="_year">
        <div class="form-group">
                  <label class="control-label col-md-4 col-sm-4 col-xs-12">Name
                  </label>
                   <div class="col-md-8 col-sm-8 col-xs-12">
                    {!! Form::select('user_id', $users, null, ['class' => 'form-control', 'style' => 'text-transform: Capitalize;']) !!}
                  </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-4 col-sm-4 col-xs-12">Date
                </label>
                 <div class="col-md-8 col-sm-8 col-xs-12" style="height: 34px;">     
                  <div class="input-group date">
                    <input id="myDatepicker" type="text" class="form-control" name="date" />
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
                    <input type="text" name="receipt_no" id="receiptno" class="form-control col-md-10" readonly>
                  </div>
              </div>
               <br/>
               <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-4">
                <button class="btn btn-success">Save</button>
               </div>
               
            </form>
      </div>
    </div>
  </div>
  </div>
</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript">

$(document).ready(function() {
  var year = document.getElementById("year-contribution");
  var yearVal = year.options[year.selectedIndex].value;
  var fName = yearVal +  ' Share Capital Contributions';

    $('#officer-d-cont').DataTable({
      dom: 'B<"clear">lfrtip',
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
            doc.content.splice(0,1);
            //Create a date string that we use in the footer. Format is dd-mm-yyyy
            var now = new Date();
            var jsDate = now.getDate()+'-'+(now.getMonth()+1)+'-'+now.getFullYear();

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
                $(win.document.body).find('h1').text(fName);
                
            }
        },
        
    ]
    });
  });

  function addContribution() {
    $('#_year').val($('#year-contribution').find(":selected").text());
      // $('#myDatepicker').datetimepicker({
      //   minDate: moment().add(1, 'h')
      // });

      $('#date_paid').datetimepicker({
        maxDate: moment().add(1, 'h')
      });

      var currentdate = moment().format('MMDDYYYY-HHmmssSS');
      $('#receiptno').val(currentdate);
  }

  function paymentMethod(val) {
    var method = val.value;
    if(method == 'Cash'){
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