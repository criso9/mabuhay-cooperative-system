@extends('layout.panel')

@section('content')

<div class="flex-center position-ref full-height">
	<div class="custom-breadcrumb">
  		{!! Breadcrumbs::render() !!}
  	</div>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">

		<div class="x_title">
	        <h2>List of Members</h2>
        	<div class="clearfix"></div>
      	</div>
      	<div class="x_content">
              	<div class="col-md-2 col-sm-2 col-xs-12 form-group pull-right" style="width: auto;padding-right: 0px;">
                	<a href="{{route('admin.member.create')}}" class="btn btn-round btn-info">Add Member</a>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>

            <div class="clearfix"></div>

			<div class="row" style="margin-bottom: 30px;">
          		<div class="col-md-12 col-sm-12 col-xs-12 text-center">
          			{{ Form::open(array('route' => 'member.loan.index.filter', 'method' => 'post', 'class' => 'form-horizontal form-label-left pending-type', 'style' => 'width: 22%;float: right; right: -15px;top: 0px;')) }}
			          <input type="hidden" name="_token" value="{{ csrf_token() }}">
			          <div class="form-group">
			            <label class="control-label col-md-3 col-sm-3 col-xs-12" style="font-weight: normal;margin-right: -10px;">Status:</label>
			            <div class="col-md-9 col-sm-9 col-xs-12">
			              <select id="status-type" name="statusFilter" class="form-control" style="height: 30.5px;font-size: 12px;" onchange="this.form.submit()">
			                  <option value="all" {{ 'all' == $status_filter ? "selected" : "" }}>All</option>
			                  <option value="active" {{ 'active' == $status_filter ? "selected" : "" }}>Active</option>
			                  <option value="inactive" {{ 'inactive' == $status_filter ? "selected" : "" }}>Inactive</option>
			              </select>
			            </div>
			          </div>
			        {{ Form::close() }}
          		</div>
          	</div>

          	<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12 text-center">
					<!-- {{ Form::model($members, array('route' => array('admin.member.index.filter'), 'method' => 'post')) }}
						<input type="hidden" name="_token" value="{{ csrf_token() }}"> -->
					<ul class="pagination pagination-split member-filter">
						@foreach($filters as $f)
				          <li>
							<!-- <input name="filter" value="{{$f}}" type="hidden">
				          	<button class="btn btn-default member-filter" type="submit" onClick="return validate()">
				          	{{$f}}
				          </button> -->
				          <a href="{{url('/admin/users/member')}}?f={{$f}}&s={{$status_filter}}" selected="{{ $f == $selected_filter ? "true" : "false" }}">{{$f}}</a>
				      		</li>
				        @endforeach
					</ul>
					<!-- {{ Form::close() }} -->
					<button id="clear-filter" type="button" class="btn btn-success btn-xs" style="margin-top: -20px;margin-left: 20px;">Clear</button>

				</div>

				<div class="clearfix"></div>

				@if ($members->count() > 1)
				    @foreach($members as $member)
				        <div class="col-md-3 col-sm-3 col-xs-12 profile_details">
				            <div class="well profile_view">
				              <div class="col-sm-12">
				                <h5 class="brief"><i>{{$member->description}}</i></h5>
				                <div class="left col-xs-7">
				                  <h4 style="text-transform: capitalize;">{{ $member->l_name }}, {{ $member->f_name }}</h4>
				                  <p><strong>About: </strong> Member since 2017 </p>
				                  <ul class="list-unstyled">
				                    <li><i class="fa fa-building"></i> Address: {{ $member->address }}</li>
				                    <li><i class="fa fa-phone"></i> Phone: {{ $member->phone }}</li>
				                    <li><i class="fa fa-user"></i> Status: <span style="color:{{ $member->status == "inactive" ? "red" : "inherit" }};">{{ $member->status }}</span></li>
				                  </ul>
				                </div>
				                <div class="right col-xs-5 text-center">
				                  <img src="/images/{{ $member->avatar }}" alt="" class="img-circle img-responsive">
				                </div>
				              </div>
				              <div class="col-xs-12 bottom text-center">
				                <div class="col-xs-12 emphasis">
				                  <a href="{{url('/admin/users/member/show/'.$member->id)}}" class="btn btn-primary btn-xs" style="width: 87px;">
				                  	 <i class="fa fa-user"> </i> View Profile
				                  </a>
				                   <!-- <button type="button" class="btn btn-success btn-xs" style="width: 87px;">
				                    <i class="fa fa-edit"> </i> Edit
				                  </button> -->
				                </div>
				              </div>
				            </div>
				          </div>
				    @endforeach
				@elseif ($members->count() > 0)
				    <div class="col-md-3 col-sm-3 col-xs-12 profile_details">
				            <div class="well profile_view">
				              <div class="col-sm-12">
				                <h5 class="brief"><i>{{$members[0]->description}}</i></h5>
				                <div class="left col-xs-7">
				                  <h4 style="text-transform: capitalize;">{{ $members[0]->l_name }}, {{ $members[0]->f_name }}</h4>
				                  <p><strong>About: </strong> Member since 2017 </p>
				                  <ul class="list-unstyled">
				                    <li><i class="fa fa-building"></i> Address: {{ $members[0]->address }}</li>
				                    <li><i class="fa fa-phone"></i> Phone: {{ $members[0]->phone }}</li>
				                     <li><i class="fa fa-user"></i> Status: <span style="color:{{ $members[0]->status == "inactive" ? "red" : "inherit" }};">{{ $members[0]->status }}</span></li>
				                  </ul>
				                </div>
				                <div class="right col-xs-5 text-center">
				                  <img src="/images/{{ $members[0]->avatar }}" alt="" class="img-circle img-responsive">
				                </div>
				              </div>
				              <div class="col-xs-12 bottom text-center">
				                <div class="col-xs-12 emphasis">
				                  <a href="{{url('/admin/users/member/show/'.$members[0]->id)}}" class="btn btn-primary btn-xs" style="width: 87px;">
				                  	 <i class="fa fa-user"> </i> View Profile
				                  </a>
				                </div>
				              </div>
				            </div>
				          </div>
				@endif

				</div>
      	</div>
    </div>
  </div>
</div>

<script type="text/javascript">

var clear = document.getElementById("clear-filter");

clear.onclick = function() {
	window.location = window.location.href.split("?")[0];
}

</script>
@stop