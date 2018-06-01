@extends('layout.panel')

@section('title')
Business List
@stop

@section('content')

<div class="flex-center position-ref full-height">
  <div class="custom-breadcrumb">
    {!! Breadcrumbs::render() !!}
  </div>
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">

        <h2>List of Business <small></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div style="clear:both;"></div>
          {{ Form::open(array('route' => 'officer.business.index.filter', 'method' => 'post', 'class' => 'form-horizontal form-label-left pending-type business-list', 'id' => 'off-business', 'style' => 'width: 240px;float: right; right: -15px;top: 0px;')) }}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" style="font-weight: normal;margin-right: -10px;">Status:</label>
              <div class="col-md-9 col-sm-9 col-xs-12">
                <select id="status-type" name="statusFilter" class="form-control" style="height: 30.5px;font-size: 12px;" onchange="this.form.submit()">
                    <option value="all" {{ 'all' == $status_filter ? "selected" : "" }}>All</option>
                    @foreach($stat as $s)
                      <option value="{{$s}}" {{ $s == $status_filter ? "selected" : "" }}>{{$s}}</option>
                    @endforeach
                </select>
              </div>
            </div>
          {{ Form::close() }}
        <div>
          <table id="business-list" class="table table-striped table-bordered" style="font-size: 13px;">
            <thead>
            <tr>
              <td>Name</td>
              <td>Description</td>
              <td>Status</td>
              <td>Capital</td>
              <td>Income</td>
              <td>Profit</td>
              <td>Date Started</td>
              <td>Added By</td>

              @if($status_filter != 'Active')
                <td>Date Ended</td>
                <td>Removed By</td>
                <td>Remarks</td>
              @endif
            </tr>
            </thead>
            <tbody>
              @if ($business->count() > 1)
                @foreach($business as $b)
                  <tr>
                    <td>{{$b->name}}</td>
                    <td>{{$b->description}}</td>
                    <td>{{$b->status}}</td>
                    <td>{{$b->capital}}</td>
                    <td>{{$b->income}}</td>
                    <td>{{$b->profit}}</td>
                    <td>{{$b->date_started}}</td>
                    <td>{{$b->added_by}}</td>

                    @if($status_filter != 'Active')
                      <td>{{$b->date_ended}}</td>
                      <td>{{$b->removed_by}}</td>
                      <td>{{$b->remarks}}</td>
                    @endif
                  </tr>
                @endforeach
              @elseif ($business->count() > 0)
                <tr>
                  <td>{{$business[0]->name}}</td>
                  <td>{{$business[0]->description}}</td>
                  <td>{{$business[0]->status}}</td>
                  <td>{{$business[0]->capital}}</td>
                  <td>{{$business[0]->income}}</td>
                  <td>{{$business[0]->profit}}</td>
                  <td>{{$business[0]->date_started}}</td>
                  <td>{{$business[0]->added_by}}</td>

                  @if($status_filter != 'Active')
                    <td>{{$business[0]->date_ended}}</td>
                    <td>{{$business[0]->removed_by}}</td>
                    <td>{{$business[0]->remarks}}</td>
                  @endif
                </tr>
              @endif
            </tbody>
          </table>
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

    @if ($status_filter == 'Active')
      $('#business-list').DataTable({
      });
    @else
      $('#business-list').DataTable({
      });
    @endif


  });


</script>

@stop