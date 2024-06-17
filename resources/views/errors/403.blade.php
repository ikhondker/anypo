@extends('layouts.landlord.error')
@section('title', 'Error - 403')
@section('breadcrumb', 'Error - 403')

@section('content')

	<h1 class="display-1 fw-bold">403</h1>
	<p class="h2">Page Forbidden.</p>
	<p class="lead fw-normal mt-3 mb-4">We are sorry, but you do not have permission to view this page using the credentials that you supplied.</p>
	<div class="mb-4">
		<p class="">If you think this is a problem with us, please <a class="link" href="{{ route('contact-us') }}">tell us</a>.</p>
	</div>
	<a href="{{ route('home') }}" class="btn btn-primary btn-lg">Return to website</a>

@endsection
