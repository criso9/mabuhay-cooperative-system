@extends('layout.panel')

@section('title')
Poll Management
@stop

@section('content')

<div class="flex-center position-ref full-height">
  <div class="custom-breadcrumb">
    {!! Breadcrumbs::render() !!}
  </div>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">

        <h2>Create Poll <small></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      	<br/>

        <div class="well col-md-8 col-md-offset-2">
            @if($errors->any())
                <ul class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        <form method="POST" action=" {{ route('admin.poll.store') }}">
            {{ csrf_field() }}
            <!-- Question Input -->
            <div class="form-group">
                <label for="question">Question:</label>
                <input type="text" id="question" name="question" class="form-control"/>
            </div>
            <label for="question">Options: </label><small> (minimum of 2)</small>
            <ul class="options" style="list-style: none;">
                <li>
                    <input id="option_1" type="text" name="options[0]" class="form-control"/>
                    <input id="option_2" type="text" name="options[1]" class="form-control"/>
                </li>
            </ul>
            <!-- Create Form Submit -->
            <div class="form-group">
                <input name="create" type="submit" value="Create" class="btn btn-primary form-control"/>
            </div>
        </form>
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

   
  });

</script>

@stop