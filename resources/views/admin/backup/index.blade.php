@extends('layout.panel')

@section('title')
Database - Backup
@stop

@section('content')

<div class="flex-center position-ref full-height">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Backup Database <small></small></h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
			<br/>

				<a id="create-new-backup-button" href="{{ route('admin.backup.app.create') }}" class="btn btn-info pull-right" style="margin-bottom:2em;"><i class="fa fa-plus"></i> Application
            	</a>

            	<a id="create-new-backup-button" href="{{ route('admin.backup.database.create') }}" class="btn btn-info pull-right" style="margin-bottom:2em;"><i class="fa fa-plus"></i> Database
            	</a>

				<div class="col-xs-12">
	            @if (count($backups))

	                <table class="table table-striped table-bordered">
	                    <thead>
	                    <tr>
	                        <th>File Name</th>
	                        <th>Size</th>
	                        <th>Date</th>
	                        <th>Action</th>
	                    </tr>
	                    </thead>
	                    <tbody>
	                    @foreach($backups as $backup)
	                        <tr>
	                            <td>{{ $backup['file_name'] }}</td>
	                            <td>{{ $backup['file_size'] }}</td>
	                            <td>
	                                {{ $backup['last_modified'] }}
	                            </td>
	                            <td align="center">
	                                <a class="btn btn-xs btn-success"
	                                   href="{{ url('/admin/backup/download/'.$backup['file_name']) }}"><i
	                                        class="fa fa-cloud-download"></i> Download</a>
	                                <a class="btn btn-xs btn-danger" data-button-type="delete"
	                                   href="{{ url('/admin/backup/delete/'.$backup['file_name']) }}"><i class="fa fa-trash-o"></i>
	                                    Delete</a>
	                            </td>
	                        </tr>
	                    @endforeach
	                    </tbody>
	                </table>
	            @else
	                <div class="well">
	                    <h4>There are no backups</h4>
	                </div>
	            @endif
	        </div>
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
</script>

@stop