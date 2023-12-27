@extends('layouts.landlord')
@section('title','Login')

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
					<h2 class="h2">Welcome back</h2>
					<p>Login to manage your account.</p>
				</div>
				<!-- End Heading -->
				<!-- Form -->
				<form action="{{ route('login') }}" method="post" onsubmit="return validateForm()">
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


					<!-- Form -->
					<div class="mb-4">
						<div class="d-flex justify-content-between align-items-center">
							<label class="form-label" for="password">Password</label>
							@if (Route::has('password.request'))
								<a class="form-label-link" href="{{ route('password.request') }}">Forgot Password?</a>
							@endif
						</div>
						<input id="password" type="password" placeholder="8+ characters required"
							class="form-control form-control-lg @error('password') is-invalid @enderror" name="password"
							value="{{ old('password') }}" required autocomplete="current-password" autofocus>
						@error('password')
						<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>
					<!-- End Form -->

					<div class="d-grid mb-4">
						<button type="submit" class="btn btn-primary btn-lg">Log in</button>
					</div>

					<div class="text-center">
						<p class="small">Don't have an account yet? <a class="link" href="{{ route('register') }}">Sign
								up here</a></p>
					</div>
				</form>
				<!-- End Form -->
			</div>
		</div>
		<!-- End Card -->
	</div>
</div>
@endsection