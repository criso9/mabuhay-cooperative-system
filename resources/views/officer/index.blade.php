@extends('layout.panel')

@section('content')

<div class="flex-center position-ref full-height">
	<div class="custom-breadcrumb">
    {!! Breadcrumbs::render() !!}
  </div>
    <div>

		<p>This is for testing only</p>
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