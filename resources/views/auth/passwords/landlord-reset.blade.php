@extends('layouts.landlord')
@section('title','Reset Password')

@section('content')

<div class="container content-space-2">
    <div class="w-lg-50 mx-lg-auto">
        <!-- Card -->
        <div class="card card-lg mb-5">
            <div class="card-body">
                <!-- Heading -->
                <div class="text-center mb-5 mb-md-7">
                    
                    <h1 class="h2">Reset Password</h1>
                    <p>Please set your new password.</p>
                </div>
                <!-- End Heading -->
                <!-- Form -->
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <!-- Form -->
                    <div class="mb-4">
                        <label class="form-label" for="email">Your email</label>
                        <input id="email" type="email" placeholder="you@example.com"
                            class="form-control form-control-lg @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <div class="text-danger text-xs">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- End Form -->


                    <!-- Form -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <label class="form-label" for="password">Password</label>
                        </div>
                        <input id="password" type="password" placeholder="8+ characters required"
                            class="form-control form-control-lg @error('password') is-invalid @enderror" name="password"
                            value="{{ old('password') }}" required autocomplete="new-password" autofocus>
                        @error('password')
                        <div class="text-danger text-xs">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- End Form -->

                    <!-- Form -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <label class="form-label" for="password">Confirm Password</label>
                        </div>
                        <input id="password-confirm" type="password" placeholder="8+ characters required"
                            class="form-control form-control-lg @error('password') is-invalid @enderror"
                            name="password_confirmation" required autocomplete="new-password" autofocus>
                        @error('password')
                        <div class="text-danger text-xs">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- End Form -->

                    <div class="d-grid mb-4">
                        <button type="submit" class="btn btn-primary btn-lg">Reset Password</button>
                    </div>

                </form>
                <!-- End Form -->
            </div>
        </div>
        <!-- End Card -->
    </div>
</div>

@endsection

@section('bo04-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address')
                                }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ $email ?? old('email') }}" required autocomplete="email"
                                    autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password')
                                }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm
                                Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
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