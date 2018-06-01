@extends('layout.panel')

@section('title')
Documents List
@stop

@section('content')

<div class="flex-center position-ref full-height">
  <div class="custom-breadcrumb">
    {!! Breadcrumbs::render() !!}
  </div>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">

        <h2>List of Documents <small></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
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
        <div>
          <div style="float: right;"><a href="" class="btn btn-round btn-info" data-toggle="modal" data-target = "#add-document-modal">Add Document</a></div>
        </div>
        <div style="clear:both;"></div>
      	<br/>
        <div>
          <table id="document-list" class="table table-striped table-bordered" style="font-size: 13px;">
            <thead>
            <tr>
              <td>Type</td>
              <td>File Name</td>
              <td>Added By</td>
              <td>Added At</td>
              <td>Action</td>
            </tr>
            </thead>
            <tbody>
              @if ($docs->count() > 1)
                @foreach($docs as $d)
                  <tr>
                    <td style="text-transform: Capitalize;">{{$d->type}}</td>
                    <td>{{$d->orig_file_name}}</td>
                    <td>{{$d->added_by}}</td>
                    <td>{{$d->added_at}}</td>
                    <td align="center">
                      <a class="btn btn-xs btn-success"
                         href="{{ url('/officer/documents/download/'.$d->id) }}"><i
                              class="fa fa-cloud-download"></i> Download</a>
                      <a class="btn btn-xs btn-danger" data-button-type="delete"
                         href="{{ url('/officer/documents/delete/'.$d->id) }}"><i class="fa fa-trash-o"></i>
                          Delete</a>
                    </td>
                  </tr>
                @endforeach
              @elseif ($docs->count() > 0)
                <tr>
                  <td style="text-transform: Capitalize;">{{$docs[0]->type}}</td>
                  <td>{{$docs[0]->orig_file_name}}</td>
                  <td>{{$docs[0]->added_by}}</td>
                  <td>{{$docs[0]->added_at}}</td>
                  <td align="center">
                    <a class="btn btn-xs btn-success"
                       href="{{ url($docs[0]->path) }}"><i
                            class="fa fa-cloud-download"></i> Download</a>
                    <a class="btn btn-xs btn-danger" data-button-type="delete"
                       href="{{ url('/officer/documents/delete/'.$docs[0]->id) }}"><i class="fa fa-trash-o"></i>
                        Delete</a>
                  </td>
                </tr>
              @endif
            </tbody>
          </table>
        </div>
  	  </div>
    </div>
  </div>

<div id="add-document-modal" class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
    <div class="modal-content custom-modal-content">
      <div class="modal-header">
        <button type="button" class="close close-add" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="favoritesModalLabel">Add Document</h4>
      </div>
      <div class="modal-body">
        {{ Form::open(array('route' => 'officer.documents.store', 'files' => true, 'method' => 'post', 'class' => 'form-horizontal form-label-left', 'enctype' => 'multipart/form-data')) }}
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

    $('#document-list').DataTable({
      "order": [[ 3, "desc" ]],
      "columnDefs": [
        { "orderable": false, "targets": 4 }
      ]
    });


  });


</script>

@stop