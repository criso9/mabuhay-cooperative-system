@extends('layout.panel')

@section('title')
Admin - Officers
@stop

@section('content')

<div class="flex-center position-ref full-height">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">

        <h2>List of Officers <small></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div>
          <div class="off-active"><h4 style="margin-top: 3px;">Active</h4></div>
          <div style="float: right;"><a href="" class="btn btn-round btn-info" id="myBtn" data-toggle="modal" data-target = "#change-status-modal">Add Officer</a></div>
        </div>
        <div style="clear:both;"></div>
      	<br/>

        <div>
          <table id="officers-active" class="table table-striped table-bordered" style="font-size: 13px;">
            <thead>
            <tr>
              <td>Deactivate</td>
              <td>Position</td>
              <td>Officer Name</td>
              <td>From</td>
              <td>To</td>
              <td>Added by</td>
              <td>Date Added</td>
            </tr>
            </thead>
            <tbody>
              @if ($officers->count() > 1)
                @foreach($officers as $o)
                  <tr>
                    <td align="middle"><a href="" id="statusBtn" data-toggle="modal" data-target = "#change-status-modal" onclick="modalStatus('{{$o->id}}')"><img id="{{$o->id}}" src="/images/user-remove.png" style="width:25px; height: 25px;" onmouseover="onHover({{$o->id}});" onmouseout="offHover({{$o->id}});"/></a>
                    </td>
                    <td>{{$o->position}}</td>
                    <td>{{$o->l_name}}, {{$o->f_name}}</td>
                    <td>{{$o->fromMoYr}}</td>
                    <td>{{$o->toMoYr}}</td>
                    <td>{{$o->add_by}}</td>
                    <td>{{$o->created_at}}</td>
                  </tr>
                @endforeach
              @elseif ($officers->count() > 0)
                <tr>
                  <td align="middle"><a href="" id="statusBtn" data-toggle="modal" data-target = "#change-status-modal" onclick="modalStatus('{{$officers[0]->id}}')"><img id="{{$officers[0]->id}}" src="/images/user-remove.png" style="width:25px; height: 25px;" onmouseover="onHover({{$officers[0]->id}});" onmouseout="offHover({{$officers[0]->id}});"/></a>
                  </td>
                  <td>{{$officers[0]->position}}</td>
                  <td>{{$officers[0]->l_name}}, {{$officers[0]->f_name}}</td>
                  <td>{{$officers[0]->fromMoYr}}</td>
                  <td>{{$officers[0]->toMoYr}}</td>
                  <td>{{$officers[0]->add_by}}</td>
                  <td>{{$officers[0]->created_at}}</td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>

        <br/>
        <div class="off-inactive"><h4 style="padding: 3px;">Inactive</h4></div>
        <br/>
         <!-- {{ Form::model($officers, array('route' => array('admin.officer.range'), 'method' => 'post', 'class' => 'form-horizontal form-label-left year-contribution', 'style' => 'width: 15%;float: right;')) }}
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
         <input type="hidden" name="_t">
         <input type="hidden" name="_f">
        <div style="width:300px;">
          <div class="input-group date">
            <input id="inactive-daterange" type="text" class="form-control" name="inactive-daterange" />
            <span class="input-group-addon">
              <span class="glyphicon glyphicon-calendar"></span>
            </span>
          </div>
        </div>
        </form> -->
        <div>
          <table id="officers-inactive" class="table table-striped table-bordered" style="font-size: 13px;">
            <thead>
            <tr>
              <td>Position</td>
              <td>Officer Name</td>
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
                    <td>{{$i->position}}</td>
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
                  <td>{{$inactive[0]->position}}</td>
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

  <div id="myModal" class="modal custom-modal">
    <div class="modal-content custom-modal-content">
      <div class="modal-header">
        <button type="button" class="close close-add" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="favoritesModalLabel">Add Officer</h4>
      </div>
      <div class="modal-body">
        {{ Form::model($officers, array('route' => array('admin.officer.store'), 'method' => 'post', 'class' => 'form-horizontal form-label-left')) }}
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Name
            </label>
            <div class="col-md-8 col-sm-8 col-xs-12">     
              {!! Form::select('user_id', $users, null, ['class' => 'form-control', 'style' => 'text-transform: Capitalize;']) !!}
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Position
            </label>
            <div class="col-md-8 col-sm-8 col-xs-12">     
              {!! Form::select('position_id', $positions, null, ['class' => 'form-control', 'style' => 'text-transform: Capitalize;']) !!}
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

  <div id="statusModal" class="modal custom-modal">
    <div class="modal-content custom-modal-content">
      <div class="modal-header">
        <button type="button" class="close stat-close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="statusModalLabel">Change Status</h4>
      </div>
      <div class="modal-body">
        {{ Form::model($officers, array('route' => array('admin.officer.update'), 'method' => 'put', 'class' => 'form-horizontal form-label-left')) }}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="officerId" id="officer-id" />
            
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

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function() {
    @if (Session::has('flash_message'))
      Snackbar.show({
        pos: 'top-right', 
        text: '{{ Session::get('flash_message') }}',
      });
    @endif

    $('#officers-active').DataTable({
      // dom: 'B<"clear">lfrtip',
      // buttons: [
      //   'copy', 'csv', 'excel', 'pdf', 'print'
      // ],
      fixedHeader: {
        header: true,
        footer: false
      },
      "order": [[ 2, "asc" ]],
      "columnDefs": [
        { "orderable": false, "targets": 0 }
      ]
    });

    $('#officers-inactive').DataTable({
      // dom: 'B<"clear">lfrtip',
      // buttons: [
      //   'copy', 'csv', 'excel', 'pdf', 'print'
      // ],
      fixedHeader: {
        header: true,
        footer: false
      },
      "order": [[ 1, "asc" ]],
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

  // Get the modal
  var modal = document.getElementById('myModal');
  var statmodal = document.getElementById('statusModal');

  // Get the button that opens the modal
  var btn = document.getElementById("myBtn");
  var statbtn = document.getElementById("statusBtn");

  // Get the <span> element that closes the modal
  var span = document.getElementsByClassName("close")[0];
  var statSpan = document.getElementsByClassName("stat-close")[0];

  // When the user clicks on the button, open the modal 
  btn.onclick = function() {
      modal.style.display = "block";
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
      statmodal.style.display = "block";

      $('#officer-id').val(id);
  }

  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
      modal.style.display = "none";
  }

  statSpan.onclick = function() {
      statmodal.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
      if (event.target == statmodal) {
          statmodal.style.display = "none";
      }
      if (event.target == statmodal) {
          statmodal.style.display = "none";
      }
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