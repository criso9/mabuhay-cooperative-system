<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <!-- <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'> -->
   <link href="{{ asset('css/googleapis.css') }}" rel="stylesheet" type="text/css" />
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css"> -->
  <link href="{{ asset('css/normalize.min.css') }}" rel="stylesheet" type="text/css" />
  <!-- Custom Styles-->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css" />
  <!-- <link rel="stylesheet" href="css/style.css"> -->
</head>

<body>

  <div class="form">

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
      
    <!-- <ul class="tab-group">
      <li class="tab active"><a href="#signup">Registration Form</a></li>
    </ul> -->
    
    <h1> MEMBERSHIP REGISTRATION FORM </h1>
    {{ Form::open(array('route' => 'register.post')) }}
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="top-row">
        <div class="field-wrap">
          <label>
            First Name <span class="req">*</span>
          </label>
          <input type="text" name = "f_name" required  value="{{ old('f_name') }}" /> 
        </div>

        <div class="field-wrap">
          <label>
            Middle Name
          </label>
          <input type="text" name = "m_name"  value="{{ old('m_name') }}" /> 
        </div>

        <div class="field-wrap">
          <label>
            Last Name <span class="req">*</span>
          </label>
          <input type="text" name = "l_name" required  value="{{ old('l_name') }}" /> 
        </div>

        <div class="field-wrap">
          <label>
            Contact No. <span class="req">*</span>
          </label>
          <input type="text" name="phone" required  value="{{ old('phone') }}"/>
        </div>

         <div class="field-wrap">
          <label>
            Address <span class="req">*</span>
          </label>
          <input type="text" name = "address" required  value="{{ old('address') }}" /> 
        </div>

        <div class="field-wrap">
          <label>
            Birth date (MM/DD/YYYY)<span class="req">*</span>
          </label>
          <input type="text" name = "b_date" required value="{{ old('b_date') }}"/>
        </div>


        <div class="field-wrap">
          <label>
            Gender <span class="req">*</span>
          </label>
          <input type="text" name = "gender" required value="{{ old('gender') }}"/>
        </div>

        <div class="field-wrap">
          <label>
             Email Address <span class="req">*</span>
          </label>
          <input type="email" name="email" required autocomplete="off"/>
        </div>

         <div class="field-wrap">
          <label>
            Set A Password <span class="req">*</span>
          </label>
          <input type="password" name="password" required autocomplete="off"/>
        </div>

        <div class="field-wrap">
          <label>
            Confirm Password <span class="req">*</span>
          </label>
          <input type="password" name="password_confirmation" required autocomplete="off"/>
        </div>

        <div class="field-wrap">
          <label>
            Referred by <span class="req">*</span>
          </label>
          <input type="text" name = "referral" required  value="{{ old('referral') }}" /> 
        </div>

        <div class="field-wrap">
          <label>
            Relationship <span class="req">*</span>
          </label>
          <input type="text" name = "ref_relation" required  value="{{ old('ref_relation') }}" /> 
        </div>
  
        <button type="submit" class="button button-block"/>Register</button>  
      </div>
    {{ Form::close() }}
      
  </div>

  <script src="js/jquery-3.2.1.min.js"></script>
  <script  src="js/index.js"></script>


</body>

</html>
