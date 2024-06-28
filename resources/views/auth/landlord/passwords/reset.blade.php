@extends('layouts.landlord.page')
@section('title','Reset Password')

@section('content')


<div class="auth-full-page d-flex">
	<div class="auth-form p-3">

		<div class="text-center">

			<span class="avatar avatar-xxl avatar-circle">
				<img src="{{ Storage::disk('s3l')->url('avatar/avatar.png') }}" class="img-fluid rounded-circle" alt="Carl Jenkins" width="128" height="128">
			</span>
			<h1 class="h2">Reset Password</h1>
			<p class="lead">
				Please set your new password.
			</p>
		</div>

		<div class="mb-3">

			<form method="POST" action="{{ route('password.update') }}">
				@csrf
				<input type="hidden" name="token" value="{{ $token }}">
				
				<div class="mb-3">
					<label class="form-label">Email</label>
					<input id="email" type="email" placeholder="you@example.com"
								class="form-control form-control-lg @error('email') is-invalid @enderror" name="email"
								value="{{ old('email') }}" required autocomplete="email" autofocus>
							@error('email')
							<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
				</div>
				<div class="mb-3">
					<label class="form-label">Password</label>

					<input id="password" type="password" placeholder="8+ characters required"
								class="form-control form-control-lg @error('password') is-invalid @enderror" name="password"
								value="{{ old('password') }}" required autocomplete="new-password" autofocus>
							@error('password')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
				</div>

				<div class="mb-3">
					<label class="form-label">Confirm Password</label>
					<input id="password-confirm" type="password" placeholder="8+ characters required"
								class="form-control form-control-lg @error('password') is-invalid @enderror"
								name="password_confirmation" required autocomplete="new-password" autofocus>
							@error('password')
							<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
				</div>

							<div class="d-grid gap-2 mt-3">
					<button id="submit" type="submit" name="send" class="btn btn-primary btn-lg">Reset Password</button>
				</div>
			</form>
		</div>

		<div class="text-center">
			Already have account? <a href="{{ route('login') }}">Log In</a>
		</div>

		<div class="mb-3">&nbsp;
		</div>

		
	</div>
</div>



@endsection
