@extends('layout.panel')

@section('title')
Business List
@stop

@section('content')

<div class="flex-center position-ref full-height">
  <div class="custom-breadcrumb">
    {!! Breadcrumbs::render() !!}
  </div>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">

        <h2>List of Business <small></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div>
          <div style="float: right;"><a href="" class="btn btn-round btn-info" data-toggle="modal" data-target = "#add-business-modal" onclick="addBusiness()">Add Business</a></div>
        </div>
        <div style="clear:both;"></div>
      	<br/>
          {{ Form::open(array('route' => 'admin.business.index.filter', 'method' => 'post', 'class' => 'form-horizontal form-label-left pending-type', 'style' => 'width: 22%;float: right; right: -15px;top: 58px;')) }}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" style="font-weight: normal;margin-right: -10px;">Status:</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <select id="status-type" name="statusFilter" class="form-control" style="height: 30.5px;font-size: 12px;" onchange="this.form.submit()">
                    <option value="all" {{ 'all' == $status_filter ? "selected" : "" }}>All</option>
                    @foreach($stat as $s)
                      <option value="{{$s}}" {{ $s == $status_filter ? "selected" : "" }}>{{$s}}</option>
                    @endforeach
                </select>
              </div>
            </div>
          {{ Form::close() }}
        <div>
          <table id="business-list" class="table table-striped table-bordered" style="font-size: 13px;">
            <thead>
            <tr>
              @if($status_filter == 'Active')
                <td class="no-sort">Deactivate</td>
              @endif

              <td>Name</td>
              <td>Description</td>
              <td>Status</td>
              <td>Capital</td>
              <td>Date Started</td>
              <td>Added By</td>

              @if($status_filter != 'Active')
                <td>Date Ended</td>
                <td>Removed By</td>
                <td>Remarks</td>
              @endif
            </tr>
            </thead>
            <tbody>
              @if ($business->count() > 1)
                @foreach($business as $b)
                  <tr>
                    @if($status_filter == 'Active')
                      <td align="middle">
                        <a href="" id="deactivateBtn" data-toggle="modal" data-target = "#deactivateModal" onclick="deactivate('{{$b->id}}')"><img id="{{$b->id}}-deac" src="/images/reject.png" style="width:25px; height: 25px;" onmouseover="deacHover('{{$b->id}}-deac');" onmouseout="deacOffHover('{{$b->id}}-deac');"/></a>
                      </td>
                    @endif
                    <td>{{$b->name}}</td>
                    <td>{{$b->description}}</td>
                    <td>{{$b->status}}</td>
                    <td>{{$b->capital}}</td>
                    <td>{{$b->date_started}}</td>
                    <td>{{$b->added_by}}</td>

                    @if($status_filter != 'Active')
                      <td>{{$b->date_ended}}</td>
                      <td>{{$b->removed_by}}</td>
                      <td>{{$b->remarks}}</td>
                    @endif
                  </tr>
                @endforeach
              @elseif ($business->count() > 0)
                <tr>
                  @if($status_filter == 'Active')
                    <td align="middle">
                      <a href="" id="deactivateBtn" data-toggle="modal" data-target = "#deactivateModal" onclick="deactivate('{{$business[0]->id}}')"><img id="{{$business[0]->id}}-deac" src="/images/reject.png" style="width:25px; height: 25px;" onmouseover="deacHover('{{$business[0]->id}}-deac');" onmouseout="deacOffHover('{{$business[0]->id}}-deac');"/></a>
                    </td>
                  @endif
                  <td>{{$business[0]->name}}</td>
                  <td>{{$business[0]->description}}</td>
                  <td>{{$business[0]->status}}</td>
                  <td>{{$business[0]->capital}}</td>
                  <td>{{$business[0]->date_started}}</td>
                  <td>{{$business[0]->added_by}}</td>

                  @if($status_filter != 'Active')
                    <td>{{$business[0]->date_ended}}</td>
                    <td>{{$business[0]->removed_by}}</td>
                    <td>{{$business[0]->remarks}}</td>
                  @endif
                </tr>
              @endif
            </tbody>
          </table>
        </div>
  	  </div>
    </div>
  </div>

  <div id="add-business-modal" class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content custom-modal-content">
      <div class="modal-header">
        <button type="button" class="close close-add" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="favoritesModalLabel">Add Business</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(array('route' => 'admin.business.store', 'method' => 'post', 'class' => 'form-horizontal form-label-left')) }}
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Name <span class="req">*</span>
            </label>
            <div class="col-md-8 col-sm-8 col-xs-12" style="height: 34px;">     
              <div class="input-group" style="width: 100%;">
                <input type="text" name="name" class="form-control" required/> 
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Description <span class="req">*</span>
            </label>
            <div class="col-md-8 col-sm-8 col-xs-12" style="height: 34px;">     
              <div class="input-group" style="width: 100%;">
                <textarea name="description" class="form-control" required></textarea>
              </div>
            </div>
          </div>
          <div class="form-group" style="margin-top: 30px;">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Capital <span class="req">*</span>
            </label>
            <div class="col-md-8 col-sm-8 col-xs-12" style="height: 34px;">     
              <div class="input-group" style="width: 100%;">
                <input type="number" name="capital" class="form-control" required/> 
              </div>
            </div>
          </div>
           <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date Started <span class="req">*</span>
            </label>
            <div class="col-md-5 col-sm-5 col-xs-12" style="height: 34px;">     
              <div class="input-group date">
                <input type="text" class="form-control" id="date_started" name="date_started" required />
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

<div id="deactivateModal" class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content custom-modal-content">
    <div class="modal-header">
      <button type="button" id="reject-close" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <h4 class="modal-title" id="statusModalLabel">Deactivate Business</h4>
    </div>
    <div class="modal-body">
      {{ Form::open(array('route' => array('admin.business.update'), 'method' => 'put', 'id' => 'reg-approval-form', 'class' => 'form-horizontal form-label-left')) }}
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="_id" id="_id">

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Remarks <span class="req">*</span>
            </label>
            <div class="col-md-9 col-sm-9 col-xs-12">     
              <textarea name="remarks" placeholder="Enter text here" style="width: 100%;" required></textarea>
            </div>
          </div>
         <br/>
         <div style="float: right;">
            <button type="submit" class="btn btn-primary">Proceed</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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

    @if ($status_filter == 'Active')
      $('#business-list').DataTable({
        fixedHeader: {
          header: true,
          footer: false
        },
        "order": [[ 5, "desc" ]],
        "columnDefs": [
          { "orderable": false, "targets": "no-sort" }
        ]
      });
    @else
      $('#business-list').DataTable({
        fixedHeader: {
          header: true,
          footer: false
        },
        "order": [[ 4, "desc" ]]
      });
    @endif


  });


  function addBusiness() {
      $('#date_started').datetimepicker({
        format: "MMMM DD, YYYY",
        maxDate: moment().add(1, 'h')
      });
  }

  function deacHover(idVals)
  {
      $("#" + idVals).attr('src', '/images/reject-hover.png');
  }

  function deacOffHover(idVals)
  {
      $("#" + idVals).attr('src', '/images/reject.png');
  }

  function deactivate(id) {
    $('#_id').val(id);
  }
  

</script>

@stop