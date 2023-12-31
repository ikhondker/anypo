{{-- @extends('layouts.error-full-page')
@section('title','Account Associated!')
@section('heading','Account Associated!')
@section('line1','However, system found an Associated Account with your user name.')
@section('lin22','Please contact support at support@HawarIT.com') --}}

@extends('layouts.landlord')
@section('title','Account Associated!')

@section('content')

	<div class="container content-space-2">
		<div class="w-lg-50 mx-lg-auto">
			<!-- Card -->
			<div class="card card-lg mb-5">
				<div class="card-body">
					<!-- Heading -->
					<div class="text-center mb-5 mb-md-7">
						<h1 class="h2 text-danger">Account Associated!</h1>
						
						<p>&nbsp;</p>

						<p class="card-text">However, system found an Associated Account with your user name.</p>
						<p class="card-text">Please contact support at support@HawarIT.com</p>
						<a href="{{ route('home') }}" class="btn btn-primary">Go to Home</a>
					</div>
					<!-- End Heading -->
			</div>
			</div>
			<!-- End Card -->
		</div>
	</div>

@endsection
