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

				<div>
					{{ Form::open(array('route' => 'admin.database.backup', 'method' => 'post')) }}
			          <input type="hidden" name="_token" value="{{ csrf_token() }}">
			          <div class="form-group">
			            <div class="col-md-9 col-sm-9 col-xs-12">
			              <button class="btn btn-success">Backup</button>
			            </div>
			          </div>
			        </form>
				</div>

				<div class="col-xs-12">
		            @if (count($backups))

		                <table class="table table-striped table-bordered">
		                    <thead>
		                    <tr>
		                        <th>File</th>
		                        <th>Size</th>
		                        <th>Date</th>
		                        <th>Age</th>
		                        <th></th>
		                    </tr>
		                    </thead>
		                    <tbody>
		                    @foreach($backups as $backup)
		                        <tr>
		                            <td>{{ $backup['file_name'] }}</td>
		                            <td>{{ humanFilesize($backup['file_size']) }}</td>
		                            <td>
		                                {{ formatTimeStamp($backup['last_modified'], 'F jS, Y, g:ia (T)') }}
		                            </td>
		                            <td>
		                                {{ diffTimeStamp($backup['last_modified']) }}
		                            </td>
		                            <td class="text-right">
		                                <a class="btn btn-xs btn-default"
		                                   href="{{ url('backup/download/'.$backup['file_name']) }}"><i
		                                        class="fa fa-cloud-download"></i> Download</a>
		                                <a class="btn btn-xs btn-danger" data-button-type="delete"
		                                   href="{{ url('backup/delete/'.$backup['file_name']) }}"><i class="fa fa-trash-o"></i>
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