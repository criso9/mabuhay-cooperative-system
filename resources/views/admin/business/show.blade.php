@extends('layout.panel')

@section('title')
Business Information
@stop

@section('content')

<div class="flex-center position-ref full-height">
  <div class="custom-breadcrumb">
    {!! Breadcrumbs::render() !!}
  </div>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>List of Business Income <small></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      <div>
        <div style="float: left;">
          <h4><b>Business:</b> {{$businessName->name}}</h4>
          <h4><b>Description:</b> {{$businessName->description}}</h4>
        </div>
        <div style="float: right;"><a href="" class="btn btn-round btn-info" data-toggle="modal" data-target = "#add-income-modal" onclick="addIncome()">Add Income</a></div>
      </div>
      <div style="clear:both;"></div>
      <br/>
        <div class="monthly-contribution">
          <table id="business-income" class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Amount</th>
              <th>Profit</th>
              <th>Date</th>
              <th>Updated By</th>
            </tr>
          </thead>

          <tbody>
           @if ($business->count() > 1)
              @foreach($business as $b)
                <tr>
                  <td>{{$b->amount}}</td>
                  <td>{{$b->profit}}</td>
                  <td>{{$b->date_paid}}</td>
                  <td>{{$b->updated_by}}</td>
                </tr>
              @endforeach
            @elseif ($business->count() > 0)
              <tr>
                <td>{{$business[0]->amount}}</td>
                <td>{{$business[0]->profit}}</td>
                <td>{{$business[0]->date_paid}}</td>
                <td>{{$business[0]->updated_by}}</td>
              </tr>
            @endif
          </tbody>
        </table>
        </div>

      </div>
    </div>
  </div>

  <div id="add-income-modal" class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content custom-modal-content">
      <div class="modal-header">
        <button type="button" class="close close-add" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="favoritesModalLabel">Add Income</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(array('url' => '/admin/business/'.$businessName->id, 'method' => 'post', 'class' => 'form-horizontal form-label-left')) }}
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group" style="margin-top: 30px;">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Amount <span class="req">*</span>
            </label>
            <div class="col-md-8 col-sm-8 col-xs-12" style="height: 34px;">     
              <div class="input-group" style="width: 100%;">
                <input type="number" name="amount" class="form-control" required/> 
              </div>
            </div>
          </div>
           <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date <span class="req">*</span>
            </label>
            <div class="col-md-5 col-sm-5 col-xs-12" style="height: 34px;">     
              <div class="input-group date">
                <input type="text" class="form-control" id="date_paid" name="date_paid" required />
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
          </div>
          <br/>
           <div class="col-md-5 col-sm-5 col-xs-12 col-md-offset-3">
            <button class="btn btn-success">Save</button>
           </div>
        {{ Form::close() }}
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

    $('#business-income').DataTable({
      dom: 'B<"clear">lfrtip',
      buttons: [
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

                $(win.document.body).find('h1').append(' - ' + '{{$businessName->name}}');
                
            }
        },
        
    ]
    });
  });

  function addIncome() {
      $('#date_paid').datetimepicker({
        format: "MMMM DD, YYYY",
        maxDate: moment().add(1, 'h')
      });
  }
</script>

@stop