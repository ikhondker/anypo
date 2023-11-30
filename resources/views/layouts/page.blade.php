<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Bootstrap 5 Admin &amp; Dashboard Template">
	<meta name="author" content="Bootlab">


	<title>@yield('title', 'AnyPO.com')</title>

	<link rel="canonical" href="https://appstack.bootlab.io/index.html" />
	<link rel="shortcut icon" href="img/favicon.ico">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">

	<link href="{{asset('css/light.css')}}" rel="stylesheet">
</head>

<body>

	{{-- <div class="navbar navbar-dark bg-dark">
		<div class="container-fluid">
			<span class="navbar-text mx-auto py-0 text-white">
      			AppStack for Bootstrap v5.2.3 is out now!
    		</span>
		</div>
	</div> --}}

	<nav class="navbar navbar-expand-md navbar-light landing-navbar">
		<div class="container">
			<a class="navbar-brand landing-brand" href="#">
				<img src="{{asset('/logo/logo.png')}}" width="80px" height="80px"/> 
			</a>
			<ul class="navbar-nav ms-auto">
				<li class="nav-item d-none d-md-inline-block">
					<a class="nav-link active text-lg px-lg-3" href="{{ route('home') }}">Home</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active text-lg px-lg-3" href="{{ route('help') }}">
					<span class="d-none d-md-inline-block">Documentation</span>
					</a>
				</li>
				<li class="nav-item d-none d-md-inline-block">
					<a class="nav-link active text-lg px-lg-3" href="mailto:support@bootlab.io">Support</a>
				</li>
			</ul>
			<a href="{{ route('dashboards.index') }}" class="btn btn-lg btn-success my-2 my-sm-0 ms-3">Dashboard</a>
		</div>
	</nav>

	
	<section class="py-6 bg-white">
		<div class="container position-relative z-3">
			<div class="row">
				<div class="col-md-12 mx-auto text-center">
					<div class="row">
						<div class="col-lg-10 col-xl-9 mx-auto">
							<div class="mb-4 text-start">
								<!-- content -->
								@yield('content')
								<!-- /.content -->
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>

	

	<section class="py-6 bg-secondary">
		<div class="container position-relative z-3">

			<div class="row small">
				<div class="col-xl-3 col-lg-4 col-md-6">
					<div>
						<h3 class="text-light">Logo</h3>
						<p class="mb-30 text-light">Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad soluta facilis
						eos quia optio iusto odit atque eum tempore, quisquam officiis vero veniam hic,</p>
					</div>
				</div>
				<div class="col-xl-2 offset-xl-1 col-lg-2 col-md-6">
					<div class="">
						<h4 class="text-light">Quick Link</h4>
						<ul class="list-unstyled">
							<li><a href="#" class="text-light">Home</a></li>
							<li><a href="#" class="text-light">About Us</a></li>
							<li><a href="#" class="text-light">Service</a></li>
							<li><a href="#" class="text-light">Contact</a></li>
						</ul>
					</div>
				</div>
				<div class="col-xl-3 col-lg-3 col-md-6">
				  <div>
					<h4 class="text-light">Service</h4>
					<ul class="list-unstyled">
						<li><a href="#" class="text-light">Home</a></li>
						<li><a href="#" class="text-light">About Us</a></li>
						<li><a href="#" class="text-light">Service</a></li>
						<li><a href="#" class="text-light">Contact</a></li>
					</ul>
				  </div>
				</div>
				<div class="col-xl-3 col-lg-3 col-md-6">
					<div>
						<h4 class="text-light">Newsletter</h4>
						<div>
						<label for="Newsletter" class="form-label text-light">Subscribe To Our Newsletter</label>
						<input type="text" class="form-control" Placeholder="Enter Your Email">
						<button class="btn btn-danger mt-3">Subscribe</button>
						</div>
					</div>
				</div>
			</div>
			<div class="d-flex justify-content-center py-2">
				<div class="copyright">
				  <p class="small text-light">anypo.com is developed and maintained by <a href="#" target="_blank">HawarIT Limited</a></p>
				</div>
			</div>
		</div>
	</section>
	<script src="js/app.js"></script>
</body>

</html>