<footer class="bg-dark">
  <div class="container pb-1 pb-lg-5">
	<div class="row content-space-t-2">
	  <div class="col-lg-3 mb-7 mb-lg-0">
		<!-- Logo -->
		<div class="mb-5">
		  <a class="navbar-brand" href="./index.html" aria-label="Space">
			<img class="navbar-brand-logo" src="{{ asset('/assets/svg/logos/logo-white.svg') }}" alt="Image Description">
		  </a>
		</div>
		<!-- End Logo -->

		<!-- List -->
		<ul class="list-unstyled list-py-1">
		  <li><a class="link-sm link-light" href="#"><i class="bi-geo-alt-fill me-1"></i> 153 Williamson Plaza, Maggieberg</a></li>
		  <li><a class="link-sm link-light" href="tel:1-062-109-9222"><i class="bi-telephone-inbound-fill me-1"></i> +1 (062) 109-9222</a></li>
		</ul>
		<!-- End List -->

	  </div>
	  <!-- End Col -->

	  <div class="col-sm mb-7 mb-sm-0">
		<h5 class="text-white mb-3">Company</h5>

		<!-- List -->
		<ul class="list-unstyled list-py-1 mb-0">
		  <li><a class="link-sm link-light" href="#">About</a></li>
		  <li><a class="link-sm link-light" href="#">Careers <span class="badge bg-warning text-dark rounded-pill ms-1">We're hiring</span></a></li>
		  <li><a class="link-sm link-light" href="#">Blog</a></li>
		  <li><a class="link-sm link-light" href="#">Customers <i class="bi-box-arrow-up-right small ms-1"></i></a></li>
		  <li><a class="link-sm link-light" href="#">Hire us</a></li>
		</ul>
		<!-- End List -->
	  </div>
	  <!-- End Col -->

	  <div class="col-sm mb-7 mb-sm-0">
		<h5 class="text-white mb-3">Features</h5>

		<!-- List -->
		<ul class="list-unstyled list-py-1 mb-0">
		  <li><a class="link-sm link-light" href="#">Press <i class="bi-box-arrow-up-right small ms-1"></i></a></li>
		  <li><a class="link-sm link-light" href="#">Release Notes</a></li>
		  <li><a class="link-sm link-light" href="#">Integrations</a></li>
		  <li><a class="link-sm link-light" href="#">Pricing</a></li>
		</ul>
		<!-- End List -->
	  </div>
	  <!-- End Col -->

	  <div class="col-sm mb-7 mb-sm-0">
		<h5 class="text-white mb-3">Documentation</h5>

		<!-- List -->
		<ul class="list-unstyled list-py-1 mb-0">
		  <li><a class="link-sm link-light" href="#">Support</a></li>
		  <li><a class="link-sm link-light" href="#">Docs</a></li>
		  <li><a class="link-sm link-light" href="#">Status</a></li>
		  <li><a class="link-sm link-light" href="#">API Reference</a></li>
		  <li><a class="link-sm link-light" href="#">Tech Requirements</a></li>
		</ul>
		<!-- End List -->
	  </div>
	  <!-- End Col -->

	  <div class="col-sm">
		<h5 class="text-white mb-3">Resources</h5>

		<!-- List -->
		<ul class="list-unstyled list-py-1 mb-5">
		  <li><a class="link-sm link-light" href="#"><i class="bi-question-circle-fill me-1"></i> Help</a></li>
		  <li><a class="link-sm link-light" href="#"><i class="bi-person-circle me-1"></i> Your Account</a></li>
		</ul>
		<!-- End List -->
	  </div>
	  <!-- End Col -->
	</div>
	<!-- End Row -->

	<div class="border-top border-white-10 my-7"></div>

	<div class="row mb-7">
	  <div class="col-sm mb-3 mb-sm-0">
		<!-- Socials -->
		<ul class="list-inline list-separator list-separator-light mb-0">
		  <li class="list-inline-item">
			<a class="link-sm link-light" href="{{ route('privacy') }}">Privacy &amp; Policy</a>
		  </li>
		  <li class="list-inline-item">
			<a class="link-sm link-light" href="{{ route('tos') }}">Terms</a>
		  </li>
		  <li class="list-inline-item">
			<a class="link-sm link-light" href="#">Site Map</a>
		  </li>
		</ul>
		<!-- End Socials -->
	  </div>

	  <div class="col-sm-auto">
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
	</div>

	<!-- Copyright -->
	<div class="w-md-85 text-lg-center mx-lg-auto">
		<p class="text-white-50 small">&copy; {{ date('Y').' '. env('APP_NAME') }}. All rights reserved. Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})</p>
		

		<p class="text-white-50 small">When you visit or interact with our sites, services or tools, we or our authorized service providers may use cookies for storing information to help provide you with a better, faster and safer experience and for marketing purposes.</p>
		@auth
			<p class="text-white-50 small">
			  <span class="text-muted">{{ auth()->user()->name }} {{ '| '.auth()->user()->id .' |' }}  {{ auth()->user()->email .' |' }} </span>

			  @if ( auth()->user()->role->value == App\Enum\UserRoleEnum::USER->value )
				<span class="badge bg-primary-light">user </span>|
			  @else
				<a class="text-primary" href="{{ route('users.updaterole',['user'=>auth()->user()->id,'role'=>'user']) }}">user</a> |
			  @endif

			  @if ( auth()->user()->role->value == App\Enum\UserRoleEnum::ADMIN->value)
				<span class="badge bg-primary-light">admin </span>|
			  @else
				<a class="text-primary" href="{{ route('users.updaterole',['user'=>auth()->user()->id,'role'=>'admin']) }}">admin</a> |
			  @endif

			  @if ( auth()->user()->role->value == App\Enum\UserRoleEnum::SUPPORT->value)
				<span class="badge bg-primary-light">support </span>|
			  @else
				<a class="text-primary" href="{{ route('users.updaterole',['user'=>auth()->user()->id,'role'=>'support']) }}">support</a> |
			  @endif

			  @if ( auth()->user()->role->value == App\Enum\UserRoleEnum::SYSTEM->value)
				  <span class="badge bg-light text-primary">system </span>
			  @else
				<a class="text-primary" href="{{ route('users.updaterole',['user'=>auth()->user()->id,'role'=>'system']) }}">system</a>
			  @endif
			</p>
				@endauth
		@guest
			<p class="text-white-50 small">
				Welcome Guest. Please  <a class="list-inline-item" href="{{ route('login') }}" class="text-light">Login</a> here.
			</p>
		@endguest


	</div>
	<!-- End Copyright -->
  </div>
</footer>


<!-- JS Global Compulsory  -->
<script src="{{ asset('/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>

<!-- JS Implementing Plugins -->
<script src="{{ asset('/assets/vendor/hs-header/dist/hs-header.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/hs-mega-menu/dist/hs-mega-menu.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/hs-show-animation/dist/hs-show-animation.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/hs-go-to/dist/hs-go-to.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/tom-select/dist/js/tom-select.complete.min.js') }}"></script>

<!-- JS Front -->
<script src="{{ asset('/assets/js/theme.min.js') }}"></script>

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
	new HSShowAnimation('.js-animation-link')


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