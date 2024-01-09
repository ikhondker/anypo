@extends('layouts.auth')

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
					<img src="{{ Storage::disk('s3t')->url('avatar/avatar.png')  }}" alt="Guest" class="img-fluid rounded-circle" width="132" height="132" />
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

@section('bo04content')
<div class="container mt-100 mt-60">
	<div class="row justify-content-center">
		<div class="col-lg-6">
			
			<div class="section-title mb-5 pb-2 text-center">
				<h4 class="title mb-3">Reset Password</h4>
				<p class="text-muted para-desc mx-auto mb-0">Enter your email to recover your ID</p>
			</div>
			@if (session('status'))
				<div class="alert alert-success" role="alert">
					{{ session('status') }}
				</div>
			@endif

			<div class="custom-form">
				<form action="{{ route('password.email') }}" method="post" onsubmit="return validateForm()">
					@csrf
					<div class="col-md-12">
						<div class="mb-4">
							<label class="form-label">Email</label>
							<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
							@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
							@enderror
						</div>
					</div>
					<div class="col-12">
						<div class="mb-4">
							<button class="btn btn-primary w-100">Send Password Reset Link</button>
						</div>
					</div>
					<div class="col-12">
						<div class="text-center">
							{{-- <a  class="text-warning" href="{{ route('register') }}">Register</a> |  --}}
							{{-- <a  class="text-warning" href="{{ route('login') }}">Login</a>  --}}
							<p class="mb-0">Already have an account ? <a href="{{ route('login') }}" class="text-warning">Sign in</a></p>
						</div>
					</div>

				</form>
			</div><!--end custom-form-->

		</div><!--end col-->
	</div><!--end row-->
</div><!--end container-->
@endsection


@section('orgcontent')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ __('Reset Password') }}</div>

				<div class="card-body">
					@if (session('status'))
						<div class="alert alert-success" role="alert">
							{{ session('status') }}
						</div>
					@endif

					<form method="POST" action="{{ route('password.email') }}">
						@csrf

						<div class="row mb-3">
							<label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

							<div class="col-md-6">
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

								@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
								@enderror
							</div>
						</div>

						<div class="row mb-0">
							<div class="col-md-6 offset-md-4">
								<button type="submit" class="btn btn-primary">
									{{ __('Send Password Reset Link') }}
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
