@extends('layouts.landlord.page')
@section('title','Verify Your Email Address')

@section('content')

	<div class="auth-full-page d-flex">
		<div class="auth-form p-3">

			<div class="text-center">
				<span class="avatar avatar-xxl avatar-circle">
					<img src="{{ Storage::disk('s3l')->url('avatar/avatar.png') }}" class="img-fluid rounded-circle" alt="Avatar" width="128" height="128">
				</span>
				<h1 class="h2">Verify Your Email Address </h1>
				<p class="lead">
					We have sent you a mail with email verification link. Before proceeding, please check your email and click on the verification link to verify your email address.
				</p>
			</div>

			@if (session('resent'))
				<div class="alert alert-success text-center" role="alert">
					{{ __('A fresh verification link has been sent to your email address.') }}
				</div>
			@endif

			<div class="mb-3">
				<!-- Form -->
				<form action="{{ route('verification.send') }}" method="post" onsubmit="return validateForm()">
					@csrf

					<div class="mb-3">
						<div class="text-center">
						<label class="form-label" for="email">If you did not receive the email, request again by
							entering your email bellow</label>
						</div>		
						<input id="email" type="email" placeholder="you@example.com"
							class="form-control form-control-lg @error('email') is-invalid @enderror" name="email"
							value="{{ old('email', " you@example.com" ) }}" required autocomplete="email" autofocus>
						@error('email')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror

					</div>
					<div class="d-grid gap-2 mt-3">
						<button type="submit" class="btn btn-lg btn-primary">Click Here to Request Another</button>
					</div>
				</form>
			</div>

			<div class="text-center">
				Don't have an account yet? <a href="{{ route('register') }}">Sign up</a>
			</div>
		</div>
	</div>

@endsection

