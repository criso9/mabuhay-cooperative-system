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
				        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="coop-name">Cooperative Name <span class="req">*</span>
				        </label>
				        <div class="col-md-6 col-sm-6 col-xs-12">
				        	<!-- <input type="text" id="name" name="name" required="required" class="form-control col-md-7 col-xs-12">
				      		</input> -->
				      		@if ($coop)
								{{ Form::input('text', 'name', $coop->coop_name, array('class' => 'form-control col-md-7 col-xs-12', 'required' => 'required')) }}
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
						<label class="control-label col-md-3 col-sm-3 col-xs-12" for="logo">Logo <span class="req">*</span>
						</label>
						<div class="col-md-6 col-sm-6 col-xs-12">
						  <!-- <input type="file" id="logo" name="logo" required="required" class="col-md-7 col-xs-12"> -->
							<input type="file" name="logo" id="logo" required="required">
							<img src="" id="logo-img" width="200px" />
						</div>
				  	</div>
				  	<div class="form-group">
				        <label for="banner" class="control-label col-md-3 col-sm-3 col-xs-12">Banner<span class="req">*</span></label>
				        <div class="col-md-6 col-sm-6 col-xs-12">
				        	<input type="file" name="banner" id="banner" required="required">
							<img src="" id="banner-img" width="500px" />
				        </div>
				  	</div>
				  	<div class="form-group">
				        <label class="control-label col-md-3 col-sm-3 col-xs-12">Mission<span class="req">*</span></label>
				        <div class="col-md-6 col-sm-6 col-xs-12">
				          <textarea id="mission" class="form-control" style="overflow-x: hidden;" name="mission" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Minimum is 20 characters long" data-parsley-validation-threshold="10"></textarea>
				        </div>
				  	</div>
				  	<div class="-group">
				        <label class="control-label col-md-3 col-sm-3 col-xs-12">Vision<span class="req">*</span></label>
				        <div class="col-md-6 col-sm-6 col-xs-12">
				          <textarea id="vision" class="form-control" style="overflow-x: hidden;" name="vision" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Minimum is 20 characters long" data-parsley-validation-threshold="10"></textarea>
				        </div>
				  	</div>
				</div>
				<div id="step-2">
					<h2 class="StepTitle">Slide show of Pictures</h2>
					<div>
						<form id="fileupload" action="https://jquery-file-upload.appspot.com/" method="POST" enctype="multipart/form-data">
						<div class="row fileupload-buttonbar">
				            <div class="col-lg-7">
				                <!-- The fileinput-button span is used to style the file input field as button -->
				                <span class="btn btn-success fileinput-button">
				                    <i class="glyphicon glyphicon-plus"></i>
				                    <span>Add files...</span>
				                    <input type="file" name="files[]" multiple>
				                </span>
				                <button type="submit" class="btn btn-primary start">
				                    <i class="glyphicon glyphicon-upload"></i>
				                    <span>Start upload</span>
				                </button>
				                <button type="reset" class="btn btn-warning cancel">
				                    <i class="glyphicon glyphicon-ban-circle"></i>
				                    <span>Cancel upload</span>
				                </button>
				                <button type="button" class="btn btn-danger delete">
				                    <i class="glyphicon glyphicon-trash"></i>
				                    <span>Delete</span>
				                </button>
				                <input type="checkbox" class="toggle" style="float: none;width: auto;">
				                <!-- The global file processing state -->
				                <span class="fileupload-process"></span>
				            </div>
				            <!-- The global progress state -->
				            <div class="col-lg-5 fileupload-progress fade">
				                <!-- The global progress bar -->
				                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
				                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
				                </div>
				                <!-- The extended global progress state -->
				                <div class="progress-extended">&nbsp;</div>
				            </div>
				        </div>
				        <!-- The table listing the files available for upload/download -->
        				<table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
						</form>
						<!-- The blueimp Gallery widget -->
						<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls" data-filter=":even">
						    <div class="slides"></div>
						    <h3 class="title"></h3>
						    <a class="prev">‹</a>
						    <a class="next">›</a>
						    <a class="close">×</a>
						    <a class="play-pause"></a>
						    <ol class="indicator"></ol>
						</div>
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
<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td>
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>

<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="{{asset('js/fileupload/load-image.all.min.js')}}"></script>

<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="{{asset('js/fileupload/jquery.ui.widget.js')}}"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="https://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>

<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="https://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- blueimp Gallery script -->
<script src="https://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="{{asset('js/fileupload/jquery.iframe-transport.js')}}"></script>
<script src="{{asset('js/fileupload/jquery.fileupload.js')}}"></script>
<!-- The File Upload processing plugin -->
<script src="{{asset('js/fileupload/jquery.fileupload-process.js')}}"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="{{asset('js/fileupload/jquery.fileupload-image.js')}}"></script>
<!-- The File Upload audio preview plugin -->
<script src="{{asset('js/fileupload/jquery.fileupload-audio.js')}}"></script>
<!-- The File Upload video preview plugin -->
<script src="{{asset('js/fileupload/jquery.fileupload-video.js')}}"></script>
<!-- The File Upload validation plugin -->
<script src="{{asset('js/fileupload/jquery.fileupload-validate.js')}}"></script>
<!-- The File Upload user interface plugin -->
<script src="{{asset('js/fileupload/jquery.fileupload-ui.js')}}"></script>
<!-- The main application script -->
<script src="{{asset('js/fileupload/main.js')}}"></script>

@stop