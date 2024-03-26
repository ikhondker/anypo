<!DOCTYPE html>
<html lang="en" dir="">
<head>
<!-- Required Meta Tags Always Come First -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Title -->
{{-- <title>Account: 11 Preferences | Front - Multipurpose Responsive Template</title> --}}
<title>@yield('title', 'AnyPO.com')</title>

<!-- Favicon -->
{{-- <link rel="shortcut icon" href="./favicon.ico"> --}}
{{-- <link rel="shortcut icon" href="{{ asset('favicon.ico') }}"> --}}
<link rel="shortcut icon" type="image/png" href="{{ asset('favicon.png') }}">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script> --}}

{{-- <script	src="https://code.jquery.com/jquery-3.7.0.min.js"
	integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
	crossorigin="anonymous">
</script> --}}

{{-- jquery v3.7.1 --}}
{{-- <script	src="{{ asset('/assets/js/jquery-3.7.1.min.js') }}"></script> --}}
{{-- <script	src="{{ Storage::disk('s3l')->url('js/jquery-3.7.1.min.js') }}"></script> --}}

<!-- Scripts -->
@vite(['resources/sass/app.scss', 'resources/js/app.js'])

{{-- sweetalert2 v11.7.27 --}}
{{-- <script	src="{{asset('/assets/js/sweetalert2.min.js')}}"></script> --}}
{{-- <script	src="{{ Storage::disk('s3l')->url('js/sweetalert2.min.js') }}"></script> --}}
{{-- <link rel="stylesheet" href="{{asset('/assets/css/sweetalert2.min.css')}}"> --}}
{{-- <link rel="stylesheet" href="{{ Storage::disk('s3l')->url('css/sweetalert2.min.css') }}"> --}}

{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.all.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.min.css" > --}}
		
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



</body>
</html>
