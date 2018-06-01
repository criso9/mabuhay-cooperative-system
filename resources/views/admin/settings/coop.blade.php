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
	        {{ Form::open(array('route' => array('admin.coop'), 'files' => true, 'class' => 'form-horizontal form-label-left', 'method' => 'post', 'enctype' => 'multipart/form-data')) }}
	        <div id="wizard" class="form_wizard wizard_horizontal">
	        	<ul class="wizard_steps">
		            <li>
		              <a href="#step1">
		                <span class="step_no">1</span>
		                <span class="step_descr">
	                      Step 1<br />
	                      <small>Basic Information</small>
	                  </span>
		              </a>
		            </li>
		            <li>
		              <a href="#step2">
		                <span class="step_no">2</span>
		                <span class="step_descr">
							Step 2<br />
							<small>Slideshow of Pictures</small>
						</span>
		              </a>
		            </li>
		            <li>
		              <a href="#step3">
		                <span class="step_no">3</span>
		                <span class="step_descr">
							Step 3<br />
							<small>Files and Documents</small>
		                </span>
		              </a>
		            </li>
		            <li>
		              <a href="#step4">
		                <span class="step_no">4</span>
		                <span class="step_descr">
							Step 4<br />
							<small>Interest Computation</small>
						</span>
		              </a>
		            </li>
	          	</ul>
				<div id="step1">
				  	<div class="form-group">
				        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="coop-name">Cooperative Name <span class="req">*</span>
				        </label>
				        <div class="col-md-6 col-sm-6 col-xs-12">
				      		@if ($coop)
								{{ Form::input('text', 'coop_name', $coop->coop_name, array('class' => 'form-control col-md-7 col-xs-12', 'required' => 'required')) }}
							@else
								{{ Form::input('text', 'coop_name', null, array('class' => 'form-control col-md-7 col-xs-12', 'required' => 'required')) }}
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
						  <input type="hidden" name="logo_img" value="{{ $coop->logo }}"/>
						  <img src="{{ '/uploads/'.$coop->logo }}"  style="width:120px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd;">
						  <small>Current logo saved in database</small>

							<input type="file" name="logo" id="logo" style="margin-top: 10px;">
						</div>
				  	</div>
				  	<div class="form-group" style="margin-top: 20px;">
				        <label class="control-label col-md-3 col-sm-3 col-xs-12">Icon <span class="req">*</span></label>
				        <div class="col-md-6 col-sm-6 col-xs-12">
				        	<input type="hidden" name="icon_img" value="{{ $coop->icon }}"/>
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
				<div id="step2">
					<h2 class="StepTitle">Home Page - Slideshow of Pictures</h2>
					<div style="margin-bottom: 10px;float: right;">
						<a href="" class="btn btn-round btn-info" data-toggle="modal" data-target="#add-carousel-modal">Add Carousel Image</a>
					</div>
					<div>
			          <table id="carousel-list" class="table table-striped table-bordered" style="font-size: 13px;width: 100%;">
			            <thead>
			            <tr>
			              <td>Remove</td>
			              <td>Image</td>
			              <td>URL</td>
			              <td>Added By</td>
			              <td>Added At</td>
			            </tr>
			            </thead>
			            <tbody>
			              @if ($carousel->count() > 1)
			                @foreach($carousel as $c)
			                  <tr>
		                      	<td align="middle" style="vertical-align: middle;">
		                        	<a href="" id="removeBtn" data-toggle="modal" data-target = "#removeModal" onclick="removeImg('{{$c->id}}')"><img id="{{$c->id}}-remove" src="/images/reject.png" style="width:25px; height: 25px;" onmouseover="deacHover('{{$c->id}}-remove');" onmouseout="deacOffHover('{{$c->id}}-remove');"/></a>
	                      		</td>
			                    <td>
			                    	<img src="{{url($c->path)}}" style="width: 150px;">
			                    </td>
			                    <td style="vertical-align: middle;">{{$c->url}}</td>
			                    <td style="vertical-align: middle;">{{$c->added_by}}</td>
			                    <td style="vertical-align: middle;">{{$c->added_at}}</td>
			                  </tr>
			                @endforeach
			              @elseif ($carousel->count() > 0)
			                <tr>
			                    <td align="middle" style="vertical-align: middle;">
		                        	<a href="" id="removeBtn" data-toggle="modal" data-target = "#removeModal" onclick="removeImg('{{$carousel[0]->id}}')"><img id="{{$carousel[0]->id}}-remove" src="/images/reject.png" style="width:25px; height: 25px;" onmouseover="deacHover('{{$carousel[0]->id}}-remove');" onmouseout="deacOffHover('{{$carousel[0]->id}}-remove');"/></a>
	                      		</td>
			                  <td>
			                  	<img src="{{url($carousel[0]->path)}}" style="width: 150px;">
			                  </td>
			                  <td style="vertical-align: middle;">{{$carousel[0]->url}}</td>
			                  <td style="vertical-align: middle;">{{$carousel[0]->added_by}}</td>
			                  <td style="vertical-align: middle;">{{$carousel[0]->added_at}}</td>
			                </tr>
			              @endif
			            </tbody>
			          </table>
			        </div>
				</div>
				<div id="step3">
					<h2 class="StepTitle">Upload the following documents</h2>
					 <div style="margin-bottom: 10px;float: right;">
						<a href="" class="btn btn-round btn-info" data-toggle="modal" data-target="#add-file-modal">Add Files</a>
					</div>
					<div>
						<table id="docs-list" class="table table-striped table-bordered" style="font-size: 13px;width: 100%;">
			            <thead>
			            <tr>
			              <td>Remove</td>
			              <td>File Name</td>
			              <td>File Type</td>
			              <td>Added By</td>
			              <td>Added At</td>
			            </tr>
			            </thead>
			            <tbody>
			              @if ($document->count() > 1)
			                @foreach($document as $d)
			                  <tr>
		                      	<td align="middle" style="vertical-align: middle;">
		                        	<a href="" id="removeBtn" data-toggle="modal" data-target = "#removeFileModal" onclick="removeFile('{{$d->id}}')"><img id="{{$d->id}}-remove" src="/images/reject.png" style="width:25px; height: 25px;" onmouseover="deacHover('{{$d->id}}-remove');" onmouseout="deacOffHover('{{$d->id}}-remove');"/></a>
	                      		</td>
			                    <td class="link-row">
			                    	<a href="{{url($d->path)}}">{{$d->orig_file_name}}</a>
			                    </td>
			                    <td style="vertical-align: middle;">{{$d->type}}</td>
			                    <td style="vertical-align: middle;">{{$d->added_by}}</td>
			                    <td style="vertical-align: middle;">{{$d->added_at}}</td>
			                  </tr>
			                @endforeach
			              @elseif ($document->count() > 0)
			                <tr>
			                    <td align="middle" style="vertical-align: middle;">
		                        	<a href="" id="removeBtn" data-toggle="modal" data-target = "#removeFileModal" onclick="removeFile('{{$document[0]->id}}')"><img id="{{$document[0]->id}}-remove" src="/images/reject.png" style="width:25px; height: 25px;" onmouseover="deacHover('{{$document[0]->id}}-remove');" onmouseout="deacOffHover('{{$document[0]->id}}-remove');"/></a>
	                      		</td>
			                  <td class="link-row">
			                  	<a href="{{url($document[0]->path)}}">{{$document[0]->orig_file_name}}</a>
			                  </td>
			                  <td style="vertical-align: middle;">{{$document[0]->type}}</td>
			                  <td style="vertical-align: middle;">{{$document[0]->added_by}}</td>
			                  <td style="vertical-align: middle;">{{$document[0]->added_at}}</td>
			                </tr>
			              @endif
			            </tbody>
			          </table>
					</div>
				          
				</div>
				<div id="step4">
					<h2 class="StepTitle">Cash Loan Interest Rate</h2>
						<div class="form-group">
					        <label class="control-label col-md-3 col-sm-3 col-xs-12">Member <span class="req">*</span>
					        </label>
					        <div class="col-md-6 col-sm-6 col-xs-12">
					          <input type="number" id="mem_int" name="mem_int" class="form-control col-md-7 col-xs-12" required="required" value="{{$coop->mem_int}}" />
					        </div>
					  	</div>
					  	<div class="form-group">
					        <label class="control-label col-md-3 col-sm-3 col-xs-12">Non-Member <span class="req">*</span>
					        </label>
					        <div class="col-md-6 col-sm-6 col-xs-12">
					          <input type="number" id="nonmem_int" name="nonmem_int" class="form-control col-md-7 col-xs-12" required="required" value="{{$coop->nonmem_int}}" />
					        </div>
					  	</div>
				</div>
	        </div>
	        {{ Form::close() }}
			</div>
		</div>
	</div>
