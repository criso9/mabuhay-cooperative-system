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
        <div>
          <div style="float: right;"><a href="{{route('admin.poll.create')}}" class="btn btn-round btn-info">Add Poll</a></div>
        </div>
        <div style="clear:both;"></div>
        <br/>

        @if($polls->count() >= 1)
            <table id="poll-list" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Question</th>
                    <th>Options</th>
                    <th>Votes</th>
                    <th>State</th>
                    <th>Edit</th>
                    <th>Add Options</th>
                    <th>Remove Options</th>
                    <th>Remove</th>
                    <th>Lock/Unlock</th>
                </tr>
                </thead>
                <tbody>
                @forelse($polls as $poll)
                    <tr>
                        <th scope="row">{{ $poll->id }}</th>
                        <td>{{ $poll->question }}</td>
                        <td>{{ $poll->options_count }}</td>
                        <td>{{ $poll->votes_count }}</td>
                        <td>
                            @if($poll->isLocked())
                                <span class="label label-danger">Closed</span>
                            @else
                                <span class="label label-success">Open</span>
                            @endif
                        </td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('admin.poll.edit', $poll->id) }}">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-success btn-sm" href="{{ route('admin.poll.options.push', $poll->id) }}">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                            </a>
                        </td>
                        <td>
                            <a class="btn btn-warning btn-sm" href="{{ route('admin.poll.options.remove', $poll->id) }}">
                                <i class="fa fa-minus-circle" aria-hidden="true"></i>
                            </a>
                        </td>
                        <td>
                            <form action="{{ route('admin.poll.remove', $poll->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa fa-times" aria-hidden="true"></i>
                                </button>
                            </form>
                        </td>
                        <td>
                            @php $route = $poll->isLocked()? 'admin.poll.unlock': 'admin.poll.lock' @endphp
                            @php $fa = $poll->isLocked()? 'fa fa-unlock': 'fa fa-lock' @endphp
                            <form action="{{ route($route, $poll->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('PATCH') }}
                                <button type="submit" class="btn btn-sm">
                                    <i class="{{ $fa }}" aria-hidden="true"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Question</th>
                    <th>Options</th>
                    <th>Votes</th>
                    <th>State</th>
                    <th>Edit</th>
                    <th>Add Options</th>
                    <th>Remove Options</th>
                    <th>Remove</th>
                    <th>Lock/Unlock</th>
                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="10" align="center">No poll has been found</td>
                    </tr>
                </tbody>
            </table>
        @endif
        {{ $polls->links() }}       
      
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

    $('#poll-list').DataTable({
        "order": [[ 0, "desc" ]],
        "columnDefs": [
        { "orderable": false, "targets": 4 },
        { "orderable": false, "targets": 5 },
        { "orderable": false, "targets": 6 },
        { "orderable": false, "targets": 7 },
        { "orderable": false, "targets": 8 },
        { "orderable": false, "targets": 9 }
      ]
      });
   
  });

</script>

@stop