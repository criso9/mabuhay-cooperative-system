@extends('layout.panel')

@section('title')
Admin List
@stop

@section('content')

<div class="flex-center position-ref full-height">
  <div class="custom-breadcrumb">
    {!! Breadcrumbs::render() !!}
  </div>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">

        <h2>List of Admins <small></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div>
          <div class="off-active"><h4 style="margin-top: 3px;">Active</h4></div>
          <div style="float: right;"><a href="" class="btn btn-round btn-info" id="myBtn" data-toggle="modal" data-target = "#add-admin" onclick="addAdmin()">Add Admin</a></div>
        </div>
        <div style="clear:both;"></div>
      	<br/>

        <div>
          <table id="admins-active" class="table table-striped table-bordered" style="font-size: 13px;">
            <thead>
            <tr>
              <td>Deactivate</td>
              <td>Admin Name</td>
              <td>From</td>
              <td>To</td>
              <td>Added by</td>
              <td>Date Added</td>
            </tr>
            </thead>
            <tbody>
              @if ($admins->count() > 1)
                @foreach($admins as $o)
                  <tr>
                    @if($o->user_id == Auth::user()->id)
                      <td align="middle"><img id="{{$o->id}}" src="/images/user-remove.png" style="width:25px; height: 25px;cursor: not-allowed;" onmouseover="onHover({{$o->id}});" onmouseout="offHover({{$o->id}});"/>
                      </td>
                    @else
                      <td align="middle"><a href="" id="statusBtn" data-toggle="modal" data-target = "#statusModal" onclick="modalStatus('{{$o->id}}')"><img id="{{$o->id}}" src="/images/user-remove.png" style="width:25px; height: 25px;" onmouseover="onHover({{$o->id}});" onmouseout="offHover({{$o->id}});"/></a>
                      </td>
                    @endif
                    <td>{{$o->l_name}}, {{$o->f_name}}</td>
                    <td>{{$o->fromMoYr}}</td>
                    <td>{{$o->toMoYr}}</td>
                    <td>{{$o->add_by}}</td>
                    <td>{{$o->created_at}}</td>
                  </tr>
                @endforeach
              @elseif ($admins->count() > 0)
                <tr>
                  @if($admins[0]->user_id == Auth::user()->id)
                    <td align="middle"><img id="{{$admins[0]->id}}" src="/images/user-remove.png" style="width:25px; height: 25px;cursor: not-allowed;" onmouseover="onHover({{$admins[0]->id}});" onmouseout="offHover({{$admins[0]->id}});"/>
                  @else
                    <td align="middle"><a href="" id="statusBtn" data-toggle="modal" data-target = "#statusModal" onclick="modalStatus('{{$admins[0]->id}}')"><img id="{{$admins[0]->id}}" src="/images/user-remove.png" style="width:25px; height: 25px;" onmouseover="onHover({{$admins[0]->id}});" onmouseout="offHover({{$admins[0]->id}});"/></a>
                  @endif
                  </td>
                  <td>{{$admins[0]->l_name}}, {{$admins[0]->f_name}}</td>
                  <td>{{$admins[0]->fromMoYr}}</td>
                  <td>{{$admins[0]->toMoYr}}</td>
                  <td>{{$admins[0]->add_by}}</td>
                  <td>{{$admins[0]->created_at}}</td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>

        <br/>
        <div class="off-inactive"><h4 style="padding: 3px;">Inactive</h4></div>
        <br/>
      
        <div>
          <table id="admins-inactive" class="table table-striped table-bordered" style="font-size: 13px;">
            <thead>
            <tr>
              <td>Admin Name</td>
              <td>From</td>
              <td>To</td>
              <td>Removed by</td>
              <td>Date Removed</td>
              <td>Remarks</td>
            </tr>
            </thead>
            <tbody>
              @if ($inactive->count() > 1)
                @foreach($inactive as $i)
                  <tr>
                    <td>{{$i->l_name}}, {{$i->f_name}}</td>
                    <td>{{$i->fromMoYr}}</td>
                    <td>{{$i->toMoYr}}</td>
                    <td>{{$i->rem_by}}</td>
                    <td>{{$i->updated_at}}</td>
                    <td>{{$i->remarks}}</td>
                  </tr>
                @endforeach
              @elseif ($inactive->count() > 0)
                <tr>
                  <td>{{$inactive[0]->l_name}}, {{$inactive[0]->f_name}}</td>
                  <td>{{$inactive[0]->fromMoYr}}</td>
                  <td>{{$inactive[0]->toMoYr}}</td>
                  <td>{{$inactive[0]->rem_by}}</td>
                  <td>{{$inactive[0]->updated_at}}</td>
                  <td>{{$inactive[0]->remarks}}</td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>
  	  </div>
    </div>
  </div>

  <div id="add-admin" class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content custom-modal-content">
      <div class="modal-header">
        <button type="button" class="close close-add" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="favoritesModalLabel">Add Admin</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(array('route' => 'admin.admin.store', 'method' => 'post', 'class' => 'form-horizontal form-label-left')) }}
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Name
            </label>
            <div class="col-md-8 col-sm-8 col-xs-12">     
              {!! Form::select('user_id', $users, null, ['class' => 'form-control', 'style' => 'text-transform: Capitalize;']) !!}
            </div>
          </div>
           <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">From
            </label>
            <div class="col-md-8 col-sm-8 col-xs-12" style="height: 34px;">     
              <div class="input-group date">
                <input id="from-year" type="text" class="form-control" name="from" required />
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">To
            </label>
            <div class="col-md-8 col-sm-8 col-xs-12" style="height: 34px;">     
              <div class="input-group date">
                <input id="to-year" type="text" class="form-control" name="to" required />
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
          </div>
          <br/>
           <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-3">
            <button class="btn btn-success">Save</button>
           </div>
        </form>
      </div>
    </div>
  </div>
  </div>

  <div id="statusModal" class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content custom-modal-content">
      <div class="modal-header">
        <button type="button" class="close stat-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="statusModalLabel">Change Status</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(array('route' => 'admin.admin.update', 'method' => 'put', 'class' => 'form-horizontal form-label-left')) }}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="adminId" id="admin-id" />
            
            <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Remarks
            </label>
            <div class="col-md-9 col-sm-9 col-xs-12">     
              <textarea name="remarks" placeholder="Enter text here" style="width: 100%;" required></textarea>
            </div>
          </div>
           <br/>
           <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
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
    @if (Session::has('flash_message'))
      Snackbar.show({
        pos: 'top-right', 
        text: '{{ Session::get('flash_message') }}',
      });
    @endif

    $('#admins-active').DataTable({
      // dom: 'B<"clear">lfrtip',
      // buttons: [
      //   'copy', 'csv', 'excel', 'pdf', 'print'
      // ],
      fixedHeader: {
        header: true,
        footer: false
      },
      "order": [[ 1, "asc" ]],
      "columnDefs": [
        { "orderable": false, "targets": 0 }
      ]
    });

    $('#admins-inactive').DataTable({
      // dom: 'B<"clear">lfrtip',
      // buttons: [
      //   'copy', 'csv', 'excel', 'pdf', 'print'
      // ],
      fixedHeader: {
        header: true,
        footer: false
      },
      "order": [[ 0, "asc" ]],
    });

    // $('#inactive-daterange').daterangepicker(
    // {
    //     autoUpdateInput: false,
    //     locale: {
    //       format: 'YYYY-MM-DD',
    //       cancelLabel: 'Clear'
    //     }
    // }, function(start, end, label) {
    //   console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
    // });

    // $('#inactive-daterange').on('apply.daterangepicker', function(ev, picker) {
    //   $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    // });

    // $('#inactive-daterange').on('cancel.daterangepicker', function(ev, picker) {
    //     $(this).val('');
    // });
  });

  
  // When the user clicks on the button, open the modal 
  function addAdmin() {
      $('#from-year').datetimepicker({
        format: "MMMM YYYY",
        viewMode: "months",
        maxDate: moment().add(1, 'h')
      });
      $('#to-year').datetimepicker({
        format: "MMMM YYYY",
        viewMode: "months",
      });
  }

  function modalStatus(id) {
      $('#admin-id').val(id);
  }

  function onHover(idVal)
  {
      $("#" + idVal).attr('src', '/images/user-remove-red.png');
  }

  function offHover(idVal)
  {
      $("#" + idVal).attr('src', '/images/user-remove.png');
  }

  

</script>

@stop