@extends('layouts.landlord')
@section('title','Register')

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
					<h2 class="h2">Welcome to {{ config('app.name') }}</h2>
					<p>Fill out the form to get started.</p>
				</div>
				<!-- End Heading -->
				<!-- Form -->
				<form method="POST" action="{{ route('register') }}">
					@csrf

					<!-- Form -->
					<div class="mb-3">
						<label class="form-label" for="name">Your Name</label>
						<input id="name" type="text"
							class="form-control form-control-lg @error('name') is-invalid @enderror" name="name"
							value="{{ old('name') }}" placeholder="Done joe" required autocomplete="name" autofocus>
						@error('name')
						<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>
					<!-- End Form -->

					<!-- Form -->
					<div class="mb-3">
						<label class="form-label" for="email">Your email</label>
						<input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
							name="email" value="{{ old('email') }}" placeholder="email@example.com"
							aria-label="email@example.com" required autocomplete="email">
						@error('email')
						<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>
					<!-- End Form -->

					<!-- Form -->
					<div class="mb-3">
						<label class="form-label" for="email">Password</label>
						<input name="password" type="password"
							class="form-control form-control-lg @error('password') is-invalid @enderror"
							placeholder="8+ characters required" required autocomplete="new-password">
						@error('password')
						<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>
					<!-- End Form -->

					<!-- Form -->
					<div class="mb-3">
						<label class="form-label" for="email">Confirm Password</label>
						<input name="password_confirmation" type="password"
							class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror"
							required placeholder="8+ characters required" autocomplete="new-password">
						@error('password_confirmation')
						<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>
					<!-- End Form -->

					<!-- Check -->
					<div class="form-check mb-3">
						{{-- <input class="form-check-input me-3" type="checkbox" id="form-check-default" name="terms">
						--}}
						<input type="checkbox" class="form-check-input" id="form-check-default" name="terms" required>
						<label class="form-check-label small" for="form-check-default"> By submitting this form I have
							read and acknowledged the <a href="{{ route('tos') }}" target="_blank">Terms of
								Use</a></label>
						@error('terms')
						<div class="text-danger text-xs">{{ $message }}</div>
						@enderror

					</div>
					<!-- End Check -->

					<div class="d-grid mb-3">
						<button id="submit" type="submit" name="send" class="btn btn-primary btn-lg">Sign up</button>
					</div>

					<div class="text-center">
						<p class="small">Already have an account? <a class="link" href="{{ route('login') }}">Log in
								here</a></p>
					</div>
				</form>
				<!-- End Form -->

			</div>
		</div>
		<!-- End Card -->
	</div>
</div>
@endsection