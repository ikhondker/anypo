@extends('layouts.landlord.page')
@section('title','Recover Password')

@section('content')

<div class="auth-full-page d-flex">
	<div class="auth-form p-3">

		<div class="text-center">
			<span class="avatar avatar-xxl avatar-circle">
				<img src="{{ Storage::disk('s3l')->url('avatar/avatar.png') }}" class="img-fluid rounded-circle" alt="Carl Jenkins" width="128" height="128">
			</span>
			<h1 class="h2">Forgot Password</h1>
			<p class="lead">
				Enter your email to recover your ID.
			</p>
		</div>

		@if (session('status'))
			<div class="alert alert-success" role="alert">
				{{ session('status') }}
			</div>
		@endif

		<div class="mb-3">
			<!-- Form -->
			<form action="{{ route('password.email') }}" method="post">
				@csrf

				<div class="mb-3">
					<div class="">
						<label class="form-label" for="email">Your email</label>
					</div>		

					<input id="email" type="email" placeholder="you@example.com"
						class="form-control form-control-lg @error('email') is-invalid @enderror" name="email"
						value="{{ old('email') }}" required autocomplete="email" autofocus>
						@error('email')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
				</div>
				<div class="d-grid gap-2 mt-3">
					<button type="submit" class="btn btn-lg btn-primary">Send Password Reset Link</button>
				</div>
			</form>
		</div>

		<div class="text-center">
			Already have account? <a href="{{ route('login') }}">Log In</a>
		</div>
		
	</div>
</div>

@endsection