</div>

<div id="add-carousel-modal" class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content custom-modal-content">
      <div class="modal-header">
        <button type="button" class="close close-add" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="favoritesModalLabel">Add Carousel Image</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(array('route' => 'admin.coop.store', 'files' => true, 'method' => 'post', 'class' => 'form-horizontal form-label-left', 'enctype' => 'multipart/form-data')) }}
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">URL <span class="req">*</span>
            </label>
            <div class="col-md-8 col-sm-8 col-xs-12" style="height: 34px;">     
              <div class="input-group" style="width: 100%;">
                <input type="text" name="url" class="form-control" required/> 
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Image <span class="req">*</span>
            </label>
            <div class="col-md-8 col-sm-8 col-xs-12" style="height: 34px;">
		        <div class="input-group">
		        	<input type="file" name="carousel_img[]" id="carousel_img" multiple="multiple" style="margin-top: 5px;text-transform: lowercase;">
		        	<small>Can upload multiple images</small>
		        </div>
            </div>
          </div>
          <br/>
           <div class="col-md-5 col-sm-5 col-xs-12 col-md-offset-3">
            <button class="btn btn-success">Save</button>
           </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>
  </div>

<div id="add-file-modal" class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content custom-modal-content">
      <div class="modal-header">
        <button type="button" class="close close-add" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="favoritesModalLabel">Add Files</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(array('route' => 'admin.coop.store.file', 'files' => true, 'method' => 'post', 'class' => 'form-horizontal form-label-left', 'enctype' => 'multipart/form-data')) }}
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Document Type <span class="req">*</span>
            </label>
            <div class="col-md-4 col-sm-4 col-xs-12" style="height: 34px;">     
              <div class="input-group" style="width: 100%;">
                {!! Form::select('file_type', $fileType, null, ['class' => 'form-control', 'style' => 'text-transform: Capitalize;']) !!}
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">File <span class="req">*</span>
            </label>
            <div class="col-md-8 col-sm-8 col-xs-12" style="height: 34px;">
		        <div class="input-group">
		        	<input type="file" name="docs[]" id="docs" multiple="multiple" style="margin-top: 5px;">
					<small>Can upload multiple files</small>
		        </div>
            </div>
          </div>
          <br/>
           <div class="col-md-5 col-sm-5 col-xs-12 col-md-offset-3">
            <button class="btn btn-success">Save</button>
           </div>
        {{ Form::close() }}
      </div>
    </div>
  </div>
  </div>

