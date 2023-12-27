@extends('layouts.auth')
@section('title','Register')

@section('content')

	<div class="text-center mt-4">
		<h1 class="h2">Get started [tenant]</h1>
		<p class="lead">
			Start creating the best possible user experience for you customers.
		</p>
	</div>

	<div class="card">
		<div class="card-body">
			<div class="m-sm-4">
				<div class="text-center">
					<img src="{{ Storage::disk('s3t')->url('avatar/avatar.png')  }}" alt="Guest" class="img-fluid rounded-circle" width="132" height="132" />
				</div>

				<form method="POST" action="{{ route('register') }}">
					@csrf
					<div class="mb-3">
						<label class="form-label">Email</label>
						<input class="form-control form-control-lg @error('email') is-invalid @enderror" 
							id="email" type="email" name="email" value="{{ old('email') }}" 
							placeholder="Enter your email" 
							required autocomplete="email" autofocus/>
							@error('email')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
					</div>
					
					<div class="mb-3">
						<label class="form-label">Name</label>
						<input class="form-control form-control-lg  @error('name') is-invalid @enderror" 
							type="text" name="name" value="{{ old('name') }}"
							placeholder="Enter your name" 
							required autocomplete="name"/>
							@error('name')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
					</div>
					<div class="mb-3">
						<label class="form-label">Password</label>
						<input class="form-control form-control-lg  @error('password') is-invalid @enderror" 
							id="password"  type="password" name="password" 
							placeholder="Enter password" 
							required autocomplete="new-password"/>
							@error('password')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
					</div>

					<div class="mb-3">
						<label class="form-label">Confirm Password</label>
						<input class="form-control form-control-lg  @error('password') is-invalid @enderror" 
							id="password-confirm" type="password" name="password_confirmation" 
							placeholder="Enter password" 
							required autocomplete="new-password"/>
							@error('password_confirmation')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
					</div>
				   
					<div>
						<div class="form-check align-items-center">
							<input id="terms" type="checkbox" class="form-check-input" name="terms">
							<label class="form-check-label text-small" for="terms">
								<span class="text-danger">*</span>I agree the <a href="{{ route('tos') }}" target="_blank" class="text-primary">Terms and Conditions</a>
							</label>
							@error('terms')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>
					</div>

					
					{{-- <div class="col-12">
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
					</div><!--end col--> --}}

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

@section('xxcontent')

	  <!-- ========== signin-section start ========== -->
	  <section class="signin-section pt-120">
		<div class="container">
			<div class="row g-0 auth-row">
				<div class="col-lg-6">
					<div class="auth-cover-wrapper bg-primary-100">
						<div class="auth-cover">
							<div class="title text-center">
								<h1 class="text-primary mb-10">Get Started</h1>
								<p class="text-medium">
								Start creating the best possible user experience
								<br class="d-sm-block" />
								for you customers.
								</p>
							</div>
							<div class="cover-image">
								<img src={{asset('/images/auth/signin-image.svg')}} alt="" />
							</div>
							<div class="shape-image">
								<img src={{asset('/images/auth/shape.svg')}} alt="" />
							</div>
						</div>
					</div>
				</div>
				<!-- end col -->
				<div class="col-lg-6">
					<div class="signin-wrapper">
							<div class="form-wrapper">
								<h6 class="mb-15">Sign Up/Register Form</h6>
								<p class="text-sm mb-25">Enter your Name, email and password to register</p>

								<form method="POST" action="{{ route('register') }}">
									@csrf

									<div class="row">
										<div class="col-12">
											<div class="input-style-1">
												<label class="form-label">Name <span class="text-danger">*</span></label>
												<input id="name" type="text" 
													class="form-control @error('name') is-invalid @enderror" 
													name="name" value="{{ old('name') }}" 
													required autocomplete="name" autofocus>
													@error('name')
														<div class="text-danger text-xs">{{ $message }}</div>
													@enderror
											</div>
										</div>
										<!-- end col -->

										<div class="col-12">
											<div class="input-style-1">
												<label class="form-label">Email <span class="text-danger">*</span></label>
												<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
													name="email" value="{{ old('email') }}" 
													required autocomplete="email">
													@error('email')
														<div class="text-danger text-xs">{{ $message }}</div>
													@enderror
											</div>
										</div>
										<!-- end col -->

										<div class="col-12">
											<div class="input-style-1">
												<label class="form-label">Password <span class="text-danger">*</span></label>
												<input id="password" type="password" 
													class="form-control @error('password') is-invalid @enderror" 
													name="password" required autocomplete="new-password">
													@error('password')
														<div class="text-danger text-xs">{{ $message }}</div>
													@enderror
											</div>
										</div>
										<!-- end col -->


										<div class="col-12">
											<div class="input-style-1">
												<label class="form-label">Confirm Password <span class="text-danger">*</span></label>
												<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
											</div>
										</div>
										<!-- end col -->

										<div class="col-12">
											<div class="form-check checkbox-style mb-30">
												<input class="form-check-input me-3" type="checkbox" id="form-check-default" name="terms">
												<label class="form-check-label text-sm text-medium" for="form-check-default">
													<span class="text-danger">*</span>I agree the <a href="{{ route('tos') }}" target="_blank" class="text-primary">Terms and Conditions</a>
												</label>
												@error('terms')
													<div class="text-danger text-xs">{{ $message }}</div>
												@enderror
											</div>
										</div>
										<!-- end col -->

										<div class="col-12">
											<div class="button-group d-flex justify-content-center flex-wrap">
												<button type="submit" id="submit" name="send" class="main-btn primary-btn btn-hover w-100 text-center">Sign Up</button>
											</div>
										</div>
										<!-- end col -->

										<div class="col-xxl-6 col-lg-12 col-md-6 mt-3">
											<p class="text-sm text-medium text-dark text-center">
												Already have an account? <a href="{{ route('login') }}">Sign In</a>
											</p>
										</div>
										<!-- end col -->

									</div>
									<!-- end row -->
							</form>
							
							</div>
					</div>
				</div>
				<!-- end col -->
			</div>
			<!-- end row -->
		</div>
	  </section>
	  <!-- ========== signin-section end ========== -->


@endsection

