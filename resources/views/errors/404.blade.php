@extends('layouts.landlord.error')
@section('title', 'Error - 404')
@section('breadcrumb', 'Error - 404')

@section('content')

	<h1 class="display-1 fw-bold">404</h1>
	<p class="h2">Page not found.</p>
	<p class="lead fw-normal mt-3 mb-4">The page you are looking for might have been removed.</p>
	<div class="mb-4">
		<p class="">If you think this is a problem with us, please <a class="link" href="{{ route('contact-us') }}">tell us</a>.</p>
	</div>
	<a href="{{ route('home') }}" class="btn btn-primary btn-lg">Return to website</a>

@endsection