<div id="removeModal" class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content custom-modal-content">
    <div class="modal-header">
      <button type="button" id="reject-close" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <h4 class="modal-title" id="statusModalLabel">Remove Carousel Image</h4>
    </div>
    <div class="modal-body">
      {{ Form::open(array('route' => array('admin.coop.delete'), 'method' => 'put', 'id' => 'reg-approval-form', 'class' => 'form-horizontal form-label-left')) }}
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="_id" id="_id">

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Remarks <span class="req">*</span>
            </label>
            <div class="col-md-9 col-sm-9 col-xs-12">     
              <textarea name="remarks" placeholder="Enter text here" style="width: 100%;" required></textarea>
            </div>
          </div>
         <br/>
         <div style="float: right;">
            <button type="submit" class="btn btn-primary">Proceed</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
         </div>
      {{ Form::close() }}
    </div>
  </div>
</div>
</div>

<div id="removeFileModal" class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content custom-modal-content">
    <div class="modal-header">
      <button type="button" id="reject-close" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <h4 class="modal-title" id="statusModalLabel">Remove File</h4>
    </div>
    <div class="modal-body">
      {{ Form::open(array('route' => array('admin.coop.delete.file'), 'method' => 'put', 'class' => 'form-horizontal form-label-left')) }}
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="_fileId" id="_fileId">

          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Remarks <span class="req">*</span>
            </label>
            <div class="col-md-9 col-sm-9 col-xs-12">     
              <textarea name="remarks_file" placeholder="Enter text here" style="width: 100%;" required></textarea>
            </div>
          </div>
         <br/>
         <div style="float: right;">
            <button type="submit" class="btn btn-primary">Proceed</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
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

	    var dateFounded = <?php echo json_encode($coop->date_founded); ?>;

	    $("#date-founded").datetimepicker({
	    	date: new Date(dateFounded != null ? dateFounded : ''),
	    	format: "MMMM DD, YYYY",
	    	maxDate: moment()
	    });

	    $('#carousel-list').DataTable({
		    "order": [[ 2, "asc" ]],
		    "columnDefs": [
		      { "orderable": false, "targets": 0 },
		      { "orderable": false, "targets": 1 }
		    ]
		  });

	    $('#docs-list').DataTable({
		    "order": [[ 1, "asc" ]],
		    "columnDefs": [
		      { "orderable": false, "targets": 0 }
		    ]
		  });

	});

function deacHover(idVals)
  {
      $("#" + idVals).attr('src', '/images/reject-hover.png');
  }

  function deacOffHover(idVals)
  {
      $("#" + idVals).attr('src', '/images/reject.png');
  }

  function removeImg(id) {
    $('#_id').val(id);
  }

  function removeFile(id) {
    $('#_fileId').val(id);
  }

</script>

@stop