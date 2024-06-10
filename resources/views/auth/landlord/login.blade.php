@extends('layouts.landlord.page')
@section('title','Login')

@section('content')

<div class="auth-full-page d-flex">
    <div class="auth-form p-3">

        <div class="text-center">
            <span class="avatar avatar-xxl avatar-circle">
                <img src="{{ Storage::disk('s3l')->url('avatar/avatar.png') }}" class="img-fluid rounded-circle" alt="Carl Jenkins" width="128" height="128">
            </span>
            <h1 class="h2">Welcome back!</h1>
            <p class="lead">
                Sign in to your account to continue
            </p>
        </div>

        <div class="mb-3">
            <form action="{{ route('login') }}" method="post">
				@csrf
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input id="email" type="email" placeholder="Enter your email"
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
							value="{{ old('password') }}" required autocomplete="current-password" autofocus>
						@error('password')
						    <div class="text-danger text-xs">{{ $message }}</div>
						@enderror
                    <small>
                        @if (Route::has('password.request'))
                            <a class="" href="{{ route('password.request') }}">Forgot Password?</a>
                        @endif
                    </small>
                </div>
                <div>
                    <div class="form-check align-items-center">
                        <input id="customControlInline" type="checkbox" class="form-check-input" value="remember-me" name="remember-me" checked>
                        <label class="form-check-label text-small" for="customControlInline">Remember me</label>
                    </div>
                </div>
                <div class="d-grid gap-2 mt-3">
                    <button type="submit" class="btn btn-lg btn-primary">Log in</button>
                </div>
            </form>
        </div>

        <div class="text-center">


            Don't have an account? <a href="auth-sign-up.html">Sign up</a>
        </div>
    </div>
</div>


@endsection
