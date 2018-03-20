@extends('layout.panel')

@section('title')
Pending for Approval
@stop

@section('content')

<div class="flex-center position-ref full-height">
  <div class="col-md-12 col-sm-12 col-xs-12">
    <div class="x_panel">
      <div class="x_title">

        <h2>Users Pending for Approval <small></small></h2>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
      <br/>

      {{ Form::open(array('route' => 'admin.pending.index.type', 'method' => 'post', 'class' => 'form-horizontal form-label-left pending-type', 'style' => 'width: 22%;float: right; right: -15px;')) }}
        
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" style="font-weight: normal;margin-right: -10px;">Type:</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <select id="pending-type" name="type" class="form-control" style="height: 30.5px;font-size: 12px;" onchange="this.form.submit()">
                  <option value="pending" {{ 'pending' == $selected_type ? "selected" : "" }}>Pending for Approval</option>
                  <option value="waiting" {{ 'waiting' == $selected_type ? "selected" : "" }}>Waiting for Confirmation</option>
              </select>
            </div>
          </div>
        </form>

        <div>
            <table id="pending-users" class="table table-striped table-bordered">
              <thead>
              <tr>
                <!-- <td colspan="2" align="center">Action</td> -->
                <td>Approve</td>
                <td>Reject</td>
                <td>Full Name</td>
                <td>Address</td>
                <td>Phone</td>
                <td>Email</td>
                <td>Birthdate</td>
                <td>Gender</td>
                <td>Civil Status</td>
                <td>Referred By</td>
                <td>Relationship</td>
                <td>Date Registered</td>
                <td>Status</td>
              </tr>
              </thead>
              <tbody>
                @if ($users->count() > 1)
                  @foreach($users as $u)
                    <tr>
                      <td align="middle">
                          <a href="" id="approveBtn" data-toggle="modal" data-target = "#approveModal" onclick="approveStatus('{{$u->id}}')"><img id="{{$u->id}}-approve" src="/images/approve.png" style="width:25px; height: 25px;" onmouseover="onHover('{{$u->id}}-approve');" onmouseout="offHover('{{$u->id}}-approve');"/></a>
                      </td>
                      <td align="middle">
                        <a href="" id="rejectBtn" data-toggle="modal" data-target = "#rejectModal" onclick="rejectStatus('{{$u->id}}')"><img id="{{$u->id}}-reject" src="/images/reject.png" style="width:25px; height: 25px;" onmouseover="rejHover('{{$u->id}}-reject');" onmouseout="rejOffHover('{{$u->id}}-reject');"/></a>
                      </td>
                      <td>{{$u->fullName}}</td>
                      <td>{{$u->address}}</td>
                      <td>{{$u->phone}}</td>
                      <td>{{$u->email}}</td>
                      <td>{{$u->b_date}}</td>
                      <td>{{$u->gender}}</td>
                      <td>{{$u->civil_status}}</td>
                      <td>{{$u->referral}}</td>
                      <td>{{$u->ref_relation}}</td>
                      <td>{{$u->created_at}}</td>
                      <td>{{$u->status}}</td>
                    </tr>
                  @endforeach
                @elseif ($users->count() > 0)
                  <tr>
                    <td align="middle">
                      <a href="" id="approveBtn" data-toggle="modal" data-target = "#approveModal" onclick="approveStatus('{{$users[0]->id}}')"><img id="{{$users[0]->id}}-approve" src="/images/approve.png" style="width:25px; height: 25px;" onmouseover="onHover('{{$users[0]->id}}-approve');" onmouseout="offHover('{{$users[0]->id}}-approve');"/></a>
                      </td>
                      <td align="middle">
                        <a href="" id="rejectBtn" data-toggle="modal" data-target = "#rejectModal" onclick="rejectStatus('{{$users[0]->id}}')"><img id="{{$users[0]->id}}-reject" src="/images/reject.png" style="width:25px; height: 25px;" onmouseover="rejHover('{{$users[0]->id}}-reject');" onmouseout="rejOffHover('{{$users[0]->id}}-reject');"/></a>
                      </td>
                      <td>{{$users[0]->fullName}}</td>
                      <td>{{$users[0]->address}}</td>
                      <td>{{$users[0]->phone}}</td>
                      <td>{{$users[0]->email}}</td>
                      <td>{{$users[0]->b_date}}</td>
                      <td>{{$users[0]->gender}}</td>
                      <td>{{$users[0]->civil_status}}</td>
                      <td>{{$users[0]->referral}}</td>
                      <td>{{$users[0]->ref_relation}}</td>
                      <td>{{$users[0]->created_at}}</td>
                      <td>{{$users[0]->status}}</td>
                  </tr>
                @endif
              </tbody>
            </table>
        </div>
        
        <div id="approveModal" class="modal custom-modal">
          <div class="modal-content custom-modal-content">
            <div class="modal-header">
              <button type="button" id="approve-close" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title" id="statusModalLabel">Approve Membership</h4>
            </div>
            <div class="modal-body">
              {{ Form::open(array('route' => array('admin.email.approval'), 'method' => 'post', 'id' => 'reg-approval-form', 'class' => 'form-horizontal form-label-left')) }}
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" name="_status" value="approve">
                  <input type="hidden" name="_userid" id="app_userid">
                  
                  <div class="form-group">
                    <p>Are you sure you want to approve it?</p>
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


        <div id="rejectModal" class="modal custom-modal">
          <div class="modal-content custom-modal-content">
            <div class="modal-header">
              <button type="button" id="reject-close" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title" id="statusModalLabel">Reject Membership</h4>
            </div>
            <div class="modal-body">
              {{ Form::open(array('route' => array('admin.email.approval'), 'method' => 'post', 'id' => 'reg-approval-form', 'class' => 'form-horizontal form-label-left')) }}
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  <input type="hidden" name="_status" value="reject">
                  <input type="hidden" name="_userid" id="rej_userid">
                  
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


    $('#pending-users').DataTable({
      // dom: 'B<"clear">lfrtip',
      // buttons: [
      //   'copy', 'csv', 'excel', 'pdf', 'print'
      // ],
      fixedHeader: {
        header: true,
        footer: false
      },
      "order": [[ 11, "desc" ]],
      "columnDefs": [
        { "orderable": false, "targets": 0 },
        { "orderable": false, "targets": 1 }
      ]
    });
   });

    function onHover(idVal)
    {
        $("#" + idVal).attr('src', '/images/approve-hover.png');
    }

    function offHover(idVal)
    {
        $("#" + idVal).attr('src', '/images/approve.png');
    }

    function rejHover(idVals)
    {
        $("#" + idVals).attr('src', '/images/reject-hover.png');
    }

    function rejOffHover(idVals)
    {
        $("#" + idVals).attr('src', '/images/reject.png');
    }


  //MODAL
  // Get the modal
  var modalApprove = document.getElementById('approveModal');
  var modalReject = document.getElementById('rejectModal');

  // Get the <span> element that closes the modal
  var spanApprove = document.getElementById("approve-close");
  var spanReject = document.getElementById("reject-close");
  //open Modal
  function approveStatus(id) {
      modalApprove.style.display = "block";

      $('#app_userid').val(id);
  }

  function rejectStatus(id) {
      modalReject.style.display = "block";

      $('#rej_userid').val(id);
  }

  // When the user clicks on <span> (x), close the modal
  spanApprove.onclick = function() {
      modalApprove.style.display = "none";
  }
  spanReject.onclick = function() {
      modalReject.style.display = "none";
  }

  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
      if (event.target == modalApprove) {
          modalApprove.style.display = "none";
          modalReject.style.display = "none";
      }
  }
</script>

@stop