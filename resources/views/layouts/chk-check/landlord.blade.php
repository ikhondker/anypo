<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
		@include('landlord.includes.head')
</head>

<body>
	
	<x-landlord.nav-bar />

	<!-- ========== MAIN CONTENT ========== -->
	<main id="content" role="main" class="">

		<!-- Form Success Message Box -->
		@if (session('success'))
			<x-landlord.alert-success message="{{ session('success') }}" />
		@endif
		<!-- Form Error Message Box (including Form Validation ) -->
		@if (session('error') || $errors->any())
			<x-landlord.alert-error message="{{ session('error') }}" />
		@endif

		<!-- content -->
		@yield('content')
		<!-- /.content -->

	</main>
	<!-- ========== END MAIN CONTENT ========== -->

	<!-- ========== FOOTER ========== -->
	@include('landlord.includes.footer')
	<!-- ========== END FOOTER ========== -->

</body>
</html>
