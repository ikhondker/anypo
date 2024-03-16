@extends('layouts.landlord')
@section('title', 'Pricing Plan')
@section('content')
	<!-- Pricing -->
	<div class="container content-space-2 content-space-lg-3">
		<!-- Heading -->
		<div class="w-md-75 w-lg-50 text-center mx-md-auto mb-5 mb-md-9">
			<h2 class="h1">Pricing</h2>
			<p>One simple pricing model. All you need to start. No additional costs.</p>
		</div>
		<!-- End Heading -->

		<div class="row align-items-lg-center">
			<div class="col-sm-6 col-lg-5 mb-9 mb-sm-0">
				<!-- Pricing -->
				<div class="card zi-2" data-aos="fade-up">
					<div class="card-body">
						<!-- Radio Button Group -->
						<div class="text-center mb-5">
							<div class="btn-group btn-group-segment" role="group" aria-label="Pricing radio button group">
								<input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off"
									checked>
								<label class="btn btn-sm" for="btnradio1">Monthly</label>

								<input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
								<label class="btn btn-sm disabled" for="btnradio2">
									<span class="form-switch-promotion">Annually

										<!-- Form Switch Promotion -->
										<span class="form-switch-promotion-container">
											<span class="form-switch-promotion-body">
												<svg class="form-switch-promotion-arrow" xmlns="http://www.w3.org/2000/svg"
													x="0px" y="0px" viewBox="0 0 99.3 57" width="48">
													<path fill="none" stroke="#bdc5d1" stroke-width="4"
														stroke-linecap="round" stroke-miterlimit="10"
														d="M2,39.5l7.7,14.8c0.4,0.7,1.3,0.9,2,0.4L27.9,42"></path>
													<path fill="none" stroke="#bdc5d1" stroke-width="4"
														stroke-linecap="round" stroke-miterlimit="10"
														d="M11,54.3c0,0,10.3-65.2,86.3-50"></path>
												</svg>
												<span class="form-switch-promotion-text">
													<span class="badge bg-primary rounded-pill ms-1">Coming soon</span>
												</span>
											</span>
										</span>
										<!-- End Form Switch Promotion -->
									</span>
								</label>
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
										class="display-4 text-muted fw-semibold"><del>{{ $product->list_price }}</del></span>
									<span class="display-3 text-primary fw-semibold">{{ $product->price }}</span>
									<span>/mo</span>
								</span>
							</div>
						</div>
						<!-- End Media -->

						<hr class="my-4">

						<div class="mb-5">
							{{ $product->name }}
							<p>All Functionalities.</p>
							<p>{{ $product->user }} User {{ $product->gb }} GB Space.</p>
							<p>Start your Front business now. 100% guaranteed money back. No questions asked.</p>
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
									<div class="alert alert-primary" role="alert">
										<div class="d-flex">
										  <div class="flex-shrink-0">
											<i class="bi bi-check-circle"></i>
										  </div>
										  <div class="flex-grow-1 ms-2">
											Information: Thanks for having this service already.
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

			<div class="col-sm-6 col-lg-7">
				<div class="ps-sm-6">
					<div class="row">
						<div class="col-sm-12 col-lg-6 mb-3" data-aos="fade-up" data-aos-delay="100">
							<span class="svg-icon text-primary mb-3">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="#035A4B"/>
								<path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="#035A4B"/>
								</svg>

							</span>

							<h4>Purchase Order Management</h4>
							<p>Streamline your purchasing workflow with easy-to-use purchase order management.</p>
						</div>
						<!-- End Col -->

						<div class="col-sm-12 col-lg-6 mb-3" data-aos="fade-up" data-aos-delay="150">
							<span class="svg-icon text-primary mb-3">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path opacity="0.3" d="M22 5V19C22 19.6 21.6 20 21 20H19.5L11.9 12.4C11.5 12 10.9 12 10.5 12.4L3 20C2.5 20 2 19.5 2 19V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5ZM7.5 7C6.7 7 6 7.7 6 8.5C6 9.3 6.7 10 7.5 10C8.3 10 9 9.3 9 8.5C9 7.7 8.3 7 7.5 7Z" fill="#035A4B"/>
								<path d="M19.1 10C18.7 9.60001 18.1 9.60001 17.7 10L10.7 17H2V19C2 19.6 2.4 20 3 20H21C21.6 20 22 19.6 22 19V12.9L19.1 10Z" fill="#035A4B"/>
								</svg>

							</span>

							<h4>Project Budget Control</h4>
							<p>Set spending limits for yout project, track your progress effortlessly and analyze if you're at risk of going over budget.</p>

						</div>
						<!-- End Col -->

						<div class="col-sm-12 col-lg-6 mb-3 mb-sm-0" data-aos="fade-up" data-aos-delay="200">
							<span class="svg-icon text-primary mb-3">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path opacity="0.3" d="M12 10.6L14.8 7.8C15.2 7.4 15.8 7.4 16.2 7.8C16.6 8.2 16.6 8.80002 16.2 9.20002L13.4 12L12 10.6ZM10.6 12L7.8 14.8C7.4 15.2 7.4 15.8 7.8 16.2C8 16.4 8.3 16.5 8.5 16.5C8.7 16.5 8.99999 16.4 9.19999 16.2L12 13.4L10.6 12Z" fill="#035A4B"/>
								<path d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM13.4 12L16.2 9.20001C16.6 8.80001 16.6 8.19999 16.2 7.79999C15.8 7.39999 15.2 7.39999 14.8 7.79999L12 10.6L9.2 7.79999C8.8 7.39999 8.2 7.39999 7.8 7.79999C7.4 8.19999 7.4 8.80001 7.8 9.20001L10.6 12L7.8 14.8C7.4 15.2 7.4 15.8 7.8 16.2C8 16.4 8.3 16.5 8.5 16.5C8.7 16.5 9 16.4 9.2 16.2L12 13.4L14.8 16.2C15 16.4 15.3 16.5 15.5 16.5C15.7 16.5 16 16.4 16.2 16.2C16.6 15.8 16.6 15.2 16.2 14.8L13.4 12Z" fill="#035A4B"/>
								</svg>

							</span>
							<h4>Approval Workflows</h4>
							<p>Implement customizable approval workflows to ensure that purchases are authorized and compliant with your organization's policies.</p>

						</div>
						<!-- End Col -->

						<div class="col-sm-12 col-lg-6" data-aos="fade-up" data-aos-delay="250">
							<span class="svg-icon text-primary mb-3">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path opacity="0.3" d="M12.5 22C11.9 22 11.5 21.6 11.5 21V3C11.5 2.4 11.9 2 12.5 2C13.1 2 13.5 2.4 13.5 3V21C13.5 21.6 13.1 22 12.5 22Z" fill="#035A4B"/>
								<path d="M17.8 14.7C17.8 15.5 17.6 16.3 17.2 16.9C16.8 17.6 16.2 18.1 15.3 18.4C14.5 18.8 13.5 19 12.4 19C11.1 19 10 18.7 9.10001 18.2C8.50001 17.8 8.00001 17.4 7.60001 16.7C7.20001 16.1 7 15.5 7 14.9C7 14.6 7.09999 14.3 7.29999 14C7.49999 13.8 7.80001 13.6 8.20001 13.6C8.50001 13.6 8.69999 13.7 8.89999 13.9C9.09999 14.1 9.29999 14.4 9.39999 14.7C9.59999 15.1 9.8 15.5 10 15.8C10.2 16.1 10.5 16.3 10.8 16.5C11.2 16.7 11.6 16.8 12.2 16.8C13 16.8 13.7 16.6 14.2 16.2C14.7 15.8 15 15.3 15 14.8C15 14.4 14.9 14 14.6 13.7C14.3 13.4 14 13.2 13.5 13.1C13.1 13 12.5 12.8 11.8 12.6C10.8 12.4 9.99999 12.1 9.39999 11.8C8.69999 11.5 8.19999 11.1 7.79999 10.6C7.39999 10.1 7.20001 9.39998 7.20001 8.59998C7.20001 7.89998 7.39999 7.19998 7.79999 6.59998C8.19999 5.99998 8.80001 5.60005 9.60001 5.30005C10.4 5.00005 11.3 4.80005 12.3 4.80005C13.1 4.80005 13.8 4.89998 14.5 5.09998C15.1 5.29998 15.6 5.60002 16 5.90002C16.4 6.20002 16.7 6.6 16.9 7C17.1 7.4 17.2 7.69998 17.2 8.09998C17.2 8.39998 17.1 8.7 16.9 9C16.7 9.3 16.4 9.40002 16 9.40002C15.7 9.40002 15.4 9.29995 15.3 9.19995C15.2 9.09995 15 8.80002 14.8 8.40002C14.6 7.90002 14.3 7.49995 13.9 7.19995C13.5 6.89995 13 6.80005 12.2 6.80005C11.5 6.80005 10.9 7.00005 10.5 7.30005C10.1 7.60005 9.79999 8.00002 9.79999 8.40002C9.79999 8.70002 9.9 8.89998 10 9.09998C10.1 9.29998 10.4 9.49998 10.6 9.59998C10.8 9.69998 11.1 9.90002 11.4 9.90002C11.7 10 12.1 10.1 12.7 10.3C13.5 10.5 14.2 10.7 14.8 10.9C15.4 11.1 15.9 11.4 16.4 11.7C16.8 12 17.2 12.4 17.4 12.9C17.6 13.4 17.8 14 17.8 14.7Z" fill="#035A4B"/>
								</svg>

							</span>

							<h4>Customer Support</h4>
							<p>Get help and support whenever you need it with our dedicated customer support team.</p>
						</div>
						<!-- End Col -->
					</div>
					<!-- End Row -->
				</div>
			</div>
			<!-- End Col -->
		</div>
		<!-- End Row -->
	</div>
	<!-- End Pricing -->
@endsection
