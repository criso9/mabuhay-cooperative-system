<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Access Denied</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link rel="stylesheet" href="{{ asset('css/base.css') }}">  
   <link rel="stylesheet" href="{{ asset('css/main-403.css') }}">
   <link rel="stylesheet" href="{{ asset('css/vendor.css') }}">

   <script src="{{ asset('js/modernizr.js') }}"></script>
</head>
<body>

	<!-- header 
   ================================================== -->
   <header class="main-header">
   	<div class="row">
   		<div class="logo">
	         <a href="{{url('/')}}">
				@if($coop)
					{{ $coop->name }}
				@else
					[COOP Name here]
				@endif
	         </a>
	      </div>   		
   	</div>   
	
   </header> <!-- /header -->

   <!-- navigation 
   ================================================== -->
   <nav id="menu-nav-wrap">

   	<h5>Site Pages</h5>   	
		<ul class="nav-list">
			<li><a href="#" title="">Home</a></li>
			<li><a href="#" title="">About</a></li>
			<li><a href="#" title="">Portfolio</a></li>
			<li><a href="#" title="">Blog</a></li>
			<li><a href="#" title="">FAQ</a></li>					
			<li><a href="#" title="">Contact</a></li>					
		</ul>

		<h5>Some Text</h5>  
		<p>Lorem ipsum Non non Duis adipisicing pariatur eu enim Ut in aliqua dolor esse sed est in sit exercitation eiusmod aliquip consequat.</p>

	</nav>

	<!-- main content
   ================================================== -->
   <main id="main-404-content" class="main-content-static">

   	<div class="content-wrap">

		   <div class="shadow-overlay"></div>

		   <div class="main-content">
		   	<div class="row">
		   		<div class="col-twelve">
			  		
			  			<h1 class="kern-this">403 Error.</h1>
			  			<p>
						Access denied
						Full authentication is required to access this resource.
			  			</p>
			   	</div> <!-- /twelve --> 		   			
		   	</div> <!-- /row -->    		 		
		   </div> <!-- /main-content --> 

		   <footer>
		   	<div class="row">

		   		
		   			
		  			<div class="col-five tab-full bottom-links">
			   		<ul class="links">
				   		<li><a href="javascript:history.back()">Go back</a></li>
				         <li><a href="{{url('/')}}">Home page</a></li>		                    
				   	</ul>

			   	</div>   		   		

		   	</div> <!-- /row -->    		  		
		   </footer>

		</div> <!-- /content-wrap -->
   
   </main> <!-- /main-404-content -->

   <!-- Java Script
   ================================================== --> 
   <script src="js/jquery-3.2.1.min.js"></script>
   <script src="js/plugins.js"></script>
   <script src="js/main.js"></script>

</body>
</html>