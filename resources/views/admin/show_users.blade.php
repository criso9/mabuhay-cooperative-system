@extends('layout.panel')

@section('content')

<div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>User Profile</h3>
      </div>

    </div>
    
    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_content">
            <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
              <div class="profile_img">
                <div id="crop-avatar">
                  <!-- Current avatar -->
                  <img class="img-responsive avatar-view" src="{{ url('/images/'.$member->avatar) }}" alt="Avatar" title="Change the avatar">
                </div>
              </div>
              <h3 style="text-transform: capitalize;">{{ $member->f_name }}</h3>

              <ul class="list-unstyled user_data">
                <li><i class="fa fa-map-marker user-profile-icon"></i> {{ $member->address }}</li>

                <li>
                  <i class="fa fa-briefcase user-profile-icon"></i> {{ $member->role->role_name }}
                </li>

                <li>
                  <i class="fa fa-envelope user-profile-icon"></i> {{ $member->email }}
                </li>

                <li>
                  <i class="fa fa-phone user-profile-icon"></i> {{ $member->phone }}
                </li>

                 <li>
                  <i class="fa fa-user user-profile-icon"></i> {{ $member->status }}
                </li>
              </ul>

              <button type="button" id="myBtn" class="btn btn-primary" data-toggle="modal" data-target = "#change-status-modal"><i class="fa fa-edit m-right-xs"></i> Change Status</button>

              <br />
              <div id="myModal" class="modal">
          		<div class="modal-content">
          			<div class="modal-header">
          				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          					<span aria-hidden="true">&times;</span>
          				</button>
          				<h4 class="modal-title" id="favoritesModalLabel">Change Status</h4>
          			</div>
          			<div class="modal-body">
          				{{ Form::model($member, array('route' => array('admin.member.update', $member->id), 'method' => 'put')) }}
							<!-- <select class="form-control" name="status">
				                <option>Active</option>
				                <option>Inactive</option>
				             </select> -->

				             {{ Form::select('status', ['active' => 'active', 'inactive' => 'inactive'], $member->status, ['class' => 'form-control']) }}
				             <br/>
				             <button class="btn btn-success">Save</button>
			             </form>
          			</div>
          		</div>
      			
              </div>


            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">

              <div class="profile_title">
                <div class="col-md-6">
                  <h2>Monthly Contribution Report</h2>
                </div>
                <div class="col-md-6">
                  <div id="reportrange" class="pull-right" style="margin-top: 5px; background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #E6E9ED">
                    <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                    <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                  </div>
                </div>
              </div>
              <!-- start of user-activity-graph -->
              <div id="graph_bar" style="width:100%; height:280px;"></div>
              <!-- end of user-activity-graph -->

              <div class="" role="tabpanel" data-example-id="togglable-tabs">
                <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#tab_content1" id="loan-tab" role="tab" data-toggle="tab" aria-expanded="true">Loans</a>
                  </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                  <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="loan-tab">
                    <p>Sample data</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
  	// Get the modal
	var modal = document.getElementById('myModal');

	// Get the button that opens the modal
	var btn = document.getElementById("myBtn");

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];

	// When the user clicks on the button, open the modal 
	btn.onclick = function() {
	    modal.style.display = "block";
	}

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
	    modal.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
	    if (event.target == modal) {
	        modal.style.display = "none";
	    }
	}
  </script>

  <!-- {{$member}} -->

@stop