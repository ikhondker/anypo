@extends('layouts.landlord')
@section('title','Register')

@section('content')
<div class="container content-space-2">
    <div class="w-lg-50 mx-lg-auto">
        <!-- Card -->
        <div class="card card-lg mb-5">
            <div class="card-body">
                <!-- Heading -->
                <div class="text-center mb-5 mb-md-7">
                    
                    <h1 class="h2">Welcome to {{ config('app.name') }}</h1>
                    <p>Fill out the form to get started.</p>
                </div>
                <!-- End Heading -->
                <!-- Form -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Form -->
                    <div class="mb-3">
                        <label class="form-label" for="signupSimpleSignupName">Your Name</label>
                    
                        <input id="signupSimpleSignupName" type="text" 
                            class="form-control form-control-lg @error('name') is-invalid @enderror" 
                            name="name" value="{{ old('name') }}"  placeholder="Done joe"
                            required autocomplete="name" autofocus>
                        @error('name')
                            <div class="text-danger text-xs">{{ $message }}</div>
                        @enderror
            
                        <span class="invalid-feedback">Please enter a valid name.</span>
                    </div>
                    <!-- End Form -->

                    <!-- Form -->
                    <div class="mb-3">
                    <label class="form-label" for="signupSimpleSignupEmail">Your email</label>
                        <input id="signupSimpleSignupEmail" type="email" class="form-control @error('email') is-invalid @enderror" 
                            name="email" value="{{ old('email') }}" 
                            placeholder="email@site.com" aria-label="email@site.com" 
                            required autocomplete="email">
                            @error('email')
                                <div class="text-danger text-xs">{{ $message }}</div>
                            @enderror

                    <span class="invalid-feedback">Please enter a valid email address.</span>
                    </div>
                    <!-- End Form -->

                    <!-- Form -->
                    <div class="mb-3">
                    <label class="form-label" for="signupSimpleSignupPassword">Password</label>


                    <div class="input-group input-group-merge" data-hs-validation-validate-class>
                        <input type="password" class="js-toggle-password form-control form-control-lg @error('password') is-invalid @enderror" 
                            name="password" id="signupSimpleSignupPassword" 
                            placeholder="8+ characters required" aria-label="8+ characters required" required
                            autocomplete="new-password"
                            data-hs-toggle-password-options='{
                                "target": [".js-toggle-password-target-1", ".js-toggle-password-target-2"],
                                "defaultClass": "bi-eye-slash",
                                "showClass": "bi-eye",
                                "classChangeTarget": ".js-toggle-passowrd-show-icon-1"
                                }'>
                        <a class="js-toggle-password-target-1 input-group-append input-group-text" href="javascript:;">
                        <i class="js-toggle-passowrd-show-icon-1 bi-eye"></i>
                        </a>
                    </div>

                    <span class="invalid-feedback">Your password is invalid. Please try again.</span>
                    </div>
                    <!-- End Form -->

                    <!-- Form -->
                    <div class="mb-3">
                    <label class="form-label" for="signupSimpleSignupConfirmPassword">Confirm password</label>

                    <div class="input-group input-group-merge" data-hs-validation-validate-class>
                        <input type="password" class="js-toggle-password form-control form-control-lg" 
                            name="password_confirmation" id="signupSimpleSignupConfirmPassword" 
                            placeholder="8+ characters required" aria-label="8+ characters required" 
                            required autocomplete="new-password"
                            data-hs-validation-equal-field="#signupSimpleSignupPassword"
                            data-hs-toggle-password-options='{
                                "target": [".js-toggle-password-target-1", ".js-toggle-password-target-2"],
                                "defaultClass": "bi-eye-slash",
                                "showClass": "bi-eye",
                                "classChangeTarget": ".js-toggle-passowrd-show-icon-2"
                            }'>

                            
                        <a class="js-toggle-password-target-2 input-group-append input-group-text" href="javascript:;">
                        <i class="js-toggle-passowrd-show-icon-2 bi-eye"></i>
                        </a>
                    </div>

                    <span class="invalid-feedback">Password does not match the confirm password.</span>
                    </div>
                    <!-- End Form -->

                    <!-- Check -->
                    <div class="form-check mb-3">
                        {{-- <input class="form-check-input me-3" type="checkbox" id="form-check-default" name="terms"> --}}
                    <input type="checkbox" class="form-check-input" id="signupHeroFormPrivacyCheck" name="signupFormPrivacyCheck" required>
                    <label class="form-check-label small" for="signupHeroFormPrivacyCheck"> By submitting this form I have read and acknowledged the <a href="{{ route('tos') }}">Privacy Policy</a></label>
                    <span class="invalid-feedback">Please accept our Privacy Policy.</span>
                    </div>
                    <!-- End Check -->

                    <div class="d-grid mb-3">
                    <button id="submit" type="submit" name="send" class="btn btn-primary btn-lg">Sign up</button>
                    </div>

                    <div class="text-center">
                    <p>Already have an account? <a class="link" href="{{ route('login') }}">Log in here</a></p>
                    </div>
                </form>
                <!-- End Form -->

            </div>
        </div>
        <!-- End Card -->
    </div>
  </div>





 <!-- Form -->
 <div class="container content-space-3 content-space-t-lg-4 content-space-b-lg-3">
    <div class="flex-grow-1 mx-auto" style="max-width: 28rem;">
      <!-- Heading -->
      <div class="text-center mb-5 mb-md-7">
        <h1 class="h2">Welcome to {{ config('app.name') }}</h1>
        <p>Fill out the form to get started.</p>
      </div>
      <!-- End Heading -->

    </div>
  </div>
  <!-- End Form -->
  @endsection

