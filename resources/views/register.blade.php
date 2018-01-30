<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Sign-Up/Login Form</title>
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
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
      
    <ul class="tab-group">
      <li class="tab active"><a href="#signup">Registration Form</a></li>
    </ul>
    
    {{ Form::open(array('route' => 'register.post')) }}
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="top-row">
        <div class="field-wrap">
          <label>
            Full Name <span class="req">*</span>
          </label>
          <input type="text" name = "f_name" required  value="{{ old('f_name') }}" /> 
        </div>

        <div class="field-wrap">
          <label>
            Gender
          </label>
          <input type="text" name = "gender"/>
        </div>

        <div class="field-wrap">
          <label>
            Birth date (MM/DD/YYYY)<span class="req">*</span>
          </label>
          <input type="text" name = "bday" required/>
        </div>  
      
        <div class="field-wrap">
          <label>
            Age<span class="req">*</span>
          </label>
          <input type="text" name ="age" required/>
        </div>

        <div class="field-wrap">
          <label>
            Civil Status<!-- <span class="req">*</span> -->
          </label>
          <input type="text" name="civilstats"/>
        </div>

        <div class="field-wrap">
          <label>
            Birth Place<!-- span class="req">*</span> -->
          </label>
          <input type="text" name= "bplace"/>
        </div>

        <div class="field-wrap">
          <label>
            Contact No.
          </label>
          <input type="text" name="cnumber"/>
        </div>
          
        <div class="field-wrap">
          <label>
             Email Address <span class="req">*</span>
          </label>
          <input type="email" name="emailadd" required autocomplete="off"/>
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

        <button type="submit" class="button button-block"/>Register</button>  
      </div>
    {{ Form::close() }}
      
  </div>

  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script  src="js/index.js"></script>


</body>

</html>
