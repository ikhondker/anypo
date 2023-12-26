@extends('layouts.landlord')
@section('title', 'Pricing Plan')
@section('content')
	<!-- Pricing -->
	<div class="container content-space-2 content-space-lg-3">
		<!-- Heading -->
		<div class="w-md-75 w-lg-50 text-center mx-md-auto mb-5 mb-md-9">
			<h2 class="h1">Pricing</h2>
			<p>No additional costs. Pay for what you use.</p>
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
									src="{{ asset('/assets/svg/illustrations/oc-money-profits.svg') }}"
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
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
									xmlns="http://www.w3.org/2000/svg">
									<path opacity="0.3"
										d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z"
										fill="#035A4B" />
									<path
										d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z"
										fill="#035A4B" />
								</svg>
							</span>

							<h4>Hundreds of components</h4>
							<p>Achieve maximum productivity with minimum effort with Front and create robust limitless
								products.</p>
						</div>
						<!-- End Col -->

						<div class="col-sm-12 col-lg-6 mb-3" data-aos="fade-up" data-aos-delay="150">
							<span class="svg-icon text-primary mb-3">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
									xmlns="http://www.w3.org/2000/svg">
									<path opacity="0.3"
										d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z"
										fill="#035A4B" />
									<path
										d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z"
										fill="#035A4B" />
								</svg>
							</span>

							<h4>Images included</h4>
							<p>We made custom license for all our premium images in the Front.</p>
						</div>
						<!-- End Col -->

						<div class="col-sm-12 col-lg-6 mb-3 mb-sm-0" data-aos="fade-up" data-aos-delay="200">
							<span class="svg-icon text-primary mb-3">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
									xmlns="http://www.w3.org/2000/svg">
									<path opacity="0.3"
										d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z"
										fill="#035A4B" />
									<path
										d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z"
										fill="#035A4B" />
								</svg>
							</span>

							<h4>Cancel anytime</h4>
							<p>If its not for you, just cancel, no hidden costs or fees.</p>
						</div>
						<!-- End Col -->

						<div class="col-sm-12 col-lg-6" data-aos="fade-up" data-aos-delay="250">
							<span class="svg-icon text-primary mb-3">
								<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
									xmlns="http://www.w3.org/2000/svg">
									<path opacity="0.3"
										d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z"
										fill="#035A4B" />
									<path
										d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z"
										fill="#035A4B" />
								</svg>
							</span>
							<h4>Money back</h4>
							<p>100% guaranteed money back. No questions asked.</p>
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