@section('bo04-content')

    <div class="container mt-100 mt-60">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title mb-5 pb-2 text-center">
                    <h4 class="title mb-3">Sign Up/Register</h4>
                    <p class="text-muted para-desc mx-auto mb-0">Enter your email and password to register</p>
                </div>

                <div class="custom-form">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <p id="error-msg" class="mb-0"></p>
                        <div id="simple-msg"></div>
                        <div class="row">

                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                    <input id="name" type="text" 
                                        class="form-control @error('name') is-invalid @enderror" 
                                        name="name" value="{{ old('name') }}" 
                                        required autocomplete="name" autofocus>
                                        @error('name')
                                            <div class="text-danger text-xs">{{ $message }}</div>
                                        @enderror
                                </div>
                            </div><!--end col-->

                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                        name="email" value="{{ old('email') }}" 
                                        required autocomplete="email">
                                        @error('email')
                                            <div class="text-danger text-xs">{{ $message }}</div>
                                        @enderror

                                </div>
                            </div><!--end col-->

                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Password <span class="text-danger">*</span></label>
                                    <input id="password" type="password" 
                                        class="form-control @error('password') is-invalid @enderror" 
                                        name="password" required autocomplete="new-password">
                                        @error('password')
                                            <div class="text-danger text-xs">{{ $message }}</div>
                                        @enderror
                                </div>
                            </div><!--end col-->

                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div><!--end col-->

                            <div class="col-12">
                                <div class="mb-3">
                                    <div class="form-check form-check-primary form-check-inline">
                                        <input class="form-check-input me-3" type="checkbox" id="form-check-default" name="terms">
                                        <label class="form-check-label" for="form-check-default">
                                            <span class="text-danger">*</span>I agree the <a href="{{ route('tos') }}" target="_blank" class="text-primary">Terms and Conditions</a>
                                        </label>
                                        @error('terms')
                                            <div class="text-danger text-xs">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div><!--end col-->

                        </div><!--end row-->

                        <div class="row">
                            <div class="col-12">
                                <div class="d-grid">
                                    <button type="submit" id="submit" name="send" class="btn btn-primary">SIGN UP</button>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->

                        <div class="row p-3">
                            <div class="col-12">
                                <div class="d-grid text-center">
                                    <p class="mb-0">Already have an account ? <a href="{{ route('login') }}" class="text-warning">Sign in</a></p>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->

                    </form>
                </div><!--end custom-form-->
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->

@endsection


