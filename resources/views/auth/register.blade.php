@extends('layout.main')

@section('breadcrumb')
<li><a href="{{url('/')}}">Home</a></li>
<li>Registration</li>
@stop

@section('content')

@if (count($errors) > 0)
<div class="alert alert-danger" style="margin-top: 125px;margin-bottom: -110px;">
  <strong>Whoops!</strong> There were some problems with your input.<br>
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif

<div class="div-main-reg-form">
  <h3 style="text-align: center;"> Member's Registration Form</h3>

  <div style="margin-top: 30px;">
    {{ Form::open(array('route' => 'register.post', 'id' => 'registrationForm')) }}
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="reg-form">
      <div class="row">
        <div class="col-2-label">Last name <span class="req">*</span></div>
        <div class="col-2-input"><input type="text" name="l_name" required value="{{ old('l_name') }}" class="form-control"/> </div> 
        <div class="col-2-label">First name <span class="req">*</span></div>
        <div class="col-2-input"><input type="text" name="f_name" required value="{{ old('f_name') }}" class="form-control"/></div>
        <div class="col-2-label">Middle name</div>
        <div class="col-2-input"><input type="text" name="m_name" value="{{ old('m_name') }}" class="form-control"/></div>
      </div>
      <div class="row">
        <div class="col-2-label">Complete Address <span class="req">*</span></div>
        <div colspan="5" class="col-10-input"><input type="text" name ="address" required  id="c_add" style="width: 100%;" value="{{ old('address') }}" class="form-control" /></div>
      </div>
      <div class="row">
        <div class="col-2-label">Contact No. <span class="req">*</span></div>
        <div colspan="2" class="col-4-input"><input type="text" name="phone" id="phone" required value="{{ old('phone') }}" class="form-control"/></div> 
        <div class="col-2-label">Birth date <span class="req">*</span></div>
        <div colspan="2" class="col-4-input">
          <div class="input-group date" style="width:100%;">
            <input type="text" class="form-control" id="b_date" name="b_date" required />
            <span class="input-group-addon">
              <span class="glyphicon glyphicon-calendar"></span>
            </span>
          </div>
        </div> 
      </div>
      <div class="row">
        <div class="col-2-label">Gender <span class="req">*</span></div>
        <div colspan="2" class="col-4-input"> 
          <select  class="form-control" name="gender" required>
            @if (count($gender) > 1)
            @foreach($gender as $g)
            <option value="{{$g}}" {{ $g == old('gender') ? "selected" : "" }}>{{$g}}</option>
            @endforeach
            @elseif (count($gender) > 0)
            <option value="{{old('gender')}}">{{old('gender')}}</option>
            @endif
          </select>
        </div>
        <div class="col-2-label">Civil Status <span class="req">*</span></div>
        <div colspan="2" class="col-4-input">
          <select  class="form-control" name="civil_status" required">
            @if (count($civilstat) > 1)
            @foreach($civilstat as $cs)
            <option value="{{$cs}}" {{$cs == old('civil_status') ? "selected" : ""}}>{{$cs}}</option>
            @endforeach
            @elseif (count($civilstat) > 0)
            <option value="{{old('civil_status')}}">{{old('civil_status')}}</option>
            @endif
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col-2-label">Referred by</div>
        <div colspan="2" class="col-4-input"><input id="referral" type="text" name="referral" value="{{ old('referral') }}" class="form-control" onchange="refRelationship(this)" /></div>
        <div id="ref_relation_label" class="col-2-label">Relationship </div>
        <div colspan="2" class="col-4-input">
          <select class="form-control" name="ref_relation" id="ref_relation" disabled>
            @if (count($refRelation) > 1)
            @foreach($refRelation as $rr)
            <option value="{{$rr}}" {{$rr == old('ref_relation') ? "selected" : ""}}>{{$rr}}</option>
            @endforeach
            @elseif (count($refRelation) > 0)
            <option value="{{old('ref_relation')}}">{{old('ref_relation')}}</option>
            @endif
          </select> 
        </div>
      </div>
      <div class="row">
        <div class="col-2-label">Email Address <span class="req">*</span></div>
        <div colspan="5" class="col-10-input"><input type="text" placeholder="ex@example.com" name="email" id="email_add" required class="form-control"/></div>
      </div>
      <div class="row">
        <div class="col-2-label">Password <span class="req">*</span></div>
        <div colspan="2" class="col-4-input"> <input type="password" name="password" required class="form-control" placeholder="Minimum of 8 characters" /></div> 
        <div class="col-2-label">Confirm Password <span class="req">*</span></div>
        <div colspan="2" class="col-4-input"><input type="password" name="password_confirmation" placeholder="Re-type password" required class="form-control"/></div> 
      </div>
      <div class="row agree-btn">
        <div colspan="2" style="padding-top: 15px;">
          <button type="button" class="btn btn-default btn-block" style="width: auto;" data-toggle="modal" data-target="#termsModal">Agree with the terms and conditions</button>
          <input type="hidden" id="agree" name="agree" value="no" />
          <small><span id="termsNote" style="color: red;">You must agree with the terms and conditions</span></small>
        </div>
      </div>
      <div>
        <div colspan="6" align="right" style="padding-top: 15px;">
          <button id="reg-submit" type="submit" class="btn btn-success btn-block" style="width: 201px; margin: auto;">Register</button>
        </div>
      </div>
    </div>

    {{ Form::close() }}

    <!-- Modal for Terms and Conditions as a Member -->
    <div class="modal fade custom-modal" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="Terms and conditions" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content custom-modal-content">
          <div class="modal-header">
            <button type="button" id="reject-close" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">Terms and conditions</h4>
          </div>

          <div class="modal-body">
            <p style="text-align: center;"><b>Mabuhay BNHS Cooperative</b></p>
            <p>To all board and coop members, this is our Rules and Regulations.</p>
            <p>1. In every meeting of our Cooperative, we need to attend.</p>
            <p>2. We all need to be updated for paying our 'monthly savings' which is P300 per month.</p>
            <p>3. Members can apply for a loan based on the amount of the savings.</p>
            <p>4. We encourage to pay the 'Damayan' and 'Share Capital' in the cooperative.</p>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="agreeButton" data-dismiss="modal">Agree</button>
            <button type="button" class="btn btn-default" id="disagreeButton" data-dismiss="modal">Disagree</button>
          </div>
        </div>
      </div>
    </div>

  </div>

