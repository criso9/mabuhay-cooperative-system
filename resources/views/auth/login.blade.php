@extends('layout.main')

@section('content')
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

		<div class="container-login100" style="background-image:url({{url('/images/bg-01.jpg')}});">
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

	<!-- Modal for Terms and Conditions as a Member -->
    <div class="modal fade" id="msgModal" tabindex="-1" role="dialog" aria-labelledby="Message" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <h3 class="modal-title">Message</h3>
              </div>

              <div class="modal-body">
              	 <br/>
                 <p>{{ Session::get('flash_message') }}</p>
                 <br/>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="ok-button" data-dismiss="modal">OK</button>
              </div>
          </div>
      </div>
  </div>
	
	<script src="{{ asset('js/jquery.min.js') }}"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			@if (Session::has('flash_message'))
		      $('#msgModal').modal('show');
		      console.log('gumana!');
		    @endif
		});
	</script>

@stop