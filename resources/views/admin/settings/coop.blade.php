@extends('layout.panel')

@section('content')

<div class="">
	<div class="page-title">
	  <div class="title_left">
	    <h3>Settings</h3>
	  </div>
	</div>
	<div class="clearfix"></div>

	<div class="row">
	  <div class="col-md-12 col-sm-12 col-xs-12">
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
	    <div class="x_panel">
	      <div class="x_title">
	        <h2>Setup</h2>
	        <div class="clearfix"></div>
	      </div>
	      <div class="x_content">

	        <!-- Smart Wizard -->
	        <p>This will be your guide to setup your cooperative management system.</p>
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
				        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="coop-name">Cooperative Name <span class="required">*</span>
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
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="logo">Logo <span class="required">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
						  <!-- <input type="file" id="logo" name="logo" required="required" class="col-md-7 col-xs-12"> -->
							<input type="file" name="logo" id="logo" required="required">
							<img src="" id="logo-img" width="200px" />
						</div>
				  	</div>
				  	<div class="form-group">
				        <label for="banner" class="control-label col-md-3 col-sm-3 col-xs-12">Banner<span class="required">*</span></label>
				        <div class="col-md-6 col-sm-6 col-xs-12">
				        	<input type="file" name="banner" id="banner" required="required">
							<img src="" id="banner-img" width="500px" />
				        </div>
				  	</div>
				  	<div class="form-group">
				        <label class="control-label col-md-3 col-sm-3 col-xs-12">Mission<span class="required">*</span></label>
				        <div class="col-md-6 col-sm-6 col-xs-12">
				          <textarea id="mission" class="form-control" style="overflow-x: hidden;" name="mission" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Minimum is 20 characters long" data-parsley-validation-threshold="10"></textarea>
				        </div>
				  	</div>
				  	<div class="-group">
				        <label class="control-label col-md-3 col-sm-3 col-xs-12">Vision<span class="required">*</span></label>
				        <div class="col-md-6 col-sm-6 col-xs-12">
				          <textarea id="vision" class="form-control" style="overflow-x: hidden;" name="vision" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Minimum is 20 characters long" data-parsley-validation-threshold="10"></textarea>
				        </div>
				  	</div>
				</div>
				<div id="step-2">
					<h2 class="StepTitle">Slide show of Pictures</h2>
					<div class="dropzone"></div>
				</div>
				<div id="step-3">
					<h2 class="StepTitle">Upload the following documents</h2>
					  	<div class="form-group">
					        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Policies<span class="required">*</span>
					        </label>
					        <div class="col-md-6 col-sm-6 col-xs-12">
					           <div class="dropzone"></div>
					        </div>
					  	</div>
							<div class="form-group">
							<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Other Documents<span class="required">*</span>
							</label>
							<div class="col-md-6 col-sm-6 col-xs-12">
					            <div class="dropzone"></div>
							</div>
					  	</div>
				</div>
				<div id="step-4">
					<h2 class="StepTitle">Interest Rate</h2>
						<div class="form-group">
					        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="formula">Member <span class="required">*</span>
					        </label>
					        <div class="col-md-6 col-sm-6 col-xs-12">
					          <input type="text" id="formula" class="form-control col-md-7 col-xs-12">
					        </div>
					  	</div>
					  	<div class="form-group">
					        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="formula">Non-Member <span class="required">*</span>
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
</div>

<!-- <script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#logo-img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#logo").change(function(){
        readURL(this);
    });
</script> -->

@stop