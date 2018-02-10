<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{ asset('images/icons/favicon.ico') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.min.css') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/material-design-iconic-font.min.css') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/animate.css') }}"/>
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('css/hamburgers.min.css') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/animsition.min.css') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/select2.min.css') }}"/>
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('css/daterangepicker.css') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}"/>
<!--===============================================================================================-->
</head>
<body>
	<div class="limiter">
		<div>
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
	  	</div>

		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="{{ route('login.post') }}" method="POST">
					 {{ csrf_field() }}
					<div class="login100-form-logo">
						<!-- <i class="zmdi zmdi-landscape"></i> -->
						@if($coop)
		                	<img src="/uploads/{{ $coop->logo }}"/>
		                @else
		                    <img src="/images/na.png"/>
		                @endif
					</div>

					<span class="login100-form-title p-b-34 p-t-27">
						Log in
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Enter email">
						<input class="input100" type="text" name="email" placeholder="Email">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<!-- <div class="contact100-form-checkbox">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div> -->

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center" style="padding-top: 35px;">
						<span style="font-family: Poppins-Regular;color: #e5e5e5;font-size: 15px;">
							Create an account? 
							<a style="color: #48B0F7;" href="{{url('/register')}}">
								Sign Up Here
							</a>
						</span>
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('js/popper.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('js/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('js/moment.min.js') }}"></script>
	<script src="{{ asset('js/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('js/countdowntime.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('js/main.js') }}"></script>

</body>
</html>