</div> 

<script src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#b_date').datetimepicker({
      format: "MMMM DD, YYYY",
      maxDate: moment().add(1, 'h'),
      date: "{{ old('b_date') }}"
    });

    if($('#referral').val() != ''){

      document.getElementById("ref_relation").required = true;
      document.getElementById("ref_relation").disabled=false;

      var span = document.createElement('span');
      span.className = 'req';

      document.getElementById('ref_relation_label').appendChild(span);
    }else{

      document.getElementById("ref_relation").required = false;
      document.getElementById("ref_relation").disabled = true;

      var span = document.createElement('span');
      span.className = '';

      document.getElementById('ref_relation_label').appendChild(span);
    }

    var phone = [{ "mask": "0\\9#########"}, { "mask": "09#########"}];
    
    $('#phone').inputmask({ 
      mask: phone, 
      greedy: false, 
      definitions: { '#': { validator: "[0-9]", cardinality: 1}} });
  });

  var btn = document.getElementById("agreeButton");
  
  $('#agreeButton').click(function(){
    $('#agree').val('yes');
    document.getElementById('termsNote').innerHTML = "Agreed on terms and conditions";
    document.getElementById('termsNote').style.color = "green";
  });

  $('#disagreeButton').click(function(){
    $('#agree').val('no');
    document.getElementById('termsNote').innerHTML = "You must agree with the terms and conditions";
    document.getElementById('termsNote').style.color = "red";
  });

  function refRelationship(val) {
    if(val.value != ''){
      var element = document.getElementById('ref_relation');
      element.value = 'Select Relationship';

      document.getElementById("ref_relation").required = true;
      document.getElementById("ref_relation").disabled=false;

      var span = document.createElement('span');
      span.className = 'req';

      document.getElementById('ref_relation_label').appendChild(span);
    }else{
      var element = document.getElementById('ref_relation');
      element.value = 'Select Relationship';
      
      document.getElementById("ref_relation").required = false;
      document.getElementById("ref_relation").disabled = true;

      var span = document.createElement('span');
      span.className = '';

      document.getElementById('ref_relation_label').appendChild(span);
    }
  }

</script>

@stop
