@extends('layout.panel')

@section('content')

<div class="flex-center position-ref full-height">
	<div class="custom-breadcrumb">
    {!! Breadcrumbs::render() !!}
  </div>
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Change Password <small></small></h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
			<br/>
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
			{{ Form::open(array('route' => 'member.password.update', 'method' => 'post', 'class' => 'form-horizontal form-label-left')) }}
	          <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Email<span class="req">*</span>
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" placeholder="ex@example.com" name="email" id="email" required class="form-control" value="{{$user->email}}" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Current Password<span class="req">*</span>
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="password" name="current_password" required class="form-control" placeholder="Minimum of 8 characters" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">New Password<span class="req">*</span>
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="password" name="password" required class="form-control" placeholder="Minimum of 8 characters" />
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Confirm New Password<span class="req">*</span>
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="password" name="password_confirmation" placeholder="Re-type new password" required class="form-control"/>
                </div>
            </div>
            <br/>
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2">
              <a href="{{route('member.index')}}" class="btn btn-default">Back</a>
              <button type="submit" class="btn btn-primary">
              Update
            </button>
            </div>
            
	     {{ Form::close() }}
			
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
});

</script>

@stop