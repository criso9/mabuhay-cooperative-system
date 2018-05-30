@extends('layout.main')

@section('breadcrumb')
  <li><a href="{{url('/')}}">Home</a></li>
  <li>Registration</li>
@stop

@section('content')

  @if (count($errors) > 0)
      <div class="alert alert-danger">
          <strong>Whoops!</strong> There were some problems with your input.<br>
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

  <div style="margin-top: 130px;color: #333;">
    <h3 style="text-align: center;"> Member's Registration Form</h3>

    <div>
      {{ Form::open(array('route' => 'register.post', 'id' => 'registrationForm')) }}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <table class="reg-form">
          <tr>
            <td>Last name <span class="req">*</span></td>
            <td><input type="text" name="l_name" required value="{{ old('l_name') }}" class="form-control"/> </td> 
            <td>First name <span class="req">*</span></td>
            <td><input type="text" name="f_name" required value="{{ old('f_name') }}" class="form-control"/></td>
            <td>Middle name</td>
            <td><input type="text" name="m_name" value="{{ old('m_name') }}" class="form-control"/></td>
          </tr>
          <tr>
            <td>Complete Address <span class="req">*</span></td>
            <td colspan="5"><input type="text" name ="address" required  id="c_add" style="width: 100%;" value="{{ old('address') }}" class="form-control" /></td>
          </tr>
          <tr>
            <td>Contact No. <span class="req">*</span></td>
            <td colspan="2"><input type="text" name="phone" id="phone" required value="{{ old('phone') }}" class="form-control"/></td> 
            <td>Birth date <span class="req">*</span></td>
            <td colspan="2"><input type="date" name="b_date" required value="{{ old('b_date') }}" class="form-control" /></td> 
          </tr>
          <tr>
            <td>Gender <span class="req">*</span></td>
            <td colspan="2"> 
              <select  class="form-control" name="gender" required value="{{ old('gender') }}">
                <option>Select Gender</option>
                <option>Male</option>
                <option>Female</option>
              </select>
            </td>
            <td>Civil Status <span class="req">*</span></td>
            <td colspan="2">
              <select  class="form-control" name="civil_status" required value="{{ old('civil_status') }}">
                <option>Select Status</option>
                <option>Single</option>
                <option>Married</option>
                <option>Separated</option>
                <option>Widowed</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>Referred by</td>
            <td colspan="2"><input id="referral" type="text" name="referral" value="{{ old('referral') }}" class="form-control" onchange="refRelationship(this)" /></td>
            <td id="ref_relation_label">Relationship </td>
            <td colspan="2">
              <select class="form-control" name="ref_relation" id="ref_relation" value="{{ old('ref_relation') }}" disabled>
                <option value="select">Select Relationship </option>
                <option>Family</option>
                <option>Friends</option>
                <option>Classmate/Batchmate</option>
                <option>Co-worker</option>
                <option>Friends of Friends</option>
              </select> 
            </td>
          </tr>
          <tr>
            <td>Email Address <span class="req">*</span></td>
            <td colspan="5"><input type="text" placeholder="ex@example.com" name="email" id="email_add" required class="form-control"/></td>
          </tr>
          <tr>
            <td>Password <span class="req">*</span></td>
            <td colspan="2"> <input type="password" name="password" required class="form-control" placeholder="Minimum of 8 characters" /></td> 
            <td>Confirm Password <span class="req">*</span></td>
            <td colspan="2"><input type="password" name="password_confirmation" placeholder="Re-type password" required class="form-control"/></td> 
          </tr>
          <tr>
            <td colspan="2">
              <button type="button" class="btn btn-default btn-block" style="width: auto;" data-toggle="modal" data-target="#termsModal">Agree with the terms and conditions</button>
              <input type="hidden" id="agree" name="agree" value="no" />
              <small><span id="termsNote" style="color: red;">You must agree with the terms and conditions</span></small>
            </td>
          </tr>
          <br/>
          <tr>
            <td colspan="6" align="right" style="padding-top: 20px;">
              <button id="reg-submit" type="submit" class="btn btn-success btn-block" style="width: 201px; margin: auto;">Register</button>
            </td>
          </tr>
        </table>

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
      element.value = 'select';

      document.getElementById("ref_relation").required = true;
      document.getElementById("ref_relation").disabled=false;
     
      var span = document.createElement('span');
      span.className = 'req';

      document.getElementById('ref_relation_label').appendChild(span);
    }else{
      var element = document.getElementById('ref_relation');
      element.value = 'select';
      
      document.getElementById("ref_relation").required = false;
      document.getElementById("ref_relation").disabled = true;
     
      var span = document.createElement('span');
      span.className = '';

      document.getElementById('ref_relation_label').appendChild(span);
    }
  }

  </script>
 
@stop
