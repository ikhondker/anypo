@extends('layouts.tenant.auth')
@section('title','Register')

@section('content')

	<div class="card">
		<div class="card-body">
			<div class="m-sm-4">
				<div class="text-center">
					<img src="{{ Storage::disk('s3t')->url('avatar/avatar.png') }}" alt="Guest" class="img-fluid rounded-circle" width="132" height="132" />
				</div>
				<div class="text-center mt-4">
					<h1 class="h2">Get started with {{ tenant('id') }}.{{ config('app.domain') }}</h1>
					<p class="lead">
						Fill out the form to get started.
					</p>
				</div>
				<form method="POST" action="{{ route('register') }}">
					@csrf
					
					
					<div class="mb-3">
						<label class="form-label">Your Name</label>
						<input class="form-control form-control-lg @error('name') is-invalid @enderror" 
							type="text" name="name" value="{{ old('name') }}"
							placeholder="Enter your name" 
							required autocomplete="name"/>
							@error('name')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
					</div>
					<div class="mb-3">
						<label class="form-label">Your Email</label>
						<input class="form-control form-control-lg @error('email') is-invalid @enderror" 
							id="email" type="email" name="email" value="{{ old('email') }}" 
							placeholder="Enter your email" 
							required autocomplete="email" autofocus/>
							@error('email')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
					</div>

					<div class="mb-3">
						<label class="form-label">Password</label>
						<input class="form-control form-control-lg @error('password') is-invalid @enderror" 
							id="password" type="password" name="password" 
							placeholder="Enter password" 
							required autocomplete="new-password"/>
							@error('password')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
					</div>

					<div class="mb-3">
						<label class="form-label">Confirm Password</label>
						<input class="form-control form-control-lg @error('password') is-invalid @enderror" 
							id="password-confirm" type="password" name="password_confirmation" 
							placeholder="Enter password" 
							required autocomplete="new-password"/>
							@error('password_confirmation')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
					</div>

					{{-- <div>
						<div class="form-check align-items-center">
							<input id="terms" type="checkbox" class="form-check-input" name="terms" required>
							<label class="form-check-label text-small" for="terms">
								<span class="text-danger">*</span>I agree the <a href="{{ route('tos') }}" target="_blank" class="text-primary">Terms and Conditions</a>
							</label>
							@error('terms')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>
					</div> --}}

					<div class="text-end mt-3">
						<div class="button-group d-flex justify-content-center flex-wrap">
							<button type="submit" id="submit" name="submit" class="btn btn-lg btn-primary w-100">Register</button>
						</div>
					</div>
					<div class="row mt-3">
						<div class="col-6 text-start pt-2">
							<p class="small text-start">Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
						</div>
						<div class="col-6 text-end pt-2">
							
						</div>
					</div>
					
				</form>
			</div>
		</div>
	</div>
@endsection

