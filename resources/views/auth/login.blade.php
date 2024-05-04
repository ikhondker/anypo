@extends('layouts.auth')
@section('title','Login')

@section('content')

	<div class="text-center mt-4">
		<h1 class="h2">Welcome back,</h1>
		<p class="lead">Sign in to your existing account to continue</p>
	</div>

	<div class="card">
		<div class="card-body">
			<div class="m-sm-4">
				<div class="text-center">
					<img src="{{ Storage::disk('s3t')->url('avatar/avatar.png') }}" alt="Guest" class="img-fluid rounded-circle" width="132" height="132" />
				</div>
				<form action="{{ route('login') }}" method="post">

					@csrf
					<div class="mb-3">
						<label class="form-label">Email</label>
						<input class="form-control form-control-lg @error('email') is-invalid @enderror" 
							type="email" name="email" value="{{ old('email') }}"
							placeholder="email@example.com" 
							required autocomplete="email" autofocus/>
							@error('email')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
					</div>
					<div class="mb-3">
						<label class="form-label">Password</label>
						<input class="form-control form-control-lg @error('password') is-invalid @enderror" 
								type="password" name="password" 
								placeholder="Enter your password" 
								required autocomplete="current-password"
								/>
					</div>
					<div>
						<div class="form-check align-items-center">
							<input id="customControlInline" type="checkbox" class="form-check-input" value="remember-me" name="remember-me" checked>
							<label class="form-check-label text-small" for="customControlInline">Remember me next time</label>
						</div>
					</div>
					<div class="text-end mt-3">
						<div class="button-group d-flex justify-content-center flex-wrap">
							<button type="submit" id="submit" name="submit" class="btn btn-lg btn-primary w-100">Sign In</button>
						</div>
					</div>

					<div class="row mt-3">
						<div class="col-6 text-start pt-2">
								<p class="small text-start">Don't have an account? <a href="{{ route('register') }}">Sign Up</a></p>
						</div>
						<!-- end col -->
						<div class="col-6 text-end pt-2">
								<p class="small text-end"><a href="{{ route('password.request') }}" class="hover-underline">Forgot Password?</a></p>
						</div>
						<!-- end col -->
					</div>

				</form>
			</div>
		</div>
	</div>

@endsection

