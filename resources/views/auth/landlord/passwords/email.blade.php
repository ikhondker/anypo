@extends('layouts.landlord.page')
@section('title','Recover Password')

@section('content')
	<div class="container content-space-2">
		<div class="w-lg-50 mx-lg-auto">
			<!-- Card -->
			<div class="card card-lg mb-5">
				<div class="card-body">
					<!-- Heading -->
					<div class="text-center mb-5 mb-md-7">
						<span class="avatar avatar-xxl avatar-circle">
							<img class="avatar-img" src="{{ Storage::disk('s3l')->url('avatar/avatar.png') }}" alt="Avatar">
						</span>
						<h1 class="h2 text-info">Forgot Password</h1>
						<p>Enter your email to recover your ID.</p>
					</div>
					<!-- End Heading -->

					@if (session('status'))
						<div class="alert alert-success" role="alert">
							{{ session('status') }}
						</div>
					@endif

					<!-- Form -->
					<form action="{{ route('password.email') }}" method="post">
						@csrf

						<!-- Form -->
						<div class="mb-4">
							<label class="form-label" for="email">Your email</label>
							<input id="email" type="email" placeholder="you@example.com"
								class="form-control form-control-lg @error('email') is-invalid @enderror" name="email"
								value="{{ old('email') }}" required autocomplete="email" autofocus>
							@error('email')
							<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>
						<!-- End Form -->

						<div class="d-grid mb-4">
							<button type="submit" class="btn btn-primary btn-lg">Send Password Reset Link</button>
						</div>

						<div class="text-center">
							<p class="small">Already have an account ? <a class="link" href="{{ route('login') }}">Sign
									in</a></p>
						</div>
					</form>
					<!-- End Form -->
				</div>
			</div>
			<!-- End Card -->
		</div>
	</div>
@endsection
