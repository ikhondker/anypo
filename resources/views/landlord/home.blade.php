@extends('layouts.landlord.page')
@section('title','Control Expenses - anypo.net')
@section('content')

<section class="landing-intro text-bg-dark pt-5 pt-lg-6 pb-5 pb-lg-7">
    <div class="landing-intro-content container ">
        <div class="row align-items-center">
            <div class="col-lg-5 mx-auto">
                <span class="badge badge-subtle-primary p-1">Free Trial</span>

                <h1 class="my-4 text-white">AppStack is the perfect Admin Template <span class="text-primary">for your next project</span></h1>

                <p class="text-lg text-white-50">A professional package that comes with hundreds of UI components, forms, tables, charts, dashboards, pages and svg icons.</p>

                <div class="my-4">
                    <div class="d-inline-block me-3">
                        <h2 class="text-white">500+</h2>
                        <span class="text-white-50">UI Components</span>
                    </div>
                    <div class="d-inline-block me-3">
                        <h2 class="text-white">1500+</h2>
                        <span class="text-white-50">SVG Icons</span>
                    </div>
                    <div class="d-inline-block">
                        <h2 class="text-white">75+</h2>
                        <span class="text-white-50">HTML Pages</span>
                    </div>
                </div>
                <div class="my-4">
                    <a href="https://themes.getbootstrap.com/product/appstack-responsive-admin-template/" target="_blank" class="btn btn-primary btn-lg btn-pill">Get Started</a>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-flex mx-auto text-center">
                <div class="landing-intro-screenshot pb-3">
                    <img src="{{ asset('/assets/img/screenshots/mixed.jpg') }}" alt="Dark/Light Bootstrap Admin Template" class="img-fluid" />
                </div>
            </div>
        </div>
    </div>
