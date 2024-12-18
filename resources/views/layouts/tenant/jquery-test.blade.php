<!DOCTYPE html>
<html lang="en" dir="">
<head>
<!-- Required Meta Tags Always Come First -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Title -->
{{-- <title>Account: 11 Preferences | Front - Multipurpose Responsive Template</title> --}}
<title>@yield('title', 'TENANT')</title>

<!-- Favicon -->
{{-- <link rel="shortcut icon" href="./favicon.ico"> --}}
{{-- <link rel="shortcut icon" href="{{ asset('favicon.ico') }}"> --}}
<link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}">



<!-- Scripts -->
@vite(['resources/sass/app.scss', 'resources/js/app.js'])


<link href="{{asset('css/light.css')}}" rel="stylesheet">
{{-- <link rel="stylesheet" href="{{ Storage::disk('s3t')->url('css/light.css') }}"> --}}


{{--popper.js CSS example--}}
<style>
	#tooltip {
		background: #333333;
		color: white;
		font-weight: bold;
		padding: 4px 8px;
		font-size: 13px;
		border-radius: 4px;
	}
</style>

</head>

<body>

	<!-- ========== MAIN CONTENT ========== -->
	<main id="content" role="main" class="">
		 <!-- content -->
		 @yield('content')
		 <!-- /.content -->

		<script type="module">
			@yield('javascript')
		</script>

	</main>
	<!-- ========== END MAIN CONTENT ========== -->
	<script src="{{asset( 'js/app.js' )}}"></script>
	{{-- <script	src="{{ Storage::disk('s3t')->url('js/app.js') }}"></script> --}}


</body>
</html>
