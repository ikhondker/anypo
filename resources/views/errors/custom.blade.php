@extends('layouts.landlord.error')
@section('title', 'Error - 500')
@section('breadcrumb', 'Error - 500')

@section('content')

	<h1 class="display-1 fw-bold text-danger">500</h1>
	<p class="h2">Unexpected Error.</p>
	<p class="lead fw-normal mt-3 mb-4">An unexpected error has occurred.</p>
	<div class="mb-4">
		<p class="">This is a problem with us, please <a class="link" href="{{ route('contact-us') }}">tell us</a>.</p>
	</div>
	<a href="{{ route('home') }}" class="btn btn-primary btn-lg">Return to website</a>

@endsection
