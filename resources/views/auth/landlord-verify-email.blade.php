@extends('layouts.landlord-blank')
@section('title','Verify Your Email Address')


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
					<h2 class="h2">Verify Your Email Address </h2>
					<p>Before proceeding, please check your email for a verification link.</p>
				</div>
				<!-- End Heading -->

				@if (session('resent'))
				<div class="alert alert-success" role="alert">
					{{ __('A fresh verification link has been sent to your email address.') }}
				</div>
				@endif

				<!-- Form -->
				<form action="{{ route('verification.send') }}" method="post" onsubmit="return validateForm()">
					@csrf

					<!-- Form -->
					<div class="mb-4">
						<label class="form-label" for="email">If you did not receive the email, request again by
							entering your email bellow</label>
						<input id="email" type="email" placeholder="you@example.com"
							class="form-control form-control-lg @error('email') is-invalid @enderror" name="email"
							value="{{ old('email', " you@example.com" ) }}" required autocomplete="email" autofocus>
						@error('email')
						<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>
					<!-- End Form -->
					<div class="d-grid mb-4">
						<button type="submit" class="btn btn-primary btn-lg">Click Here to Request Another</button>
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

@section('xxcontent')

<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ __('Verify Your Email Address Landlord') }}</div>

				<div class="card-body">
					@if (session('resent'))
					<div class="alert alert-success" role="alert">
						{{ __('A fresh verification link has been sent to your email address.') }}
					</div>
					@endif

					{{ __('Before proceeding, please check your email for a verification link.') }}
					{{ __('If you did not receive the email') }},
					<form class="d-inline" method="POST" action="{{ route('verification.send') }}">
						@csrf
						<div class="col-12">
							<div class="mb-3">
								<label class="form-label">Your Email <span class="text-danger">*</span></label>
								<input id="email" type="email" placeholder="you6@example.com"
									class="form-control @error('email') is-invalid @enderror" name="email"
									value="{{ old('email', " you@example.com" ) }}" required autocomplete="email"
									autofocus>
								@error('email')
								<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>
						</div>
						<!--end col-->
						<button type="submit" class="btn btn-info align-baseline">{{ __('click here to request another')
							}}</button>.
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection