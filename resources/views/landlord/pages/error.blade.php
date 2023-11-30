@extends('layouts.landlord')
@section('title','Error')

@section('content')

	<div class="container content-space-2">
		<div class="w-lg-50 mx-lg-auto">
			<!-- Card -->
			<div class="card card-lg mb-5">
				<div class="card-body">
					<!-- Heading -->
					<div class="text-center mb-5 mb-md-7">
						<h1 class="h2 text-danger"><i class="bi bi-x-circle-fill"></i> {{ !isset($title) ? "An Error Occurred!" : $title  }}</h1>
						<p>&nbsp;</p>
						<p class="card-text">{{ !isset($msg) ? "An Error Occurred!" : $msg  }}</p>

						<p>&nbsp;</p>
						<p class="card-text">We are available 24 hours a day to assist you via our <a href="{{ config('app.url') }}">support ticket system </a> or via email at support{{ '@'.config('app.domain') }}</p>
						<a href="{{ route('welcome') }}" class="btn btn-primary">Go to Home</a>
					</div>
					<!-- End Heading -->
			</div>
			</div>
			<!-- End Card -->
		</div>
	</div>

@endsection
