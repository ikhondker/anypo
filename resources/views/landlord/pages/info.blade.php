@extends('layouts.landlord')
@section('title','Information')

@section('content')

	<div class="container content-space-2">
		<div class="w-lg-50 mx-lg-auto">
			<!-- Card -->
			<div class="card card-lg mb-5">
				<div class="card-body">
					<!-- Heading -->
					<div class="text-center mb-5 mb-md-7">
						<h1 class="h2 text-info"><i class="bi bi-check-circle-fill"></i> {{ !isset($title) ? "Information!" : $title  }}</h1>
												{{-- <h3 class="h3">{{ !isset($msg) ? "Task completed successfully!" : $msg  }}</h3> --}}
						<p>&nbsp;</p>
						<p class="card-text">{{ !isset($msg) ? "Task completed successfully!" : $msg  }}</p>

						{{-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> --}}
						{{-- <p class="card-text">Please contact support at support@HawarIT.com</p> --}}
						<p>&nbsp;</p>
						<p class="card-text">We are available 24 hours a day to assist you via our <a href="{{ config('app.url') }}">support ticket system </a> or via email at support{{ '@'.config('app.domain') }}</p>
						<a href="{{ route('home') }}" class="btn btn-primary">Go to Home</a>
					</div>
					<!-- End Heading -->
			</div>
			</div>
			<!-- End Card -->
		</div>
	</div>

@endsection
