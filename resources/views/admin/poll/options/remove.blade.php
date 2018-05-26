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

        <h2>Poll Management <small></small></h2>
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
            <form method="POST" action=" {{ route('admin.poll.options.remove', $poll->id) }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <!-- Question Input -->
                <div class="form-group">
                    <label>{{ $poll->question }}</label>
                    <div class="radio">
                        @foreach($poll->options as $option)
                            <label>
                                <input type="checkbox" name="options[]" value={{ $option->id }}> {{ $option->name }}
                            </label>
                            <br/>
                        @endforeach
                    </div>
                </div>
                <!-- Create Form Submit -->
                <div class="form-group">
                    <input name="Delete" type="submit" value="Delete" class="btn btn-danger form-control" >
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