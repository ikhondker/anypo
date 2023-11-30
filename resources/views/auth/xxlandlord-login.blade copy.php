@extends('layouts.landlord')
@section('title','Login')

@section('content')


<div class="container content-space-2">
    <div class="w-lg-50 mx-lg-auto">
        <!-- Card -->
        <div class="card card-lg mb-5">
            <div class="card-body">
                <!-- Heading -->
                <div class="text-center mb-5 mb-md-7">
                    <h1 class="h2">Welcome back</h1>
                    <p>Login to manage your account.</p>
                </div>
                <!-- End Heading -->
                <!-- Form -->
                <form action="{{ route('login') }}" method="post" onsubmit="return validateForm()">
                    @csrf

                    <!-- Form -->
                    <div class="mb-4">
                    <label class="form-label" for="signupSimpleLoginEmail">Your email</label>
                    <input type="email" class="form-control form-control-lg" name="email" id="signupSimpleLoginEmail" placeholder="email@site.com" aria-label="email@site.com" required>
                    <span class="invalid-feedback">Please enter a valid email address.</span>
                    </div>
                    <!-- End Form -->

                    <!-- Form -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <label class="form-label" for="signupSimpleLoginPassword">Password</label>
                            @if (Route::has('password.request'))
                                {{-- <span class="small"><a class="text-dark" href="{{ route('password.request') }}">Forgot Your Password?</a></span> --}}
                                <a class="form-label-link" href="{{ route('password.request') }}">Forgot Password?</a>
                            @endif
                        </div>

                        <div class="input-group input-group-merge" data-hs-validation-validate-class>
                            <input type="password" class="js-toggle-password form-control form-control-lg" name="password" id="signupSimpleLoginPassword" placeholder="8+ characters required" aria-label="8+ characters required" required minlength="8"
                                data-hs-toggle-password-options='{
                                "target": "#changePassTarget",
                                "defaultClass": "bi-eye-slash",
                                "showClass": "bi-eye",
                                "classChangeTarget": "#changePassIcon"
                                }'>
                            <a id="changePassTarget" class="input-group-append input-group-text" href="javascript:;">
                            <i id="changePassIcon" class="bi-eye"></i>
                            </a>
                        </div>

                        <span class="invalid-feedback">Please enter a valid password.</span>
                    </div>
                    <!-- End Form -->

                    <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary btn-lg">Log in</button>
                    </div>

                    <div class="text-center">
                    <p>Don't have an account yet? <a class="link" href="{{ route('register') }}">Sign up here</a></p>
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

    <div class="container mt-100 mt-60">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                
                <div class="section-title mb-5 pb-2 text-center">
                    <h4 class="title mb-3">Login</h4>
                    <p class="text-muted para-desc mx-auto mb-0">Enter your email and password to login</p>
                </div>

                <div class="custom-form">
                    <form action="{{ route('login') }}" method="post" onsubmit="return validateForm()">
                        @csrf

                        <p id="error-msg" class="mb-0"></p>
                        <div id="simple-msg"></div>
                        
                        <div class="row">

                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Your Email <span class="text-danger">*</span></label>
                                    <input id="email" type="email" placeholder="you@yourcompany.com"
                                        class="form-control @error('email') is-invalid @enderror" 
                                        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                        @error('email')
                                            <div class="text-danger text-xs">{{ $message }}</div>
                                        @enderror
                                </div>
                            </div><!--end col-->

                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Password<span class="text-danger">*</span></label>
                                    <input id="password" type="password" name="password" placeholder="Password"
                                        class="form-control @error('password') is-invalid @enderror"  
                                        required autocomplete="current-password">
                                </div>
                            </div><!--end col-->
                            {{-- TODO  --}}
                            {{-- <div class="col-6">
                                <div class="mb-3">
                                    <div class="form-check form-check-primary form-check-inline">
                                        <input class="form-check-input me-3" type="checkbox" id="form-check-default">
                                        <label class="form-check-label" for="form-check-default">
                                            Remember me (TODO)
                                        </label>
                                    </div>
                                </div>
                            </div><!--end col--> --}}

                        </div><!--end row-->

                        <div class="row">
                            <div class="col-12">
                                <div class="d-grid">
                                    <button type="submit" id="submit" name="send" class="btn btn-primary">Sign In</button>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->

                        <div class="row">
                            <div class="col-12 mt-2">
                                @if (Route::has('password.request'))
                                    <span class="small"><a class="text-dark" href="{{ route('password.request') }}">Forgot Your Password?</a></span>
                                @endif
                            </div><!--end col-->
                        </div><!--end row-->

                        
                    </form>
                </div><!--end custom-form-->
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->

@endsection

