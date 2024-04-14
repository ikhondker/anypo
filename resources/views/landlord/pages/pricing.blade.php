@extends('layouts.landlord')
@section('title', 'Pricing Plan')
@section('content')
	<!-- Pricing -->
	<div class="container content-space-2 content-space-lg-3">
		<!-- Heading -->
		<div class="w-md-75 w-lg-50 text-center mx-md-auto mb-5 mb-md-9">
			<h2 class="h1 text-info">Pricing</h2>
			<p>One simple pricing model. All you need to start. No hidden costs.</p>
		</div>
		<!-- End Heading -->

		<div class="row align-items-lg-center">

			<div class="col-sm-4 col-lg-6">
				<div class="ps-sm-6">
					<div class="row">
						<div class="col-sm-12 col-lg-6 mb-3" data-aos="fade-up" data-aos-delay="100">
							<span class="svg-icon text-primary mb-3">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="#035A4B"/>
								<path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="#035A4B"/>
								</svg>

							</span>

							<h4 class="text-muted">Purchase Order Management</h4>
							<p>Streamline your purchasing workflow with easy-to-use purchase order management.</p>
						</div>
						<!-- End Col -->

						<div class="col-sm-12 col-lg-6 mb-3" data-aos="fade-up" data-aos-delay="150">
							<span class="svg-icon text-primary mb-3">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="#035A4B"/>
									<path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="#035A4B"/>
									</svg>

							</span>

							<h4 class="text-muted">Project Budget Control</h4>
							<p>Set spending limits for yout project, track your progress effortlessly and analyze if you're at risk of going over budget.</p>

						</div>
						<!-- End Col -->

						<div class="col-sm-12 col-lg-6 mb-3 mb-sm-0" data-aos="fade-up" data-aos-delay="200">
							<span class="svg-icon text-primary mb-3">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="#035A4B"/>
									<path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="#035A4B"/>
									</svg>
							</span>
							<h4 class="text-muted">Approval Workflows</h4>
							<p>Implement customizable approval workflows to ensure that purchases are authorized and compliant with your organization's policies.</p>

						</div>
						<!-- End Col -->

						<div class="col-sm-12 col-lg-6" data-aos="fade-up" data-aos-delay="250">
							<span class="svg-icon text-primary mb-3">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="#035A4B"/>
									<path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="#035A4B"/>
									</svg>

							</span>

							<h4 class="text-muted">Customer Support</h4>
							<p>Get help and support whenever you need it with our dedicated customer support team.</p>
						</div>
						<!-- End Col -->
					</div>
					<!-- End Row -->
				</div>
			</div>
			<!-- End Col -->

			<div class="col-sm-6 col-lg-6 mb-9 mb-sm-0">
				<!-- Pricing -->
				<div class="card zi-2" data-aos="fade-up">
					<div class="card-body">
						<!-- Radio Button Group -->
						<div class="text-center mb-5">
							<div class="btn-group btn-group-segment" role="group" aria-label="Pricing radio button group">
								<input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off"
									checked>
								<label class="btn btn-sm" for="btnradio1">One simple pricing model!</label>

								<input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
								
							</div>
						</div>
						<!-- End Radio Button Group -->

						<!-- Media -->
						<div class="d-flex align-items-end">
							<div class="flex-shrink-0">
								<img class="avatar avatar-lg avatar-4x3"
									src="{{ Storage::disk('s3l')->url('svg/illustrations/oc-money-profits.svg') }}"
									alt="Image Description">
							</div>

							<div class="flex-grow-1 ms-3">
								<span class="text-dark">
									<span class="fs-5 align-top text-dark fw-semibold">$</span>
									<span
										class="display-5 text-muted fw-semibold"><del>{{ number_format($product->list_price,2) }}</del></span>
									<span class="display-4 text-primary fw-semibold">{{ number_format($product->price,2) }}</span>
									<span>/mo</span>
								</span>
							</div>
						</div>
						<!-- End Media -->

						<hr class="my-4">

						<div class="">
							<p class="h3 mb-6 text-dark">{{ $product->name }}
								<br><span class="small">All Functionalities.</span>
							</p>
							<p class="small">All you need to start streamlining your Purchasing. No hidden costs.</p>
						</div>

						<div class="d-grid">
							@guest
								<a class="btn btn-primary btn-transition" href="{{ route('home.checkout') }}">Get started</a>
							@endguest
							@auth
								@if (auth()->user()->account_id == '')
									<a class="btn btn-primary btn-transition" href="{{ route('home.checkout') }}">Get started</a>
								@else
									{{-- <a class="btn btn-primary btn-transition" href="#">You already Have This</a> --}}
									<div class="alert alert-soft-info" role="alert">
										<div class="d-flex">
										  <div class="flex-shrink-0">
											<i class="bi bi-check-circle"></i>
										  </div>
										  <div class="flex-grow-1 ms-2">
											You have already Purchased our service! <a  class="text-primary" href="{{ route('accounts.show',auth()->user()->account_id) }}">View Details</a>
										  </div>
										</div>
									  </div>
								@endif
							@endauth

						</div>
					</div>
				</div>
				<!-- End Pricing -->
			</div>
			<!-- End Col -->


		</div>
		<!-- End Row -->
	</div>
	<!-- End Pricing -->
@endsection
