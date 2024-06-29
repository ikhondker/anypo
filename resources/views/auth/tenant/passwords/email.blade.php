@extends('layouts.tenant.auth')

@section('content')
	<div class="text-center mt-4">
		<h1 class="h2">Reset password</h1>
		<p class="lead">
			Enter your email to reset your password.
		</p>
	</div>

	<div class="card">
		<div class="card-body">
			<div class="m-sm-4">

				<div class="text-center">
					<img src="{{ Storage::disk('s3t')->url('avatar/avatar.png') }}" alt="Guest" class="img-fluid rounded-circle" width="132" height="132" />
				</div>
				
				@if (session('status'))
					<div class="mt-3">
						<div class="alert alert-success alert-dismissible" role="alert">
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							<div class="alert-icon">
								<i class="far fa-fw fa-bell"></i>
							</div>
							<div class="alert-message">
								{{ session('status') }}
							</div>
						</div>
					</div>	
				@endif

				<form action="{{ route('password.email') }}" method="post" onsubmit="return validateForm()">
					@csrf
					<div class="mb-3">
						<label class="form-label">Email</label>
						<input class="form-control form-control-lg @error('email') is-invalid @enderror" 
							type="email" name="email" value="{{ old('email') }}"
							placeholder="Enter your email" 
							required autocomplete="email" autofocus/>
							@error('email')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
					</div>
					<div class="text-center mt-3">
						<button class="btn btn-lg btn-primary w-100">Send Password Reset Link</button>
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
