@extends('layouts.landlord')
@section('title','Checkout')

@section('content')

	<!-- Content -->
	<div class="container content-space-1 content-space-lg-2">
		<div class="row">
		<div class="col-lg-8 mb-7 mb-lg-0">
			<!-- Heading -->
			<div class="d-flex justify-content-between align-items-end border-bottom pb-3 mb-7">
				<h1 class="h3 mb-0">Checkout</h1>
				<span>1 item</span>
			</div>
			<!-- End Heading -->

			<!-- Form -->
			<div class="container">
				<main>
					<div class="row g-5">

						<div class="col-md-7 col-lg-8">
							<h4 class="mb-3">Product Detail</h4>
							<form action="{{ url('/pay') }}" method="POST" class="needs-validation">

								{{-- <form method="POST" class="needs-validation" novalidate> --}}
								<input type="hidden" value="{{ csrf_token() }}" name="_token" />
								{{-- <input type="hidden" name="product_id" value="{{ $id }}"> --}}

								<div class="row g-3">
									<div class="col-12">
										<label for="site" class="form-label">Site Name*</label>
										<div class="input-group has-validation">
											{{-- <input type="text" class="form-control form-control-sm" id="site"  value="XYZ" placeholder="sitename"> --}}
											<input type="text" class="form-control form-control-sm"
												name="site" id="site" placeholder="sitename"
												value="{{ old('site', "XYZ" ) }}"
												class="@error('site') is-invalid @enderror" required>
											<span class="input-group-text">.anypo.net</span>
										</div>
											@error('site')
												<div class="text-danger text-xs">{{ $message }}</div>
											@enderror
									</div>

									<div class="col-12">
										<label for="email" class="form-label">Business Email*</label>
										@auth
											<input type="email" class="form-control form-control-sm"
												name="email" id="email" placeholder="you@example.com"
												value="{{ old('email', auth()->user()->email )  }}"
												class="@error('email') is-invalid @enderror" hidden>
											@error('email')
												<div class="text-danger text-xs">{{ $message }}</div>
											@enderror
											{{ auth()->user()->email  }}
										@endauth
										@guest
											<input type="email" class="form-control form-control-sm"
												name="email" id="email" placeholder="you@example.com"
												value="{{ old('email', "you@example.com") }}"
												class="@error('email') is-invalid @enderror" required>
											@error('email')
												<div class="text-danger text-xs">{{ $message }}</div>
											@enderror
										@endguest

									</div>

									<div class="col-sm-12">
										<label for="name" class="form-label">Your/Company Name*</label>
										@auth
											<input type="text" class="form-control form-control-sm"
												name="account_name" id="account_name" placeholder="John Doe"
												value="{{ old('account_name', auth()->user()->name ) }}"
												class="@error('account_name') is-invalid @enderror" hidden>
												@error('account_name')
													<div class="text-danger text-xs">{{ $message }}</div>
												@enderror
										@endauth
										@guest
											<input type="text" class="form-control form-control-sm"
												name="account_name" id="account_name" placeholder="John Doe"
												value="{{ old('account_name', "John Doe" ) }}"
												class="@error('account_name') is-invalid @enderror" required>
												@error('account_name')
													<div class="text-danger text-xs">{{ $message }}</div>
												@enderror
										@endguest
									</div>

								   
								</div>

								<hr class="my-4">

								<h4 class="mb-3">Payment</h4>

								<span class="text-muted certificate-text"><i class="fa fa-lock"></i> Your transaction is secured with ssl certificate</span>
								<hr class="my-4">

								<button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>

								<button class="btn btn-primary btn-lg btn-block" id="sslczPayBtn"
									token="if you have any token validation"
									postdata="your javascript arrays or objects which requires in backend"
									order="If you already have the transaction generated for current order"
									endpoint="{{ url('/pay-via-ajax') }}"> Pay Now
								</button>

								<button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout (*Hosted*)</button>

							</form>
						</div>
					</div>
				</main>
			</div>

			<!-- End Form -->
		</div>
		<!-- End Col -->

		<div class="col-lg-4">
			<div class="ps-lg-4">
			<!-- Card -->
			<div class="card card-sm shadow-sm mb-4">
				<div class="card-body">
				<div class="border-bottom pb-4 mb-4">
					<h3 class="card-header-title">Order summary</h3>
				</div>

				<form>

					<div class="border-bottom pb-4 mb-4">
						<div class="d-grid gap-3">
							<div class="row">
								<div class="col-sm-8">
									<p class="h4">{{ $product->sku }}</p>
									<span class="small">{{ $product->name }}</span><br>
									<span class="small">{{ $product->user }} User {{ $product->gb }} GB Space.<span><br>
									<span class="small">All Functionalities.<span> 
								</div>
								<div class="col-sm-4 text-end h3">
									${{ $product->price }}
								</div>
							</div>
							<div class="row">
							</div>
							<div class="row">
							</div>
							
						</div>
					</div>
					<div class="d-grid gap-3 mb-4">
						<dl class="row">
							<dt class="col-sm-6">Total</dt>
							<dd class="col-sm-6 text-sm-end mb-0">${{ $product->price }}</dd>
						</dl>
						<!-- End Row -->
					</div>
					<div class="d-grid">
						<a class="btn btn-primary btn-lg" href="../demo-shop/checkout.html">Checkout</a>
					</div>
				</form>
				</div>
				<!-- End Card -->
			</div>

			<!-- Media -->
			<div class="d-flex align-items-center">
				<div class="flex-shrink-0">
				<div class="svg-icon svg-icon-sm text-primary">
					<span class="svg-icon svg-icon-sm text-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="com/com012.svg">
						<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M22.1671 18.1421C22.4827 18.4577 23.0222 18.2331 23.0206 17.7868L23.0039 13.1053V5.52632C23.0039 4.13107 21.8729 3 20.4776 3H8.68815C7.2929 3 6.16183 4.13107 6.16183 5.52632V9H13C14.6568 9 16 10.3431 16 12V15.6316H19.6565L22.1671 18.1421Z" fill="#035A4B"/>
						<path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M1.98508 18V13C1.98508 11.8954 2.88051 11 3.98508 11H11.9851C13.0896 11 13.9851 11.8954 13.9851 13V18C13.9851 19.1046 13.0896 20 11.9851 20H4.10081L2.85695 21.1905C2.53895 21.4949 2.01123 21.2695 2.01123 20.8293V18.3243C1.99402 18.2187 1.98508 18.1104 1.98508 18ZM5.99999 14.5C5.99999 14.2239 6.22385 14 6.49999 14H11.5C11.7761 14 12 14.2239 12 14.5C12 14.7761 11.7761 15 11.5 15H6.49999C6.22385 15 5.99999 14.7761 5.99999 14.5ZM9.49999 16C9.22385 16 8.99999 16.2239 8.99999 16.5C8.99999 16.7761 9.22385 17 9.49999 17H11.5C11.7761 17 12 16.7761 12 16.5C12 16.2239 11.7761 16 11.5 16H9.49999Z" fill="#035A4B"/>
						</svg>

					  </span>

					{{-- @@include("../assets/vendor/duotone-icons/com/com012.svg") --}}
				</div>
				</div>
				<div class="flex-grow-1 ms-2">
				<span class="small me-1">Need Help?</span>
				<a class="link small" href="#">Chat now</a>
				</div>
			</div>
			<!-- End Media -->
			</div>
		</div>
		<!-- End Col -->
		</div>
		<!-- End Row -->
	</div>
	<!-- End Content -->
