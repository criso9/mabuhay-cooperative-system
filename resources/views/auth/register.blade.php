@extends('layout.main')

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

  <div style="color: #333;">
    <h3 style="text-align: center;"> Member's Registration Form </h3>

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
            <td colspan="2"><input type="text" name="phone" required value="{{ old('phone') }}" class="form-control"/></td> 
            <td>Birth date <span class="req">*</span></td>
            <td colspan="2"><input type="date" name="b_date" required value="{{ old('b_date') }}" class="form-control"/></td> 
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
            <td colspan="2"><input id="referral" type="text" name="referral" value="{{ old('referral') }}" class="form-control"/></td>
            <td>Relationship</td>
            <td colspan="2">
              <select class="form-control" name="ref_relation" value="{{ old('ref_relation') }}">
                <option>Select Relationship </option>
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
            <td colspan="2"> <input type="password" name="password" required class="form-control"/></td> 
            <td>Confirm Password <span class="req">*</span></td>
            <td colspan="2"><input type="password" name="password_confirmation" placeholder="Re-type password" required class="form-control"/></td> 
          </tr>
          <tr>
            <td colspan="2">
              <button type="button" class="btn btn-default btn-block" style="width: auto;" data-toggle="modal" data-target="#termsModal">Agree with the terms and conditions</button>
              <input type="hidden" id="agree" name="agree" value="no" />
            </td>
          </tr>
          <br/>
          <tr>
            <td colspan="6" align="right" style="padding-top: 20px;">
              <button id="reg-submit" type="submit" class="btn btn-success btn-block" style="width: 201px; margin: auto;"/>Register</button>
            </td>
          </tr>
        </table>

      {{ Form::close() }}

      <!-- Modal for Terms and Conditions as a Member -->
        <div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="Terms and conditions" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h3 class="modal-title">Terms and conditions</h3>
                  </div>

                  <div class="modal-body">
                      <p>Lorem ipsum dolor sit amet, veniam numquam has te. No suas nonumes recusabo mea, est ut graeci definitiones. His ne melius vituperata scriptorem, cum paulo copiosae conclusionemque at. Facer inermis ius in, ad brute nominati referrentur vis. Dicat erant sit ex. Phaedrum imperdiet scribentur vix no, ad latine similique forensibus vel.</p>
                      <p>Dolore populo vivendum vis eu, mei quaestio liberavisse ex. Electram necessitatibus ut vel, quo at probatus oportere, molestie conclusionemque pri cu. Brute augue tincidunt vim id, ne munere fierent rationibus mei. Ut pro volutpat praesent qualisque, an iisque scripta intellegebat eam.</p>
                      <p>Lorem ipsum dolor sit amet, veniam numquam has te. No suas nonumes recusabo mea, est ut graeci definitiones. His ne melius vituperata scriptorem, cum paulo copiosae conclusionemque at. Facer inermis ius in, ad brute nominati referrentur vis. Dicat erant sit ex. Phaedrum imperdiet scribentur vix no, ad latine similique forensibus vel.</p>
                      <p>Dolore populo vivendum vis eu, mei quaestio liberavisse ex. Electram necessitatibus ut vel, quo at probatus oportere, molestie conclusionemque pri cu. Brute augue tincidunt vim id, ne munere fierent rationibus mei. Ut pro volutpat praesent qualisque, an iisque scripta intellegebat eam.</p>
                      <p>Lorem ipsum dolor sit amet, veniam numquam has te. No suas nonumes recusabo mea, est ut graeci definitiones. His ne melius vituperata scriptorem, cum paulo copiosae conclusionemque at. Facer inermis ius in, ad brute nominati referrentur vis. Dicat erant sit ex. Phaedrum imperdiet scribentur vix no, ad latine similique forensibus vel.</p>
                      <p>Dolore populo vivendum vis eu, mei quaestio liberavisse ex. Electram necessitatibus ut vel, quo at probatus oportere, molestie conclusionemque pri cu. Brute augue tincidunt vim id, ne munere fierent rationibus mei. Ut pro volutpat praesent qualisque, an iisque scripta intellegebat eam.</p>
                      <p>Lorem ipsum dolor sit amet, veniam numquam has te. No suas nonumes recusabo mea, est ut graeci definitiones. His ne melius vituperata scriptorem, cum paulo copiosae conclusionemque at. Facer inermis ius in, ad brute nominati referrentur vis. Dicat erant sit ex. Phaedrum imperdiet scribentur vix no, ad latine similique forensibus vel.</p>
                      <p>Dolore populo vivendum vis eu, mei quaestio liberavisse ex. Electram necessitatibus ut vel, quo at probatus oportere, molestie conclusionemque pri cu. Brute augue tincidunt vim id, ne munere fierent rationibus mei. Ut pro volutpat praesent qualisque, an iisque scripta intellegebat eam.</p>
                      <p>Lorem ipsum dolor sit amet, veniam numquam has te. No suas nonumes recusabo mea, est ut graeci definitiones. His ne melius vituperata scriptorem, cum paulo copiosae conclusionemque at. Facer inermis ius in, ad brute nominati referrentur vis. Dicat erant sit ex. Phaedrum imperdiet scribentur vix no, ad latine similique forensibus vel.</p>
                      <p>Dolore populo vivendum vis eu, mei quaestio liberavisse ex. Electram necessitatibus ut vel, quo at probatus oportere, molestie conclusionemque pri cu. Brute augue tincidunt vim id, ne munere fierent rationibus mei. Ut pro volutpat praesent qualisque, an iisque scripta intellegebat eam.</p>
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

  var btn = document.getElementById("agreeButton");
  
  $('#agreeButton').click(function(){
    $('#agree').val('yes');
  });

  $('#disagreeButton').click(function(){
    $('#agree').val('no');
  });

  </script>
 
@stop
