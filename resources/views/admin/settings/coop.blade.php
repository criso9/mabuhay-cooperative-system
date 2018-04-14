@extends('layout.panel')

@section('content')


<div class="flex-center position-ref full-height">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Setup </h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
			<!-- <br/> -->
			<p>This will be your guide to setup your cooperative management system.</p>
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
	        {{ Form::open(array('route' => array('admin.coop'), 'files' => true, 'class' => 'form-horizontal form-label-left', 'method' => 'post')) }}
	        <div id="wizard" class="form_wizard wizard_horizontal">
	        	<ul class="wizard_steps">
		            <li>
		              <a href="#step-1">
		                <span class="step_no">1</span>
		                <span class="step_descr">
	                      Step 1<br />
	                      <small>Basic Information</small>
	                  </span>
		              </a>
		            </li>
		            <li>
		              <a href="#step-2">
		                <span class="step_no">2</span>
		                <span class="step_descr">
							Step 2<br />
							<small>Other Details</small>
						</span>
		              </a>
		            </li>
		            <li>
		              <a href="#step-3">
		                <span class="step_no">3</span>
		                <span class="step_descr">
							Step 3<br />
							<small>Files and Documents</small>
		                </span>
		              </a>
		            </li>
		            <li>
		              <a href="#step-4">
		                <span class="step_no">4</span>
		                <span class="step_descr">
							Step 4<br />
							<small>Interest Computation</small>
						</span>
		              </a>
		            </li>
	          	</ul>
				<div id="step-1">
				  	<div class="form-group">
				        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="coop-name">Cooperative Name <span class="req">*</span>
				        </label>
				        <div class="col-md-6 col-sm-6 col-xs-12">
				        	<!-- <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12">
				      		</input> -->
				      		@if ($coop)
								{{ Form::input('text', 'name', $coop->name, array('class' => 'form-control col-md-7 col-xs-12', 'required' => 'required')) }}
							@else
								{{ Form::input('text', 'name', null, array('class' => 'form-control col-md-7 col-xs-12', 'required' => 'required')) }}
				      		@endif
				        </div>
				  	</div>
				  	<div class="form-group">
					 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="coop-name">Date Founded <span class="req">*</span></label>
                     <div class="col-md-6 col-sm-6 col-xs-12">   
	                  <div class="input-group date">
	                    <input id="date-founded" type="text" class="form-control col-md-10" name="date_founded" required />
	                    <span class="input-group-addon">
	                      <span class="glyphicon glyphicon-calendar"></span>
	                    </span>
	                  </div>
	                </div>
				  	</div>
						<div class="form-group">
						<label class="control-label col-md-3 col-sm-3 col-xs-12">Logo <span class="req">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
						  <input type="hidden" name="logo_img" value="{{ '/uploads/'.$coop->logo }}"/>
						  <img src="{{ '/uploads/'.$coop->logo }}"  style="width:120px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd;">
						  <small>Current logo saved in database</small>

							<input type="file" name="logo" id="logo" style="margin-top: 10px;">
						</div>
				  	</div>
				  	<div class="form-group" style="margin-top: 20px;">
				        <label class="control-label col-md-3 col-sm-3 col-xs-12">Icon<span class="req">*</span></label>
				        <div class="col-md-6 col-sm-6 col-xs-12">
				        	<input type="hidden" name="icon_img" value="{{ '/uploads/'.$coop->icon }}"/>
				        	<img src="{{ '/uploads/'.$coop->icon }}"  style="width:120px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd;">
				        	<small>Current icon saved in database</small>
				        	<input type="file" name="icon" id="icon" style="margin-top: 10px;">
				        </div>
				  	</div>
				  	<div class="form-group" style="margin-top: 20px;">
				        <label class="control-label col-md-3 col-sm-3 col-xs-12">Mission<span class="req">*</span></label>
				        <div class="col-md-6 col-sm-6 col-xs-12">
				          <textarea id="mission" class="form-control" style="overflow-x: hidden;" name="mission" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Minimum is 20 characters long" data-parsley-validation-threshold="10">{{$coop->mission}}</textarea>
				        </div>
				  	</div>
				  	<div class="-group">
				        <label class="control-label col-md-3 col-sm-3 col-xs-12">Vision<span class="req">*</span></label>
				        <div class="col-md-6 col-sm-6 col-xs-12">
				          <textarea id="vision" class="form-control" style="overflow-x: hidden;" name="vision" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Minimum is 20 characters long" data-parsley-validation-threshold="10">{{$coop->vision}}</textarea>
				        </div>
				  	</div>
				</div>
				<div id="step-2">
					<h2 class="StepTitle">Home Page - Slideshow of Pictures</h2>
					<div>
						<small>Current icon saved in database</small>
				        <input type="file" name="icon" id="icon" style="margin-top: 10px;">
						
					</div>
				</div>
				<div id="step-3">
					<h2 class="StepTitle">Upload the following documents</h2>
					  	<div class="form-group">
					        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Policies<span class="req">*</span>
					        </label>
					        <div class="col-md-6 col-sm-6 col-xs-12">
					           <div class="dropzone"></div>
					        </div>
					  	</div>
							<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Other Documents<span class="req">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
					            <div class="dropzone"></div>
							</div>
					  	</div>
				</div>
				<div id="step-4">
					<h2 class="StepTitle">Interest Rate</h2>
						<div class="form-group">
					        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="formula">Member <span class="req">*</span>
					        </label>
					        <div class="col-md-6 col-sm-6 col-xs-12">
					          <input type="text" id="formula" class="form-control col-md-7 col-xs-12">
					        </div>
					  	</div>
					  	<div class="form-group">
					        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="formula">Non-Member <span class="req">*</span>
					        </label>
					        <div class="col-md-6 col-sm-6 col-xs-12">
					          <input type="text" id="formula" class="form-control col-md-7 col-xs-12">
					        </div>
					  	</div>
				</div>
	        </div>
	        {{ Form::close() }}
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

    	$('#date-founded').datetimepicker({
	        format: "MMMM DD, YYYY",
	        maxDate: moment()
	      });
	});
</script>

@stop