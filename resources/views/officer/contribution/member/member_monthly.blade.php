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
        <h2>List of Monthly Contributions <small></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      <h4><b>Name:</b> {{$member->f_name}} {{$member->l_name}}</h4>
      <br/>
        {{ Form::open(array('url' => '/officer/contribution/month/'.$id, 'method' => 'post', 'class' => 'form-horizontal form-label-left year-contribution-mem', 'style' => 'width: 15%;float: right;')) }}
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="_id" value="{{$id}}">
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
        {{ Form::close() }}

        <div class="monthly-contribution">
          <table id="member-m-cont" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Month</th>
              <th>Amount</th>
              <th>Date Paid</th>
              <th>Payment Method</th>
              <th>Reference No</th>
              <th>Received By</th>
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
                  <td>{{$cont->updated_by}}</td>
                </tr>
              @endforeach
            @elseif ($contributions->count() > 0)
              <tr>
                <td>{{$contributions[0]->month}}</td>
                <td>{{$contributions[0]->amount}}</td>
                <td>{{$contributions[0]->date_paid}}</td>
                <td>{{$contributions[0]->payment_type}}</td>
                <td>{{$contributions[0]->receipt_no}}</td>
                <td>{{$contributions[0]->updated_by}}</td>
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
    @if (Session::has('flash_message'))
      Snackbar.show({
        pos: 'top-right', 
        text: '{{ Session::get('flash_message') }}',
      });
    @endif

    var year = document.getElementById("year-contribution");
    var month = document.getElementById("month-contribution");
    
    var yearVal = year.options[year.selectedIndex].value;
    var monthVal = month.options[month.selectedIndex].value;
    var fName = "";

    //prepend Month and Year on the fileName
    if(monthVal == 'All'){
      fName = yearVal + ' Monthly Contributions - ' + '{{$member->f_name}}' + ' ' + '{{$member->l_name}}';
    } else {
      fName = yearVal +  ' ' + monthVal + ' Contributions - ' + '{{$member->f_name}}' + ' ' + '{{$member->l_name}}';
    }

    $('#member-m-cont').DataTable({
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
              
            //Remove the title created by datatTables
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

                $(win.document.body).find('h1').append(' - ' + '{{$member->f_name}} {{$member->l_name}}');
                
            }
        },
        
    ],
      fixedHeader: {
        header: true,
        footer: false
      }
    });
  });
</script>

@stop