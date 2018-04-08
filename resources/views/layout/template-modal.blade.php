<div id="approveModal" class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content custom-modal-content">
    <div class="modal-header">
      <button type="button" id="reject-close" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <h4 class="modal-title" id="statusModalLabel">Approve Loan Application</h4>
    </div>
    <div class="modal-body">
      {{ Form::open(array('route' => array('officer.loan.approval'), 'method' => 'post', 'id' => 'reg-approval-form', 'class' => 'form-horizontal form-label-left')) }}
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="_status" value="approve">
          <input type="hidden" name="_transNo" id="rej_transNo">
          
          <div class="form-group">
           <p>Are you sure you want to approve this loan application?</p>
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