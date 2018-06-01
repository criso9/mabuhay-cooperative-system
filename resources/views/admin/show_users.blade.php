@extends('layout.panel')

@section('title')
User Profile
@stop

@section('content')

<div class="flex-center position-ref full-height">
  <div class="custom-breadcrumb">
    {!! Breadcrumbs::render() !!}
  </div>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">
        <h2>User Profile <small></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="x_content">
          <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
            <div class="profile_img">
              <div id="crop-avatar">
                <!-- Current avatar -->
                <img class="img-responsive avatar-view" src="{{ '/uploads/profile/'.$member->avatar }}" alt="Avatar" title="Change the avatar">
              </div>
            </div>
            <h3 style="text-transform: capitalize;">{{ $member->role_name }}</h3>

            <ul class="list-unstyled user_data">
              <li>
                <i class="fa fa-user user-profile-icon"></i> Status: 
                <span class="label {{ $member->status == "inactive" ? "label-danger" : "label-success" }}">{{ $member->status }}</span>
              </li>
              <li>
                Member since {{ $member->activated_at }}
              </li>
            </ul>

            <button type="button" id="myBtn" class="btn btn-primary" data-toggle="modal" data-target = "#change-status-modal" onclick="modal()"><i class="fa fa-edit m-right-xs"></i> Change Status</button>

          </div>
          <div class="col-md-9 col-sm-9 col-xs-12">
            <div class="profile_title">
              <div class="col-md-6">
                <h2>Details</h2>
              </div>
            </div>
            <div>
              <table style="width: 45%;font-size: 15px;margin-top: 30px;">
                <tr>
                  <td>Name: </td>
                  <td>{{ $member->l_name }}, {{ $member->f_name }} {{ $member->m_name }}</td>
                </tr>
                <tr>
                  <td>Email: </td>
                  <td>{{ $member->email }}</td>
                </tr>
                <tr>
                  <td>Phone: </td>
                  <td>{{ $member->phone }}</td>
                </tr>
                <tr>
                  <td>Address: </td>
                  <td>{{ $member->address }}</td>
                </tr>
                <tr>
                  <td>Birth Date: </td>
                  <td>{{ $member->b_date }}</td>
                </tr>
                <tr>
                  <td>Gender: </td>
                  <td>{{ $member->gender }}</td>
                </tr>
                <tr>
                  <td>Civil Status: </td>
                  <td>{{ $member->civil_status }}</td>
                </tr>
              </table>
            </div>

          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<div id="change-status-modal" class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <div class="modal-content custom-modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <h4 class="modal-title" id="favoritesModalLabel">Change Status</h4>
    </div>
    <div class="modal-body">
      {{ Form::model($member, array('route' => array('admin.member.update', $member->id), 'method' => 'put', 'class' => 'form-horizontal form-label-left')) }}
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
            <div class="col-md-9 col-sm-9 col-xs-12"> 
              {{ Form::select('status', ['active' => 'active', 'inactive' => 'inactive'], $member->status, ['class' => 'form-control', 'id' => 'status-field', 'onchange' => 'statusChange(this.value)']) }}
            </div>
          </div>
          <div class="form-group" style="display: none;" id="remarks-field">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Remarks <span class="req">*</span>
            </label>
            <div class="col-md-9 col-sm-9 col-xs-12">     
              <textarea name="remarks" id="remarks" placeholder="Enter text here" style="width: 100%;"></textarea>
            </div>
          </div>
         <br/>
          <div style="float: right;">
            <button class="btn btn-success">Save</button>
          </div>
       {{Form::close()}}
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
  
  function statusChange(val){
    if(val == 'inactive'){
      $('#remarks-field').css('display', 'block');
      $('#remarks').attr("required",true);
    } else if(val == 'active') {
      $('#remarks-field').css('display', 'none');
      $('#remarks').attr("required",false);
    }
  }

  function modal(){
    $('#remarks-field').css('display', 'none');
    $('#remarks').attr("required",false);
  }

</script>

@stop