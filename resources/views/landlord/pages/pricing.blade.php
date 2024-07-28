@extends('layouts.landlord.page')
@section('title', 'Pricing Plan')
@section('content')

	<section class="py-6 bg-white">
		<div class="container">
			<div class="mb-5 text-center">
				<span class="text-uppercase text-primary text-sm fw-medium mb-1 d-block">2. PRICING</span>
				<h2 class="h1">PRICING</h2>
				<p class="text-muted fs-lg">One simple pricing model. All you need to start. No hidden costs.</p>
			</div>
			<div class="row align-items-center">
				<div class="col-lg-7 mx-auto">
					<div class="d-flex align-items-start py-3">
						<div class="landing-feature">
							<i data-lucide="sliders"></i>
						</div>
						<div class="flex-grow-1">
							<h4 class="mt-0">Purchase Order Management</h4>
							<p class="fs-lg">Streamline your purchasing workflow with easy-to-use purchase order management.</p>
						</div>
					</div>
					<div class="d-flex align-items-start py-3">
						<div class="landing-feature">
							<i data-lucide="sliders"></i>
						</div>
						<div class="flex-grow-1">
							<h4 class="mt-0">Expense Control</h4>
							<p class="fs-lg">Set spending limits for your departments and projects, track your progress effortlessly and analyze if you're at risk of going over budget.</p>
						</div>
					</div>
					<div class="d-flex align-items-start py-3">
						<div class="landing-feature">
							<i data-lucide="sliders"></i>
						</div>
						<div class="flex-grow-1">
							<h4 class="mt-0">Approval Workflows</h4>
							<p class="fs-lg">You don't need to be an expert to customize our themes. Our code is very readable and well documented.</p>
						</div>
					</div>
					<div class="d-flex align-items-start py-3">
						<div class="landing-feature">
							<i data-lucide="sliders"></i>
						</div>
						<div class="flex-grow-1">
							<h4 class="mt-0">Easy Integration (with Core Accounting System)</h4>
							<p class="fs-lg">Simple file based integration simplifies consolidated reporting from core accounting system. It reduces the need for manual data entry, allowing information to flow across the system.</p>
						</div>
					</div>

				</div>
				<div class="col-lg-5 mx-auto text-center">
					
					<div class="card text-center h-100">
						<div class="card-body d-flex flex-column">
							<div class="mb-4">
								<span class="text-uppercase text-primary text-sm fw-medium mb-1 d-block">One simple pricing model</span>
								<h4>{{ $product->name }}</h4>
								<span class="small">Including All Functionalities.</span><br>
								{{-- <span class="display-4">$39</span>
								<span>/mo</span> --}}
							</div>
							<!-- Media -->
							<div class="d-flex">
								<div class="flex-shrink-0">
									<img src="{{ Storage::disk('s3l')->url('svg/illustrations/oc-money-profits.svg') }}" class="rounded-circle rounded me-2 mb-2" src="img/avatars/avatar.jpg" alt="Placeholder" width="140" height="140">
								</div>
								<div class="flex-grow-1 ms-3">
									<span class="text-dark">
										<span class="display-5 text-muted"><del>${{ number_format($product->list_price,2) }}</del></span>
										<span class="display-5 text-primary">${{ number_format($product->price,2) }}</span>
										<span>/mo</span>
									</span>
								</div>
							</div>
							<h6>Includes:</h6>
							<ul class="list-unstyled">
								<li class="mb-2">Unlimited users</li>
								<li class="mb-2">Unlimited projects</li>
								<li class="mb-2">250 GB storage</li>
								<li class="mb-2">Priority support</li>
								<li class="mb-2">Security policy	</li>
								<li class="mb-2">Daily backups</li>
								<li class="mb-2">Custom CSS</li>
							</ul>
							<div class="mt-auto">
								{{-- <a href="#" class="btn btn-lg btn-pill btn-outline-primary">Try it for free</a>
								<a href="{{ route('pricing') }}" class="btn btn-primary btn-lg btn-pill">Get Started</a> --}}
								
								@guest
									<a href="{{ route('home.checkout') }}" class="btn btn-primary btn-lg btn-pill">Get Started</a>
									<p class="small mt-2">All you need to start streamlining your Purchasing. No hidden costs.</p>
								@endguest
								@auth
									@if (auth()->user()->account_id == '')
										<a class="btn btn-primary btn-transition" href="{{ route('home.checkout') }}">Get started</a>
									@else
										{{-- <a class="btn btn-primary btn-transition" href="#">You already Have This</a> --}}
										<div class="alert alert-soft-info" role="alert">
											<div class="d-flex">
											<div class="flex-shrink-0">
												<i data-lucide="alert-circle"></i>
											</div>
											<div class="flex-grow-1 ms-2">
												You have already Purchased our service! 
												<a href="{{ route('accounts.show',auth()->user()->account_id) }}" class="btn btn-lg btn-pill btn-outline-primary">View Details</a>
											</div>
											</div>
										</div>
									@endif
								@endauth

							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection
