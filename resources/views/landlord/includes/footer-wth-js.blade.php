
	<!-- ========== FOOTER ========== -->
	<footer class="bg-dark">
		<div class="container content-space-t-2 content-space-b-1">
		<div class="row mb-9">
			<div class="col-lg-3 mb-5 mb-lg-0">

				<!-- Logo -->
				<div class="mb-3">
					<a class="navbar-brand" href="./index.html" aria-label="Space">
					<img class="navbar-brand-logo" src="{{ Storage::disk('s3l')->url('logo/logo-white.svg') }}" alt="Logo">
					</a>
				</div>
				<!-- End Logo -->
		
				<!-- List -->
				<ul class="list-unstyled list-py-1">
					<li><a class="link-sm link-light" href="#"><i class="bi-geo-alt-fill me-1"></i> {{ $_config->address1 }}</a></li>
					<li><a class="link-sm link-light" href="#">{{ $_config->city.' '.$_config->state.' '. $_config->zip. ', '. $_config->relCountry->name }}</a></li>
					<li><a class="link-sm link-light" href="tel:{{$_config->cell}}"><i class="bi-telephone-inbound-fill me-1"></i> {{ $_config->cell }}</a></li>
				</ul>
				<!-- End List --> 
				
			</div>
			<!-- End Col -->

				
			<div class="col-6 col-md-3 col-lg-2 mb-5 mb-md-0">
				<h5 class="text-white">Resources</h5>
					<!-- Nav Links -->
				<ul class="list-unstyled list-py-1 mb-0">
					<li><a class="link-sm link-light" href="{{ route('faq') }}"><i class="bi-question-circle-fill me-1"></i> FAQ</a></li>
					<li><a class="link-sm link-light" href="{{ route('login') }}"><i class="bi-person-circle me-1"></i> Your Account</a></li>
				</ul>
				<!-- End Nav Links -->
			</div>
			<!-- End Col -->


			<div class="col-6 col-md-3 col-lg-2 mb-5 mb-md-0">
				<h5 class="text-white">Legal & Privacy</h5>
					<!-- Links -->
				<ul class="list-unstyled list-py-1 mb-0">
					<li><a class="link-sm link-light" href="{{ route('privacy') }}">Privacy &amp; Policy</a></li>
					<li><a class="link-sm link-light" href="{{ route('tos') }}">Terms of Services</a></li>
					<li><a class="link-sm link-light" href="{{ route('contact-us') }}">Contact us</a></li>
				</ul>
				<!-- End Links -->
			</div>
			<!-- End Col -->
	
			<div class="col-md-6 col-lg-5">
				<!-- Form -->
				<form action="{{ route('home.join-mail-list') }}" method="POST">
					@csrf
					<h5 class="text-white">Stay up to date</h5>
		
					<!-- Input Card -->
					<div class="input-card mt-3">
						<div class="input-card-form">
							{{-- <input type="text" class="form-control" placeholder="Enter email" aria-label="Enter email"> --}}
							<input name="join_email" id="join_email" type="email" placeholder="you@example.com" aria-label="Enter email"
								class="form-control @error('join_email') is-invalid @enderror"
								value="{{ old('join_email') }}" required>
							@error('join_email')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
					<!-- End Input Card -->
				</form>
				<!-- End Form -->
	
			<p class="form-text text-white-70">Product new features or big discounts. We never spam.</p>
			</div>
			<!-- End Col -->
		</div>
		<!-- End Row -->
	
		<div class="row align-items-center">
			<div class="col">
				<p class="text-white-50 small mb-0">&copy; {{ date('Y').' '. env('APP_NAME') }}. All rights reserved. 
					@auth
						@if (auth()->user()->isSystem())
							Laravel v{{ app()->version() }} (PHP v{{ phpversion() }})</p>
						@endif	
					@endauth
			</div>
			<!-- End Col -->
	
			<div class="col-auto">
				<!-- Socials -->
				<ul class="list-inline mb-0">
					<li class="list-inline-item">
					<a class="btn btn-soft-light btn-xs btn-icon" href="#">
						<i class="bi-facebook"></i>
					</a>
					</li>
		
					<li class="list-inline-item">
					<a class="btn btn-soft-light btn-xs btn-icon" href="#">
						<i class="bi-google"></i>
					</a>
					</li>
		
					<li class="list-inline-item">
					<a class="btn btn-soft-light btn-xs btn-icon" href="#">
						<i class="bi-twitter"></i>
					</a>
					</li>
		
					<li class="list-inline-item">
					<a class="btn btn-soft-light btn-xs btn-icon" href="#">
						<i class="bi-github"></i>
					</a>
					</li>
				</ul>
				<!-- End Socials -->
			</div>
			<!-- End Col -->
		</div>
		<!-- End Row -->
		</div>
	</footer>
	<!-- ========== END FOOTER ========== -->

<!-- JS Global Compulsory -->
{{-- <script src="{{ asset('/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script> --}}
<script	src="{{ Storage::disk('s3l')->url('vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>

<!-- JS Implementing Plugins -->
{{-- <script src="{{ asset('/assets/vendor/hs-header/dist/hs-header.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/hs-mega-menu/dist/hs-mega-menu.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/hs-show-animation/dist/hs-show-animation.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/hs-go-to/dist/hs-go-to.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/tom-select/dist/js/tom-select.complete.min.js') }}"></script> --}}

<script	src="{{ Storage::disk('s3l')->url('vendor/hs-header/dist/hs-header.min.js') }}"></script>
<script	src="{{ Storage::disk('s3l')->url('vendor/hs-mega-menu/dist/hs-mega-menu.min.js') }}"></script>
<script	src="{{ Storage::disk('s3l')->url('hs-show-animation/dist/hs-show-animation.min.js') }}"></script>
<script	src="{{ Storage::disk('s3l')->url('vendor/hs-go-to/dist/hs-go-to.min.js') }}"></script>
<script	src="{{ Storage::disk('s3l')->url('vendor/tom-select/dist/js/tom-select.complete.min.js') }}"></script>


<!-- JS Front -->

<script src="{{ asset('/assets/js/theme.min.js') }}"></script>
{{-- <script	src="{{ Storage::disk('s3l')->url('js/theme.min.js') }}"></script> --}}

<!-- JS Plugins Init. -->
<script>
  (function() {
	// INITIALIZATION OF HEADER
	// =======================================================
	new HSHeader('#header').init()

	// INITIALIZATION OF MEGA MENU
	// =======================================================
	new HSMegaMenu('.js-mega-menu', {
		desktop: {
		  position: 'left'
		}
	  })


	// INITIALIZATION OF SHOW ANIMATIONS
	// =======================================================
	// new HSShowAnimation('.js-animation-link')


	// INITIALIZATION OF BOOTSTRAP VALIDATION
	// =======================================================
	HSBsValidation.init('.js-validate', {
	  onSubmit: data => {
		data.event.preventDefault()
		alert('Submited')
	  }
	})


	// INITIALIZATION OF BOOTSTRAP DROPDOWN
	// =======================================================
	HSBsDropdown.init()


	// INITIALIZATION OF GO TO
	// =======================================================
	new HSGoTo('.js-go-to')


	// INITIALIZATION OF SELECT
	// =======================================================
	HSCore.components.HSTomSelect.init('.js-select', {
	  render: {
		'option': function(data, escape) {
		  return data.optionTemplate
		},
		'item': function(data, escape) {
		  return data.optionTemplate
		}
	  }
	})
  })()
</script>