<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="ANYPO.NET - Control Expenses ">
	<meta name="author" content="Iqbal H Khondker">

	<title>@yield('title', 'anypo.net')</title>

	{{-- <link rel="canonical" href="https://appstack.bootlab.io/pages-sign-in.html" /> --}}
	{{-- TODO --}}
	<link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}">

	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">

	<!-- Choose your preferred color scheme -->
	{{-- <link href="{{asset('css/light.css')}}" rel="stylesheet"> --}}
	<link rel="stylesheet" href="{{ Storage::disk('s3t')->url('css/light.css') }}">

</head>
<!--
  HOW TO USE:
  data-theme: default (default), dark, light
  data-layout: fluid (default), boxed
  data-sidebar-position: left (default), right
  data-sidebar-behavior: sticky (default), fixed, compact
-->

<body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="sticky">
	<div class="main d-flex justify-content-center w-100">
		<main class="content d-flex p-0">
			<div class="container d-flex flex-column">
				<div class="row h-100">
					<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
						<div class="d-table-cell align-middle">

							<!-- content -->
							@yield('content')
							<!-- /.content -->

						</div>
					</div>
				</div>
			</div>
		</main>
	</div>

	{{-- <script src="{{asset('js/app.js')}}"></script> --}}
	<script	src="{{ Storage::disk('s3t')->url('js/app.js') }}"></script>

</body>

</html>
