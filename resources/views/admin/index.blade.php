@extends('layout.panel')

@section('content')

<div class="flex-center position-ref full-height">
    <div>
    	{!! Breadcrumbs::render() !!}
    </div>
    <div class="col-md-12 col-sm-12 col-xs-12">
    	<div class="x_panel">
		<div class="x_content">
			<div>
				<div class="row tile_count">
		            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		              <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
		              <div class="count">{{$users}}</div>
		            </div>
		            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		              <span class="count_top"><i class="fa fa-user"></i> Active</span>
		              <div class="count green">{{$active}}</div>
		            </div>
		            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		              <span class="count_top"><i class="fa fa-user"></i> Inactive</span>
		              <div class="count">{{$inactive}}</div>
		            </div>
		             <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		              <span class="count_top"><i class="fa fa-user"></i> For Approval</span>
		              <div class="count">{{$pending}}</div>
		            </div>
		             <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		              <span class="count_top"><i class="fa fa-user"></i> For Confirmation</span>
		              <div class="count">{{$waiting}}</div>
		            </div>
		             <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
		              <span class="count_top"><i class="fa fa-user"></i> Rejected Application</span>
		              <div class="count">{{$rejected}}</div>
		            </div>
		         </div>
			</div>
		</div>
	</div>
    </div>
</div>





<div id="msgModal" class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content custom-modal-content">
          <div class="modal-header">
              <h3 class="modal-title">Message</h3>
          </div>

          <div class="modal-body">
          	 <br/>
             <p>{{ Session::get('flash_message') }}</p>
             <br/>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="ok-button" data-dismiss="modal">OK</button>
          </div>
      </div>
  </div>
</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function() {
		@if (Session::has('flash_message'))
	      $('#msgModal').modal('show');
	    @endif
	});
</script>

@stop