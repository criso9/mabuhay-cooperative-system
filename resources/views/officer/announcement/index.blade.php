@extends('layout.panel')

@section('title')
Announcements List
@stop

@section('content')

<div class="flex-center position-ref full-height">
  <div class="custom-breadcrumb">
    {!! Breadcrumbs::render() !!}
  </div>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">

        <h2>List of Announcements <small></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div>
            @if (count($errors) > 0)
            <div class="alert alert-danger">
              <strong>Whoops!</strong> There were some problems with your input.<br><br>
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif
            </div>
        <div>
          <div style="float: right;"><a href="" class="btn btn-round btn-info" data-toggle="modal" data-target = "#add-announcement-modal" onclick="addAnnouncement()">Add Announcement</a></div>
        </div>
        <div style="clear:both;"></div>
      	<br/>
        <div>
          <table id="announcement-list" class="table table-striped table-bordered" style="font-size: 13px;">
            <thead>
            <tr>
              <td>Event Date</td>
              <td>Details</td>
              <td>Added By</td>
              <td>Added At</td>
              <td>Updated By</td>
              <td>Updated At</td>
              <td>Action</td>
            </tr>
            </thead>
            <tbody>
              @if ($announcement->count() > 1)
                @foreach($announcement as $a)
                  <tr>
                    <td>{{$a->event_date}}</td>
                    <td>{{$a->details}}</td>
                    <td>{{$a->created_by}}</td>
                    <td>{{$a->created_at}}</td>
                    <td>{{$a->updated_by}}</td>
                    <td>{{$a->updated_at}}</td>
                    <td align="center">
                      <a href="{{route('officer.email.announcement.reminder', $a->id)}}" class="btn btn-xs btn-primary"><i class="fa fa-send"></i> Send</a>
                      <a href="{{route('officer.announcements.edit', $a->id)}}" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a>
                      <a href="" data-toggle="modal" data-target = "#delete-announcement-modal" onclick="deleteAnnouncement('{{$a->id}}')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                    </td>
                  </tr>
                @endforeach
              @elseif ($announcement->count() > 0)
                <tr>
                  <td>{{$announcement[0]->event_date}}</td>
                    <td>{{$announcement[0]->details}}</td>
                    <td>{{$announcement[0]->created_by}}</td>
                    <td>{{$announcement[0]->created_at}}</td>
                    <td>{{$announcement[0]->updated_by}}</td>
                    <td>{{$announcement[0]->updated_at}}</td>
                    <td align="center">
                      <a href="{{route('officer.email.announcement.reminder', $announcement[0]->id)}}" class="btn btn-xs btn-primary"><i class="fa fa-send"></i> Send</a>
                      <a href="{{route('officer.announcements.edit', $announcement[0]->id)}}" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a>
                      <a href="" data-toggle="modal" data-target = "#delete-announcement-modal" onclick="deleteAnnouncement('{{$announcement[0]->id}}')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Delete</a>
                    </td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>
  	  </div>
    </div>
  </div>

<div id="add-announcement-modal" class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content custom-modal-content">
      <div class="modal-header">
        <button type="button" class="close close-add" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="favoritesModalLabel">Add Announcement</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(array('route' => 'officer.announcements.store', 'files' => true, 'method' => 'post', 'class' => 'form-horizontal form-label-left')) }}
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Event Date <span class="req">*</span>
            </label>
            <div class="col-md-8 col-sm-8 col-xs-12" style="height: 34px;">     
              <div class="input-group date">
                <input id="event_date" type="text" class="form-control" name="event_date" required />
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Details <span class="req">*</span>
            </label>
            <div class="col-md-8 col-sm-8 col-xs-12" style="height: 34px;">     
              <div class="input-group" style="width: 100%;">
                <textarea name="details" class="form-control" required></textarea>
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

<div id="delete-announcement-modal" class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content custom-modal-content">
      <div class="modal-header">
        <button type="button" class="close close-add" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="favoritesModalLabel">Delete Announcement</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(array('route' => 'officer.announcements.delete', 'method' => 'post', 'class' => 'form-horizontal form-label-left')) }}
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="_id" id="_id">
          <div class="form-group">
            <p>Are you sure you want to delete it?</p>
          </div>
          <br/>
           <div style="float: right;">
            <button class="btn btn-primary">Yes</button>
            <button class="btn btn-default" data-dismiss="modal">No</button>
           </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>
  </div>

</div>

<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function() {
    @if (Session::has('flash_message'))
      Snackbar.show({
        pos: 'top-right', 
        text: '{{ Session::get('flash_message') }}',
      });
    @endif

    $('#announcement-list').DataTable({
      "order": [[ 5, "desc" ]],
      "columnDefs": [
        { "orderable": false, "targets": 6 }
      ]
    });


  });

  function addAnnouncement() {
      $('#event_date').datetimepicker({
        format: "MMMM DD, YYYY"
      });
  }

  function deleteAnnouncement(id) {
      $('#_id').val(id);
  }

</script>

@stop