</section>


	<!-- Hero -->
	{{-- <div class="position-relative bg-img-start" style="background-image: url({{ Storage::disk('s3l')->url('svg/components/card-11.svg') }});"> --}}
	<div class="position-relative bg-img-start" style="background-image: url({{asset('/assets/bg/card-11.svg')}});">
		<div class="container content-space-t-3 content-space-t-lg-5 content-space-b-2 content-space-b-lg-3 position-relative zi-2">
			<div class="row justify-content-lg-between align-items-md-center">
				<div class="col-md-6 col-lg-5 mb-10 mb-md-0">
					<div class="mb-5">
						<h1 class="display-4">Streamline Your Purchasing. Supercharge Your Growth.</h1>
						<p class="lead">
						Struggling with managing expenses and staying within budget? We offer a seamless purchasing and budget control solution that streamlines workflows, automates tasks, and gives you real-time spending insights.</p>
					</div>

					<div class="d-flex align-items-center gap-2 mb-8">
						<a class="btn btn-primary btn-transition me-2" href="{{ route('pricing') }}">
							Get Started <i class="bi-chevron-right small ms-1"></i>
						</a>

						<!-- Fancybox -->
						<!-- <a class="video-player btn btn-outline-primary btn-transition" href="https://www.youtube.com/watch?v=d4eDWc8g0e0" role="button" data-fslightbox="youtube-video">
							<i class="bi-play-circle-fill me-1"></i> Play video
						</a> -->
						<!-- End Fancybox -->
					</div>
				</div>
				<!-- End Col -->

				<div class="col-md-6">
					<div class="row justify-content-end">
						<div class="col-3 mb-4">
							<!-- Logo -->
							<div class="d-block avatar avatar-lg rounded-circle shadow-sm p-2 mt-n3 ms-5" data-aos="fade-up">
								<img class="avatar-img" src="{{ Storage::disk('s3l')->url('currency/yen.svg') }}" alt="Image Description">
							</div>
							<!-- End Logo -->
						</div>
						<div class="col-4 mb-4">
							<!-- Logo -->
							<div class="d-block avatar avatar-xl rounded-circle shadow-sm p-2 mx-auto mt-5" data-aos="fade-up" data-aos-delay="50">
								<img class="avatar-img" src="{{ Storage::disk('s3l')->url('currency/dollar.svg') }}" alt="Image Description">
							</div>
							<!-- End Logo -->
						</div>
						<div class="col-4 mb-4">
							<!-- Logo -->
							<div class="d-block avatar avatar-xl rounded-circle shadow-sm p-3 ms-auto" data-aos="fade-up" data-aos-delay="150">
								<img class="avatar-img" src="{{ Storage::disk('s3l')->url('currency/euro.svg') }}" alt="Image Description">
							</div>
							<!-- End Logo -->
						</div>
					</div>

					<div class="row">
						<div class="col-3 offset-1 my-4">
							<!-- Logo -->
							<div class="d-block avatar avatar-xl rounded-circle shadow-sm p-3 ms-auto" data-aos="fade-up" data-aos-delay="200">
								<img class="avatar-img" src="{{ Storage::disk('s3l')->url('currency/ruble.svg') }}" alt="Image Description">
							</div>
							<!-- End Logo -->
						</div>
						<div class="col-3 offset-2 my-4">
							<!-- Logo -->
							<div class="d-block avatar avatar-xl rounded-circle shadow-sm p-3 ms-auto" data-aos="fade-up" data-aos-delay="250">
								<img class="avatar-img" src="{{ Storage::disk('s3l')->url('currency/rupee.svg') }}" alt="Image Description">
							</div>
							<!-- End Logo -->
						</div>
					</div>

					<div class="row d-none d-md-flex">
						<div class="col-6">
							<!-- Logo -->
							<div class="d-block avatar avatar-lg rounded-circle shadow-sm p-3 ms-auto" data-aos="fade-up" data-aos-delay="300">
								<img class="avatar-img" src="{{ Storage::disk('s3l')->url('currency/lira.svg') }}" alt="Image Description">
							</div>
							<!-- End Logo -->
						</div>
						<div class="col-6 mt-6">
							<!-- Logo -->
							<div class="d-block avatar avatar-xl rounded-circle shadow-sm p-2 ms-auto" data-aos="fade-up" data-aos-delay="350">
								<img class="avatar-img" src="{{ Storage::disk('s3l')->url('currency/pound.svg') }}" alt="Image Description">
							</div>
							<!-- End Logo -->
						</div>
					</div>
				</div>
				<!-- End Col -->
			</div>
			<!-- End Row -->
		</div>

		<!-- Shape -->
		<div class="shape shape-bottom zi-1">
			<svg width="3000" height="500" viewBox="0 0 3000 500" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M0 500H3000V0L0 500Z" fill="#fff"/>
			</svg>
		</div>
		<!-- End Shape -->
	</div>
	<!-- End Hero -->

	<!-- Feature Nav -->
	<div class="container content-space-1">
		<!-- Heading -->
		<div class="w-md-75 w-lg-50 text-center mx-md-auto mb-5 mb-md-9">
			<span class="text-cap">What's ANYPO.NET?</span>
			<h2>The All-in-One Purchasing and Expense Control Solution Built for Small Businesses and Startups.</h2>
		</div>
		<!-- End Heading -->

		<div class="row align-items-lg-center">
			<div class="col-lg-5 order-lg-2 mb-7 mb-lg-0">
				<!-- Nav Scroller -->
				<div class="js-nav-scroller hs-nav-scroller-horizontal">
					<span class="hs-nav-scroller-arrow-prev" style="display: none;">
						<a class="hs-nav-scroller-arrow-link" href="javascript:;">
							<i class="bi-chevron-left"></i>
						</a>
					</span>

					<span class="hs-nav-scroller-arrow-next" style="display: none;">
						<a class="hs-nav-scroller-arrow-link" href="javascript:;">
							<i class="bi-chevron-right"></i>
						</a>
					</span>

					<!-- Nav Pills -->
					<ul class="nav nav-lg nav-pills nav-pills-shadow flex-lg-column gap-lg-1 p-3" id="featuresTab" role="tablist">
						<li class="nav-item" role="presentation">
							<a class="nav-link active" href="#featuresOne" id="featuresOne-tab" data-bs-toggle="tab" data-bs-target="#featuresOne" role="tab" aria-controls="featuresOne" aria-selected="true" style="min-width: 20rem;">
								<!-- Media -->
								<div class="d-flex align-items-center align-items-lg-start">
									<span class="svg-icon svg-icon-sm text-primary">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path opacity="0.3" d="M22 19V17C22 16.4 21.6 16 21 16H8V3C8 2.4 7.6 2 7 2H5C4.4 2 4 2.4 4 3V19C4 19.6 4.4 20 5 20H21C21.6 20 22 19.6 22 19Z" fill="#035A4B"/>
										<path d="M20 5V21C20 21.6 19.6 22 19 22H17C16.4 22 16 21.6 16 21V8H8V4H19C19.6 4 20 4.4 20 5ZM3 8H4V4H3C2.4 4 2 4.4 2 5V7C2 7.6 2.4 8 3 8Z" fill="#035A4B"/>
										</svg>
									</span>
									<div class="flex-grow-1 ms-3">
										<h4 class="mb-1">Purchase Order Management	</h4>
										<p class="text-body text-wrap mb-0">Streamline your purchasing workflow with easy-to-use purchase order management..</p>
									</div>
								</div>
								<!-- End Media -->
							</a>
						</li>

						<li class="nav-item" role="presentation">
							<a class="nav-link" href="#featuresTwo" id="featuresTwo-tab" data-bs-toggle="tab" data-bs-target="#featuresTwo" role="tab" aria-controls="featuresTwo" aria-selected="false" style="min-width: 20rem;">
								<!-- Media -->
								<div class="d-flex align-items-center align-items-lg-start">
									<span class="svg-icon svg-icon-sm text-primary">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd" clip-rule="evenodd" d="M15 19.5229C15 20.265 15.9624 20.5564 16.374 19.9389L22.2227 11.166C22.5549 10.6676 22.1976 10 21.5986 10H17V4.47708C17 3.73503 16.0376 3.44363 15.626 4.06106L9.77735 12.834C9.44507 13.3324 9.80237 14 10.4014 14H15V19.5229Z" fill="#035A4B"/>
										<path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M3 6.5C3 5.67157 3.67157 5 4.5 5H9.5C10.3284 5 11 5.67157 11 6.5C11 7.32843 10.3284 8 9.5 8H4.5C3.67157 8 3 7.32843 3 6.5ZM3 18.5C3 17.6716 3.67157 17 4.5 17H9.5C10.3284 17 11 17.6716 11 18.5C11 19.3284 10.3284 20 9.5 20H4.5C3.67157 20 3 19.3284 3 18.5ZM2.5 11C1.67157 11 1 11.6716 1 12.5C1 13.3284 1.67157 14 2.5 14H6.5C7.32843 14 8 13.3284 8 12.5C8 11.6716 7.32843 11 6.5 11H2.5Z" fill="#035A4B"/>
										</svg>
									</span>
									<div class="flex-grow-1 ms-3">
										<h4 class="mb-1">Expense Control</h4>
										<p class="text-body text-wrap mb-0">Set spending limits for your departments and projects, track your progress effortlessly and analyze if you're at risk of going over budget.</p>
									</div>
								</div>
								<!-- End Media -->
							</a>
						</li>

						<li class="nav-item" role="presentation">
							<a class="nav-link" href="#featuresThree" id="featuresThree-tab" data-bs-toggle="tab" data-bs-target="#featuresThree" role="tab" aria-controls="featuresThree" aria-selected="false" style="min-width: 20rem;">
								<!-- Media -->
								<div class="d-flex align-items-center align-items-lg-start">
									<span class="svg-icon svg-icon-sm text-primary">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M17.2718 8.68537C16.8933 8.28319 16.9125 7.65032 17.3146 7.2718C17.7168 6.89329 18.3497 6.91246 18.7282 7.31464L22.7282 11.5646C23.0906 11.9497 23.0906 12.5503 22.7282 12.9354L18.7282 17.1854C18.3497 17.5875 17.7168 17.6067 17.3146 17.2282C16.9125 16.8497 16.8933 16.2168 17.2718 15.8146L20.6268 12.25L17.2718 8.68537Z" fill="#035A4B"/>
										<path d="M6.7282 8.68537C7.10671 8.28319 7.08754 7.65032 6.68536 7.2718C6.28319 6.89329 5.65031 6.91246 5.2718 7.31464L1.2718 11.5646C0.909397 11.9497 0.909397 12.5503 1.2718 12.9354L5.2718 17.1854C5.65031 17.5875 6.28319 17.6067 6.68536 17.2282C7.08754 16.8497 7.10671 16.2168 6.7282 15.8146L3.37325 12.25L6.7282 8.68537Z" fill="#035A4B"/>
										<rect opacity="0.3" x="12.7388" y="3.97168" width="2" height="16" rx="1" transform="rotate(12.3829 12.7388 3.97168)" fill="#035A4B"/>
										</svg>
									</span>
									<div class="flex-grow-1 ms-3">
										<h4 class="mb-1">Approval Workflows</h4>
										<p class="text-body text-wrap mb-0">Implement customizable approval workflows to ensure that purchases are authorized and compliant with your organization's policies.</p>
									</div>
								</div>
								<!-- End Media -->
							</a>
						</li>

						<li class="nav-item" role="presentation">
							<a class="nav-link" href="#featuresThree" id="featuresThree-tab" data-bs-toggle="tab" data-bs-target="#featuresThree" role="tab" aria-controls="featuresThree" aria-selected="false" style="min-width: 20rem;">
								<!-- Media -->
								<div class="d-flex align-items-center align-items-lg-start">
									<span class="svg-icon svg-icon-sm text-primary">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
										  <path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="#035A4B" />
										  <path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="#035A4B" />
										</svg>

									  </span>
									<div class="flex-grow-1 ms-3">
										<h4 class="mb-1">Easy Integration (with Core Accounting System)</h4>
										<p class="text-body text-wrap mb-0">Simple file based integration simplifies consolidated reporting from core accounting system. It reduces the need for manual data entry, allowing information to flow across the system.</p>
									</div>
								</div>
								<!-- End Media -->
							</a>
						</li>
					</ul>
					<!-- End Nav Pills -->
				</div>
				<!-- End Nav Scroller -->
			</div>
			<!-- End Col -->

			<div class="col-lg-7 order-lg-1">
				<!-- Tab Content -->
				<div class="tab-content" id="featuresTabContent">
					<div class="tab-pane fade show active" id="featuresOne" role="tabpanel" aria-labelledby="featuresOne-tab">
						<!-- Browser Device -->
						<figure class="device-browser">
							<div class="device-browser-header">
								<div class="device-browser-header-btn-list">
									<span class="device-browser-header-btn-list-btn"></span>
									<span class="device-browser-header-btn-list-btn"></span>
									<span class="device-browser-header-btn-list-btn"></span>
								</div>
								<div class="device-browser-header-browser-bar">www.htmlstream.com/front/</div>
							</div>

							<div class="device-browser-frame">
								<img class="device-browser-img" src="{{ Storage::disk('s3l')->url('img/1618x1010/img1.jpg') }}" alt="Image Description">
							</div>
						</figure>
						<!-- End Browser Device -->
					</div>

					<div class="tab-pane fade" id="featuresTwo" role="tabpanel" aria-labelledby="featuresTwo-tab">
						<!-- Browser Device -->
						<figure class="device-browser">
							<div class="device-browser-header">
								<div class="device-browser-header-btn-list">
									<span class="device-browser-header-btn-list-btn"></span>
									<span class="device-browser-header-btn-list-btn"></span>
									<span class="device-browser-header-btn-list-btn"></span>
								</div>
								<div class="device-browser-header-browser-bar">www.htmlstream.com/front/</div>
							</div>

							<div class="device-browser-frame">
								<img class="device-browser-img" src="{{ Storage::disk('s3l')->url('img/1618x1010/img2.jpg') }}" alt="Image Description">
							</div>
						</figure>
						<!-- End Browser Device -->
					</div>

					<div class="tab-pane fade" id="featuresThree" role="tabpanel" aria-labelledby="featuresThree-tab">
						<!-- Browser Device -->
						<figure class="device-browser">
							<div class="device-browser-header">
								<div class="device-browser-header-btn-list">
									<span class="device-browser-header-btn-list-btn"></span>
									<span class="device-browser-header-btn-list-btn"></span>
									<span class="device-browser-header-btn-list-btn"></span>
								</div>
								<div class="device-browser-header-browser-bar">www.htmlstream.com/front/</div>
							</div>

							<div class="device-browser-frame">
								<img class="device-browser-img" src="{{ Storage::disk('s3l')->url('img/1618x1010/img4.jpg') }}" alt="Image Description">
							</div>
						</figure>
						<!-- End Browser Device -->
					</div>
				</div>
				<!-- End Tab Content -->
			</div>
			<!-- End Col -->
		</div>
		<!-- End Row -->
	</div>
	<!-- End Feature Nav -->


	<!-- Testimonials -->
	<div class="overflow-hidden">
		<div class="container content-space-b-2">
			<div class="row justify-content-lg-center align-items-md-center">
				<div class="col-md-5 mb-10 mb-md-0">
					<div class="position-relative">
						<img class="img-fluid rounded-2" src="{{ Storage::disk('s3l')->url('img/800x900/img1.jpg') }}" alt="Image Description">

						<!-- SVG Shape -->
						<div class="position-absolute bottom-0 start-0 zi-n1 mb-n7 ms-n7" style="width: 12rem;">
							<img class="img-fluid" src="{{ Storage::disk('s3l')->url('svg/components/dots-lg.svg') }}" alt="Image Description">
						</div>
						<!-- End SVG Shape -->
					</div>
				</div>
				<!-- End Col -->

				<div class="col-md-6 col-lg-5">
					<div class="ps-md-6">

						<!-- Blockquote -->
						<figure>
							<blockquote class="blockquote blockquote-lg">Say goodbye to complex spreadsheets and hello to effortless budgeting. Our affordable and user-friendly SaaS solution is designed to help small and medium businesses thrive!</blockquote>

							<div class="mb-4">
								<a href="https://anypo.net"><img class="avatar avatar-xl avatar-4x3" src="{{ Storage::disk('s3l')->url('logo/logo.svg') }}" alt="Image Description"></a>
							</div>
							<!-- <figcaption class="blockquote-footer">
								ANYPO.NET
								<span class="blockquote-footer-source">CONTROL EXPENSES</span>
							</figcaption> -->
						</figure>
						<!-- End Blockquote -->
					</div>
				</div>
				<!-- End Col -->
			</div>
			<!-- End Row -->
		</div>
	</div>
	<!-- End Testimonials -->

	<!-- Icon Blocks -->
	<div class="container">
		<!-- Heading -->
		<div class="w-md-75 w-lg-50 text-center mx-md-auto mb-5 mb-md-9">
			<span class="text-cap">Why ANYPO.NET?</span>
			<h2>Do more with an end-to-end solution</h2>
		</div>
		<!-- End Heading -->

		<div class="row mb-5 mb-md-9">
			<div class="col-sm-6 col-md-4 mb-3 mb-sm-7">
				<!-- Icon Block -->
				<div class="d-flex align-items-center mb-2">
					<div class="flex-shrink-0">
						<span class="svg-icon svg-icon-sm text-primary">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M17.302 11.35L12.002 20.55H21.202C21.802 20.55 22.202 19.85 21.902 19.35L17.302 11.35Z" fill="#035A4B"/>
							<path opacity="0.3" d="M12.002 20.55H2.802C2.202 20.55 1.80202 19.85 2.10202 19.35L6.70203 11.45L12.002 20.55ZM11.302 3.45L6.70203 11.35H17.302L12.702 3.45C12.402 2.85 11.602 2.85 11.302 3.45Z" fill="#035A4B"/>
							</svg>

						</span>
					</div>

					<div class="flex-grow-1 ms-3">
						<h4 class="mb-0">Enhanced Efficiency</h4>
					</div>
				</div>
				<!-- End Icon Block -->

				<p>Streamline procurement processes, automate budget tracking, and minimize manual data entry, saving time and resources.</p>
			</div>
			<!-- End Col -->

			<div class="col-sm-6 col-md-4 mb-3 mb-sm-7">
				<!-- Icon Block -->
				<div class="d-flex align-items-center mb-2">
					<div class="flex-shrink-0">
						<span class="svg-icon svg-icon-sm text-primary">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path opacity="0.3" d="M21 2H13C12.4 2 12 2.4 12 3V13C12 13.6 12.4 14 13 14H21C21.6 14 22 13.6 22 13V3C22 2.4 21.6 2 21 2ZM15.7 8L14 10.1V5.80005L15.7 8ZM15.1 4H18.9L17 6.40002L15.1 4ZM17 9.59998L18.9 12H15.1L17 9.59998ZM18.3 8L20 5.90002V10.2L18.3 8ZM9 2H3C2.4 2 2 2.4 2 3V21C2 21.6 2.4 22 3 22H9C9.6 22 10 21.6 10 21V3C10 2.4 9.6 2 9 2ZM4.89999 12L4 14.8V9.09998L4.89999 12ZM4.39999 4H7.60001L6 8.80005L4.39999 4ZM6 15.2L7.60001 20H4.39999L6 15.2ZM7.10001 12L8 9.19995V14.9L7.10001 12Z" fill="#035A4B"/>
							<path d="M21 18H13C12.4 18 12 17.6 12 17C12 16.4 12.4 16 13 16H21C21.6 16 22 16.4 22 17C22 17.6 21.6 18 21 18ZM19 21C19 20.4 18.6 20 18 20H13C12.4 20 12 20.4 12 21C12 21.6 12.4 22 13 22H18C18.6 22 19 21.6 19 21Z" fill="#035A4B"/>
							</svg>

						</span>
					</div>

					<div class="flex-grow-1 ms-3">
						<h4 class="mb-0">Save Time and Effort</h4>
					</div>
				</div>
				<!-- End Icon Block -->

				<p>Ditch the spreadsheets!  This software automates tasks like creating purchase orders and processing invoices, freeing you up to focus on other important things.</p>
			</div>
			<!-- End Col -->

			<div class="col-sm-6 col-md-4 mb-3 mb-sm-7 mb-md-0">
				<!-- Icon Block -->
				<div class="d-flex align-items-center mb-2">
					<div class="flex-shrink-0">
						<span class="svg-icon svg-icon-sm text-primary">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M4.85714 1H11.7364C12.0911 1 12.4343 1.12568 12.7051 1.35474L17.4687 5.38394C17.8057 5.66895 18 6.08788 18 6.5292V19.0833C18 20.8739 17.9796 21 16.1429 21H4.85714C3.02045 21 3 20.8739 3 19.0833V2.91667C3 1.12612 3.02045 1 4.85714 1ZM7 13C7 12.4477 7.44772 12 8 12H15C15.5523 12 16 12.4477 16 13C16 13.5523 15.5523 14 15 14H8C7.44772 14 7 13.5523 7 13ZM8 16C7.44772 16 7 16.4477 7 17C7 17.5523 7.44772 18 8 18H11C11.5523 18 12 17.5523 12 17C12 16.4477 11.5523 16 11 16H8Z" fill="#035A4B"/>
							<path fill-rule="evenodd" clip-rule="evenodd" d="M6.85714 3H14.7364C15.0911 3 15.4343 3.12568 15.7051 3.35474L20.4687 7.38394C20.8057 7.66895 21 8.08788 21 8.5292V21.0833C21 22.8739 20.9796 23 19.1429 23H6.85714C5.02045 23 5 22.8739 5 21.0833V4.91667C5 3.12612 5.02045 3 6.85714 3ZM7 13C7 12.4477 7.44772 12 8 12H15C15.5523 12 16 12.4477 16 13C16 13.5523 15.5523 14 15 14H8C7.44772 14 7 13.5523 7 13ZM8 16C7.44772 16 7 16.4477 7 17C7 17.5523 7.44772 18 8 18H11C11.5523 18 12 17.5523 12 17C12 16.4477 11.5523 16 11 16H8Z" fill="#035A4B"/>
							</svg>

						</span>
					</div>

					<div class="flex-grow-1 ms-3">
						<h4 class="mb-0">Stay on Budget</h4>
					</div>
				</div>
				<!-- End Icon Block -->

				<p>Set spending limits and track your progress easily.  The software will alert you if you're at risk of going over budget, so you can make adjustments before it's too late.</p>
			</div>
			<!-- End Col -->

			<div class="col-sm-6 col-md-4 mb-3 mb-sm-7 mb-md-0">
				<!-- Icon Block -->
				<div class="d-flex align-items-center mb-2">
					<div class="flex-shrink-0">
						<span class="svg-icon svg-icon-sm text-primary">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path opacity="0.3" d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z" fill="#035A4B"/>
							<path d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z" fill="#035A4B"/>
							</svg>

						</span>
					</div>

					<div class="flex-grow-1 ms-3">
						<h4 class="mb-0">Peace of Mind</h4>
					</div>
				</div>
				<!-- End Icon Block -->

				<p>Know your finances are under control.  The software helps ensure you're paying invoices on time and staying compliant with regulations.</p>
			</div>
			<!-- End Col -->

			<div class="col-sm-6 col-md-4 mb-3 mb-sm-7 mb-md-0">
				<!-- Icon Block -->
				<div class="d-flex align-items-center mb-2">
					<div class="flex-shrink-0">
						<span class="svg-icon svg-icon-sm text-primary">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M15 19.5229C15 20.265 15.9624 20.5564 16.374 19.9389L22.2227 11.166C22.5549 10.6676 22.1976 10 21.5986 10H17V4.47708C17 3.73503 16.0376 3.44363 15.626 4.06106L9.77735 12.834C9.44507 13.3324 9.80237 14 10.4014 14H15V19.5229Z" fill="#035A4B"/>
							<path opacity="0.3" fill-rule="evenodd" clip-rule="evenodd" d="M3 6.5C3 5.67157 3.67157 5 4.5 5H9.5C10.3284 5 11 5.67157 11 6.5C11 7.32843 10.3284 8 9.5 8H4.5C3.67157 8 3 7.32843 3 6.5ZM3 18.5C3 17.6716 3.67157 17 4.5 17H9.5C10.3284 17 11 17.6716 11 18.5C11 19.3284 10.3284 20 9.5 20H4.5C3.67157 20 3 19.3284 3 18.5ZM2.5 11C1.67157 11 1 11.6716 1 12.5C1 13.3284 1.67157 14 2.5 14H6.5C7.32843 14 8 13.3284 8 12.5C8 11.6716 7.32843 11 6.5 11H2.5Z" fill="#035A4B"/>
							</svg>

						</span>
					</div>

					<div class="flex-grow-1 ms-3">
						<h4 class="mb-0">Real-Time Insights</h4>
					</div>
				</div>
				<!-- End Icon Block -->

				<p>ANYPO.NET provides real-time visibility into your spending, budgets, and financial performance. This means you can make data-driven decisions quickly, identify areas for cost savings or optimization..</p>
			</div>
			<!-- End Col -->

			<div class="col-sm-6 col-md-4">
				<!-- Icon Block -->
				<div class="d-flex align-items-center mb-2">
					<div class="flex-shrink-0">
						<span class="svg-icon svg-icon-sm text-primary">
							<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path opacity="0.3" d="M5 8.04999L11.8 11.95V19.85L5 15.85V8.04999Z" fill="#035A4B"/>
							<path d="M20.1 6.65L12.3 2.15C12 1.95 11.6 1.95 11.3 2.15L3.5 6.65C3.2 6.85 3 7.15 3 7.45V16.45C3 16.75 3.2 17.15 3.5 17.25L11.3 21.75C11.5 21.85 11.6 21.85 11.8 21.85C12 21.85 12.1 21.85 12.3 21.75L20.1 17.25C20.4 17.05 20.6 16.75 20.6 16.45V7.45C20.6 7.15 20.4 6.75 20.1 6.65ZM5 15.85V7.95L11.8 4.05L18.6 7.95L11.8 11.95V19.85L5 15.85Z" fill="#035A4B"/>
							</svg>

						</span>
					</div>

					<div class="flex-grow-1 ms-3">
						<h4 class="mb-0">Accessibility & Security</h4>
					</div>
				</div>
				<!-- End Icon Block -->

				<p>Securely access your financial data anytime, anywhere from any device.</p>
			</div>
			<!-- End Col -->
		</div>
		<!-- End Row -->

		<div class="text-center">
			<div class="d-grid d-sm-flex justify-content-center gap-2 mb-3">
				<a class="btn btn-primary btn-transition" href="{{ route('pricing') }}">Sign up and Start Building</a>
				<a class="btn btn-link" href="{{ route('contact-us') }}">Let's Talk <i class="bi-chevron-right small ms-1"></i></a>
			</div>
			{{-- <p class="small">Start free trial. * No credit card required.</p> --}}
		</div>
	</div>
	<!-- End Icon Blocks -->

	<!-- Mockup Card -->
	<div class="container d-none d-md-block">
		<div class="bg-soft-primary p-4 pb-md-0 pe-md-0 pt-md-10 ps-md-7">
			<div class="position-relative overflow-hidden">
				<div class="row justify-content-lg-between">
					<div class="col-md-4 py-5 pb-md-10">
						<div class="mb-5">
							<h2>Small Business? Big Dreams. </br>Simplify Purchasing & Budgeting with Our Powerful SaaS Platform.</h2>
						</div>

						<a class="btn btn-outline-primary" href="{{ route('pricing') }}">Sign up today</a>
					</div>
					<!-- End Col -->

					<div class="col-sm-6 col-lg-5">
						<!-- Devices -->
						<div class="devices position-absolute top-0 start-50">
							<!-- Browser Device -->
							<figure class="device-browser-frame rotated-3d-left">
								<div class="device-browser-frame">
									<img class="device-browser-img" src="{{ Storage::disk('s3l')->url('img/1618x1010/img5.jpg') }}" alt="Image Description">
								</div>
							</figure>
							<!-- End Browser Device -->
						</div>
						<!-- End Devices -->

						<!-- Devices -->
						<div class="devices position-absolute top-0 start-50 mt-10 ms-5">
							<!-- Browser Device -->
							<figure class="device-browser-frame rotated-3d-left">
								<div class="device-browser-frame">
									<img class="device-browser-img" src="{{ Storage::disk('s3l')->url('img/1618x1010/img4.jpg') }}" alt="Image Description">
								</div>
							</figure>
							<!-- End Browser Device -->
						</div>
						<!-- End Devices -->
					</div>
					<!-- End Col -->
				</div>
				<!-- End Row -->
			</div>
		</div>
	</div>
	<!-- End Mockup Card -->



	<!-- Hero -->
	<div class="container content-space-t-4 content-space-t-lg-5 content-space-b-2 content-space-b-lg-3">

			<div class="row justify-content-lg-between align-items-lg-center mb-10">
					<div class="col-md-6 col-lg-5">
						<!-- Heading -->
						<div class="mb-5">
							<h1>Streamline Your Purchasing. Supercharge Your Growth.</h1>
							<p>Take control of your spending and empower your business with our SAAS-based Purchasing and Budget Control Solution. Designed for small and medium-sized companies and startups, our platform ensures financial stability and strategic spending.</p>
						</div>
						<!-- End Title & Description -->

						<div class="d-grid d-sm-flex gap-3">
							<a class="btn btn-primary btn-transition" href="{{ route('pricing') }}">Get started</a>
							<a class="btn btn-link" href="{{ route('contact-us') }}">Let's Talk <i class="bi-chevron-right small ms-1"></i></a>
						</div>

						{{-- <p class="form-text small">Start free trial. * No credit card required.</p> --}}
					</div>
					<!-- End Col -->

					<div class="col-sm-7 col-md-6 d-none d-md-block">
						<img class="img-fluid" src="{{ Storage::disk('s3l')->url('svg/illustrations/oc-relaxing.svg') }}" alt="Image Description">
					</div>
					<!-- End Col -->
			</div>
			<!-- End Row -->
	</div>
	<!-- End Hero -->


@endsection
