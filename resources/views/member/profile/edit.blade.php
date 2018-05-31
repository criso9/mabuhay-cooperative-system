@extends('layout.panel')

@section('content')

<div class="flex-center position-ref full-height">
	<div class="custom-breadcrumb">
    {!! Breadcrumbs::render() !!}
  </div>
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Edit Profile <small></small></h2>
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
			{{ Form::open(array('route' => 'member.profile.update', 'method' => 'post', 'class' => 'form-horizontal form-label-left', 'files' => true, 'enctype' => 'multipart/form-data')) }}
	          <input type="hidden" name="_token" value="{{ csrf_token() }}">
             <div class="form-group">
              <label class="control-label col-md-2 col-sm-2 col-xs-12">Profile
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="hidden" name="avatar_img" value="{{ $user->avatar }}"/>
                  <input type="hidden" name="avatar_req" id="avatar_req"/>
                  <img src="{{ '/uploads/profile/'.$user->avatar }}"  style="width:120px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd;">
                  <input type="file" name="avatar" id="avatar" style="margin-top: 10px;" onchange="check(this.value)">
                </div>
          </div>
            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">First Name<span class="req">*</span>
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="f_name" id="f_name" class="form-control col-md-10" required value="{{$user->f_name}}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Middle Name
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="m_name" id="m_name" class="form-control col-md-10" value="{{$user->m_name}}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Last Name<span class="req">*</span>
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="l_name" id="l_name" class="form-control col-md-10" required value="{{$user->l_name}}">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Contact No.<span class="req">*</span>
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="phone" id="phone" required value="{{ $user->phone }}" class="form-control"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Address<span class="req">*</span>
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" name="address" id="address" required value="{{ $user->address }}" class="form-control"/>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Birth Date<span class="req">*</span>
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12" style="height: 34px;">     
                  <div class="input-group date">
                    <input type="text" class="form-control" id="b_date" name="b_date" required />
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                  </div>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Gender<span class="req">*</span>
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <select id="gender" name="gender" class="form-control" style="height: 30.5px;font-size: 12px;">
                    @if (count($gender) > 1)
                      @foreach($gender as $g)
                        <option value="{{$g}}" {{ $g == $user->gender ? "selected" : "" }}>{{$g}}</option>
                      @endforeach
                    @elseif (count($gender) > 0)
                      <option value="{{$user->gender}}">{{$user->gender}}</option>
                    @endif
                  </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Civil Status<span class="req">*</span>
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <select id="civil_status" name="civil_status" class="form-control" style="height: 30.5px;font-size: 12px;">
                    @if (count($civilstat) > 1)
                      @foreach($civilstat as $cs)
                        <option value="{{$cs}}" {{$cs == $user->civil_status ? "selected" : ""}}>{{$cs}}</option>
                      @endforeach
                    @elseif (count($civilstat) > 0)
                      <option value="{{$user->civil_status}}">{{$user->civil_status}}</option>
                    @endif
                  </select>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-md-2 col-sm-2 col-xs-12">Email<span class="req">*</span>
                </label>
                <div class="col-md-4 col-sm-4 col-xs-12">
                  <input type="text" placeholder="ex@example.com" name="email" id="email" required class="form-control" value="{{$user->email}}" />
                </div>
            </div>
            <br/>
            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-2">
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

    var phone = [{ "mask": "0\\9#########"}, { "mask": "09#########"}];
    
      $('#phone').inputmask({ 
          mask: phone, 
          greedy: false, 
          definitions: { '#': { validator: "[0-9]", cardinality: 1}} });

      $('#b_date').datetimepicker({
        format: "MMMM DD, YYYY",
        maxDate: moment().add(1, 'h'),
        date: "{{$user->b_date}}"
      });
});

function check(val){
  $('#avatar_req').val(val);
}


</script>

@stop