@endsection


@section('bo04-content')

	<div class="container">
		<main>
			<div class="py-5 text-center">
				{{-- <img class="d-block mx-auto mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> --}}
				<h2>Checkout</h2>
				<p class="lead">Below is an example form built entirely with Bootstrap’s form controls. Each form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
			</div>
			<div class="row g-5">
				<div class="col-md-5 col-lg-4 order-md-last">
				<h4 class="d-flex justify-content-between align-items-center mb-3">
				<span class="text-primary">Your cart</span>
				<span class="badge bg-primary rounded-pill">1</span>
				</h4>
				<ul class="list-group mb-3">
				<li class="list-group-item d-flex justify-content-between lh-sm">
					<div>
					<h6 class="my-0">{{ $product->sku }}</h6>
					<small class="text-muted">Brief description {{ $product->name }}</small>
					</div>
					<span class="text-muted">${{ $product->price }}</span>
				</li>

				<li class="list-group-item d-flex justify-content-between">
					<span>Total (USD)</span>
					<strong>${{ $product->price }}</strong>
				</li>
				</ul>


				</div>
				<div class="col-md-7 col-lg-8">
				<h4 class="mb-3">product Detail</h4>
				<form action="{{ url('/pay') }}" method="POST" class="needs-validation">
					{{-- <form method="POST" class="needs-validation" novalidate> --}}

					<input type="hidden" value="{{ csrf_token() }}" name="_token" />
					{{-- <input type="hidden" name="product_id" value="{{ $id }}"> --}}

					<div class="row g-3">
						<div class="col-12">
							<label for="site" class="form-label">Sitename</label>
							<div class="input-group has-validation">
								{{-- <input type="text" class="form-control form-control-sm" id="site"  value="XYZ" placeholder="sitename"> --}}
								<input type="text" class="form-control form-control-sm"
									name="site" id="site" placeholder="sitename"
									value="{{ old('site', "XYZ" ) }}"
									class="@error('site') is-invalid @enderror" required>
								<span class="input-group-text">.anypo.com</span>
							</div>
								@error('site')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
						</div>

						<div class="col-12">
							<label for="email" class="form-label">Your Email</label>
							@auth
								<input type="email" class="form-control form-control-sm"
								name="email" id="email" placeholder="you@example.com"
								value="{{ old('email', auth()->user()->email )  }}"
								class="@error('email') is-invalid @enderror" hidden>
								@error('email')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
								{{ auth()->user()->email  }}
							@endauth
							@guest
								<input type="email" class="form-control form-control-sm"
								name="email" id="email" placeholder="you@example.com"
								value="{{ old('email', "you@example.com") }}"
								class="@error('email') is-invalid @enderror" required>
								@error('email')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							@endguest

						</div>

						<div class="col-sm-12">
							<label for="name" class="form-label">Your Name</label>
							@auth
								<input type="text" class="form-control form-control-sm"
									name="name" id="name" placeholder="John Doe"
									value="{{ old('name', auth()->user()->name ) }}"
									class="@error('name') is-invalid @enderror" hidden>
									@error('name')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
									{{ auth()->user()->name  }}
							@endauth
							@guest
								<input type="text" class="form-control form-control-sm"
									name="name" id="name" placeholder="John Doe"
									value="{{ old('name', "John Doe" ) }}"
									class="@error('name') is-invalid @enderror" required>
									@error('name')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
							@endguest
						</div>

						<div class="col-sm-12">
							<label for="account_name" class="form-label">Company Name</label>
							<input type="text" class="form-control form-control-sm"
										name="account_name" id="account_name" placeholder="My Company Name"
										value="{{ old('account_name', "My Company Name" ) }}"
										class="@error('account_name') is-invalid @enderror">
										@error('account_name')
											<div class="text-danger text-xs">{{ $message }}</div>
										@enderror
							{{-- <input type="text" class="form-control form-control-sm" id="account_name" placeholder="" value="Your Company Name">
							<div class="invalid-feedback">
							Valid account_name is.
							</div> --}}
						</div>
					</div>

				<hr class="my-4">

				<h4 class="mb-3">Payment</h4>

				<span class="text-muted certificate-text"><i class="fa fa-lock"></i> Your transaction is secured with ssl certificate</span>
				<hr class="my-4">

				<button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>

				<button class="btn btn-primary btn-lg btn-block" id="sslczPayBtn"
					token="if you have any token validation"
					postdata="your javascript arrays or objects which requires in backend"
					order="If you already have the transaction generated for current order"
					endpoint="{{ url('/pay-via-ajax') }}"> Pay Now
				</button>

				<button class="btn btn-primary btn-lg btn-block" type="submit">Continue to checkout (Hosted)</button>

				</form>
				</div>
			</div>
		</main>
	</div>


	<!-- Start -->
	<section class="section">
		<div class="container mt-100 mt-60">
			<div class="row">
				<div class="col-md-3 col-6">
					<div class="counter-box position-relative text-center">
						<h2 class="mb-0 display-1 fw-bold title-dark mt-2 opacity-05"><span class="counter-value" data-target="5458">3</span></h2>
						<span class="counter-head fw-semibold title-dark position-absolute top-50 start-50 translate-middle">Investment Projects</span>
					</div><!--end counter box-->
				</div><!--end col-->

				<div class="col-md-3 col-6">
					<div class="counter-box position-relative text-center">
						<h2 class="mb-0 display-1 fw-bold title-dark mt-2 opacity-05"><span class="counter-value" data-target="15">1</span></h2>
						<span class="counter-head fw-semibold title-dark position-absolute top-50 start-50 translate-middle">Years of Experience</span>
					</div><!--end counter box-->
				</div><!--end col-->

				<div class="col-md-3 col-6">
					<div class="counter-box position-relative text-center">
						<h2 class="mb-0 display-1 fw-bold title-dark mt-2 opacity-05"><span class="counter-value" data-target="54">0</span></h2>
						<span class="counter-head fw-semibold title-dark position-absolute top-50 start-50 translate-middle">Offices in the World</span>
					</div><!--end counter box-->
				</div><!--end col-->

				<div class="col-md-3 col-6">
					<div class="counter-box position-relative text-center">
						<h2 class="mb-0 display-1 fw-bold title-dark mt-2 opacity-05"><span class="counter-value" data-target="214">3</span></h2>
						<span class="counter-head fw-semibold title-dark position-absolute top-50 start-50 translate-middle">Successful Cases</span>
					</div><!--end counter box-->
				</div><!--end col-->
			</div><!--end row-->
		</div><!--end container-->
	</section><!--end section-->
	<!-- End -->

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
		integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
		crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
		integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
		crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
		integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
		crossorigin="anonymous"></script>

	<!-- If you want to use the popup integration, -->
	<script>
	var obj = {};
	obj.cus_name = $('#customer_name').val();
	obj.cus_phone = $('#mobile').val();
	obj.cus_email = $('#email').val();
	obj.cus_addr1 = $('#address').val();
	obj.amount = $('#total_amount').val();

	$('#sslczPayBtn').prop('postdata', obj);

	(function (window, document) {
		var loader = function () {
			var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
			// script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
			script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR SANDBOX
			tag.parentNode.insertBefore(script, tag);
		};

		window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
	})(window, document);
	</script>

@endsection