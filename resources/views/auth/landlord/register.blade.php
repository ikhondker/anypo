@extends('layouts.landlord.page')
@section('title','Register')

@section('content')
	<div class="auth-full-page d-flex">
		<div class="auth-form p-3">

			<div class="text-center">

				<span class="avatar avatar-xxl avatar-circle">
					<img src="{{ Storage::disk('s3l')->url('avatar/avatar.png') }}" class="img-fluid rounded-circle" alt="Avatar" width="128" height="128">
				</span>
				<h1 class="h2">Welcome to {{ config('app.name') }}</h1>
				<p class="lead">
					Start creating the best possible user experience for you business.
				</p>
			</div>

			<div class="mb-3">

				<form method="POST" action="{{ route('register') }}">
					@csrf
					<div class="mb-3">
						<label class="form-label">Full name</label>
						<input id="name" type="text"
								class="form-control form-control-lg @error('name') is-invalid @enderror" name="name"
								value="{{ old('name') }}" placeholder="Enter your name" required autocomplete="name" autofocus>
							@error('name')
							<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
					</div>
					<div class="mb-3">
						<label class="form-label">Email</label>
						<input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
								name="email" value="{{ old('email') }}" placeholder="Enter your email"
								aria-label="email@example.com" required autocomplete="email">
							@error('email')
							<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
					</div>
					<div class="mb-3">
						<label class="form-label">Password</label>

						<input name="password" type="password"
						class="form-control form-control-lg @error('password') is-invalid @enderror"
						placeholder="8+ characters required" required autocomplete="new-password">
						@error('password')
						<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>

					<div class="mb-3">
						<label class="form-label">Confirm Password</label>
						<input name="password_confirmation" type="password"
								class="form-control form-control-lg @error('password_confirmation') is-invalid @enderror"
								required placeholder="8+ characters required" autocomplete="new-password">
							@error('password_confirmation')
							<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
					</div>

					<!-- Check -->
					<div class="mb-3">
						<input type="checkbox" class="form-check-input" id="form-check-default" name="terms" required>
						<label class="form-check-label small" for="form-check-default"> By submitting this form I have
							read and acknowledged the <a href="{{ route('tos') }}" target="_blank">Terms of Use</a></label>
						@error('terms')
						<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>
					<!-- End Check -->

					<div class="d-grid gap-2 mt-3">
						<button id="submit" type="submit" name="send" class="btn btn-primary btn-lg">Sign up</button>
					</div>
				</form>
			</div>

			<div class="text-center">
				Already have account? <a href="{{ route('login') }}">Log In</a>
			</div>

			<div class="mb-3">&nbsp;
			</div>
			<div class="mb-3">
			</div>

		</div>
	</div>
@endsection
