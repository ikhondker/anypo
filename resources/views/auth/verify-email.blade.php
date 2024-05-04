@extends('layouts.auth')
@section('title','Verify Your Email Address')

@section('content')
<div class="text-center mt-4">
	<h1 class="h2">Welcome back,</h1>
	<p class="lead">Verify Your Email Address</p>
</div>

<div class="card">
	<div class="card-body">
		<div class="m-sm-4">

			<div class="text-center">
				<img src="{{ Storage::disk('s3t')->url('avatar/avatar.png') }}" alt="Guest"
					class="img-fluid rounded-circle" width="132" height="132" />
			</div>

			<form class="d-inline" method="POST" action="{{ route('verification.send') }}">
				@csrf

				@if (session('resent'))
				<div class="alert alert-success" role="alert">
					{{ __('A fresh verification link has been sent to your email address.') }}
				</div>
				@endif

				<div class="text-center">
					Before proceeding, please check your email for a verification link.<br>
					If you did not receive the email
				</div>

				<div class="mb-3 pt-3">
					<label class="form-label">Email</label>
					<input class="form-control form-control-lg @error('email') is-invalid @enderror" type="email"
						name="email" value="{{ old('email') }}" placeholder="email@example.com" required
						autocomplete="email" autofocus />
					@error('email')
					<div class="text-danger text-xs">{{ $message }}</div>
					@enderror
				</div>
				<div class="text-end mt-3">
					<div class="button-group d-flex justify-content-center flex-wrap">
						<button type="submit" id="submit" name="submit" class="btn btn-lg btn-primary w-100">click here
							to request another</button>
					</div>

				</div>
			</form>
		</div>
	</div>
</div>

@endsection