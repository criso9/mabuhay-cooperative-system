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
            <form method="POST" action=" {{ route('admin.poll.options.add', $poll->id) }}">
                {{ csrf_field() }}
                <!-- Question Input -->
                <div class="form-group">
                    <label for="question">{{ $poll->question }}</label>
                </div>
                <ul class="old_options">
                    @foreach($poll->options as $option)
                        <li> {{ $option->name }}</li>
                    @endforeach
                </ul>
                <ul id="options" style="list-style: none;">
                    <li>
                        <input type="text" name="options[0]" class="form-control add-input" placeholder="Insert your option" />
                            <a class="btn btn-danger" href="#" onclick='remove(this)'>
                                <i class="fa fa-minus-circle" aria-hidden="true"></i>
                            </a>
                    </li>
                </ul>

                <ul style="list-style: none;">
                    <li class="button-add">
                        <div class="form-group">
                            <a class="btn btn-success" id="add">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            </a>
                        </div>
                    </li>
                </ul>
                <!-- Create Form Submit -->
                <div class="form-group">
                    <input name="Add" type="submit" value="Add" class="btn btn-primary form-control" >
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

  function remove(current){
            current.parentNode.remove()
        }
        document.getElementById("add").onclick = function() {
            var e = document.createElement('li');
            e.innerHTML = "<input type='text' name='options[]' class='form-control add-input' placeholder='Insert your option' /> <a class='btn btn-danger' href='#' onclick='remove(this)'><i class='fa fa-minus-circle' aria-hidden='true'></i></a>";
            document.getElementById("options").appendChild(e);
        }

</script>

@stop