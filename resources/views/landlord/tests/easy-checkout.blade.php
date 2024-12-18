@extends('layouts.site')
@section('title','Checkout')

@section('content')


{{-- https://getbootstrap.com/docs/5.1/examples/checkout/ --}}
<div class="container">
		<main>

			<div class="py-5 text-center">
				{{-- <img class="d-block mx-auto mb-4" src="../assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> --}}
				<h2>Checkout form</h2>
				<p class="lead">Below is an example form built entirely with Bootstrap’s form controls. Each required form group has a validation state that can be triggered by attempting to submit the form without completing it.</p>
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
								<h6 class="my-0">Product name</h6>
								<small class="text-muted">Brief description</small>
							</div>
							<span class="text-muted">$20</span>
						</li>
						{{-- <li class="list-group-item d-flex justify-content-between bg-light">
							<div class="text-success">
								<h6 class="my-0">Promo code</h6>
								<small>EXAMPLECODE</small>
							</div>
							<span class="text-success">−$5</span>
						</li> --}}
						<li class="list-group-item d-flex justify-content-between">
							<span>Total (USD)</span>
							<strong>$20</strong>
						</li>
					</ul>

					{{-- <form class="card p-2">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Promo code">
							<button type="submit" class="btn btn-secondary">Redeem</button>
						</div>
					</form> --}}
				</div>
				<div class="col-md-7 col-lg-8">
					<h4 class="mb-3">Account Detail</h4>
					{{-- <form action="{{ url('/pay') }}" method="POST" class="needs-validation">
						<input type="hidden" value="{{ csrf_token() }}" name="_token" /> --}}

						<form method="POST" class="needs-validation" novalidate>
						<input type="hidden" value="{{ csrf_token() }}" name="_token" />

						<div class="row g-3">

								<div class="col-12">
										<label for="username" class="form-label">Sitename</label>
										<div class="input-group has-validation">
												<input type="text" class="form-control form-control-sm" id="username" value="XYZ" placeholder="sitename" required>
												<span class="input-group-text">.anypo.com</span>
												<div class="invalid-feedback">
														Your username is required.
												</div>
										</div>
								</div>

								<div class="col-sm-12">
										<label for="firstName" class="form-label">Your Name</label>
										<input type="text" class="form-control form-control-sm" id="firstName" placeholder="" value="John Doe" required>
										<div class="invalid-feedback">
											Valid first name is required.
										</div>
									</div>

							<div class="col-6">
								<label for="email" class="form-label">Your Email</label>
								<input type="email" class="form-control form-control-sm" id="email" value="you@example.com" placeholder="you@example.com" required>
								<div class="invalid-feedback">
									Please enter a valid email address.
								</div>
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
