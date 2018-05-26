@extends('layout.panel')

@section('title')
Edit Announcement
@stop

@section('content')

<div class="flex-center position-ref full-height">
  <div class="custom-breadcrumb">
    {!! Breadcrumbs::render() !!}
  </div>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">

        <h2>Edit Announcement <small></small></h2>
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
      	<br/>
        <div>
          {{ Form::open(array('url' => '/officer/announcements/edit/'.$announcement->id, 'method' => 'post', 'class' => 'form-horizontal form-label-left')) }}
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="_id" value="{{ $announcement->id }}">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Event Date <span class="req">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-10" style="height: 34px;">     
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
            <div class="col-md-6 col-sm-6 col-xs-10" style="height: 34px;">     
              <div class="input-group" style="width: 100%;">
                <textarea name="details" class="form-control" required>{{$announcement->details}}</textarea>
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

<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script type="text/javascript">
  $(document).ready(function() {
    @if (Session::has('flash_message'))
      Snackbar.show({
        pos: 'top-right', 
        text: '{{ Session::get('flash_message') }}',
      });
    @endif

    $('#event_date').datetimepicker({
      format: "MMMM DD, YYYY",
      date: "{{$announcement->event_date}}"
    });

  });

</script>

@stop