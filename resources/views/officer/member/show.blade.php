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
                <img class="img-responsive avatar-view" src="{{ url('/images/'.$member->avatar) }}" alt="Avatar" title="Change the avatar">
              </div>
            </div>
            <h3 style="text-transform: capitalize;">{{ $member->role_name }}</h3>

            <ul class="list-unstyled user_data">
              <li>
                <i class="fa fa-user user-profile-icon"></i> Status: <span style="color:{{ $member->status == "inactive" ? "red" : "inherit" }};">{{$member->status}}</span>
              </li>
              <li>
                Member since {{ $member->activated_at }}
              </li>
            </ul>

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

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript">
 

</script>


@stop