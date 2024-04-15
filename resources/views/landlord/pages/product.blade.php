@extends('layouts.landlord')
@section('title','Product Overview')

@section('content')
	<!-- Features -->
	<div class="container content-space-2 content-space-lg-3">
		<div class="row align-items-lg-center">
		<div class="col-lg-5 mb-5 mb-lg-0">
			<div class="pe-lg-6">
			<div class="mb-4">
				<h2 class="h1">Purchasing and Expense control solution</h2>
			</div>

			<div class="d-flex gap-3 mb-4">
				<img class="avatar avatar-xs avatar-4x3" src="{{ Storage::disk('s3l')->url('currency/yen.svg') }}" alt="Logo">
				<img class="avatar avatar-xs avatar-4x3" src="{{ Storage::disk('s3l')->url('currency/dollar.svg') }}" alt="Logo">
				<img class="avatar avatar-xs avatar-4x3" src="{{ Storage::disk('s3l')->url('currency/euro.svg') }}" alt="Logo">
				<img class="avatar avatar-xs avatar-4x3" src="{{ Storage::disk('s3l')->url('currency/pound.svg') }}" alt="Logo">
				<img class="avatar avatar-xs avatar-4x3" src="{{ Storage::disk('s3l')->url('currency/rupee.svg') }}" alt="Logo">
				<img class="avatar avatar-xs avatar-4x3" src="{{ Storage::disk('s3l')->url('currency/lira.svg') }}" alt="Logo">
				<img class="avatar avatar-xs avatar-4x3" src="{{ Storage::disk('s3l')->url('currency/ruble.svg') }}" alt="Logo">
			</div>

			<div class="mb-4">
				<p>Struggling with managing expenses and staying within budget? We offer a seamless purchasing and budget control solution that streamlines workflows, automates tasks, and gives you real-time spending insights.</p>
			</div>

			<a class="link" href="{{ route('pricing') }}">Get started <i class="bi-chevron-right small ms-1"></i></a>
			</div>
		</div>
		<!-- End Col -->

		<div class="col-lg-7">
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
		<!-- End Col -->
		</div>
		<!-- End Row -->
	</div>
	<!-- End Features -->

	<!-- Features -->
	<div class="container content-space-2 content-space-lg-3">
		<div class="row justify-content-lg-between align-items-lg-center">
		<div class="col-lg-5 mb-9 mb-lg-0">
			<div class="mb-3">
			<h2 class="h1">Streamline Your Purchasing. Supercharge Your Growth.</h2>
			</div>

			<p>Take control of your spending and empower your business with our SAAS-based Purchasing and Budget Control Solution. Designed for small and medium-sized companies and startups, our platform ensures financial stability and strategic spending.</p>

			{{-- <p>Use our tools to explore your ideas and make your vision come true. Then share your work easily.</p> --}}

			<div class="mt-4">
			<a class="btn btn-primary btn-transition px-5" href="{{ route('pricing') }}">Start Now</a>
			</div>
		</div>
		<!-- End Col -->

		<div class="col-lg-6 col-xl-5">
			<!-- SVG Element -->
			<div class="position-relative mx-auto" style="max-width: 28rem; min-height: 30rem;">
			<figure class="position-absolute top-0 end-0 zi-2 me-10" data-aos="fade-up">
				<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 450 450" width="165" height="165">
				<g>
					<defs>
					<path id="circleImgID2" d="M225,448.7L225,448.7C101.4,448.7,1.3,348.5,1.3,225l0,0C1.2,101.4,101.4,1.3,225,1.3l0,0
						c123.6,0,223.7,100.2,223.7,223.7l0,0C448.7,348.6,348.5,448.7,225,448.7z"/>
					</defs>
					<clipPath id="circleImgID1">
					<use xlink:href="#circleImgID2"/>
					</clipPath>
					<g clip-path="url(#circleImgID1)">
					<image width="450" height="450" xlink:href="{{ Storage::disk('s3l')->url('img/450x450/img1.jpg') }}" ></image>
					</g>
				</g>
				</svg>
			</figure>

			<figure class="position-absolute top-0 start-0" data-aos="fade-up" data-aos-delay="300">
				<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 335.2 335.2" width="120" height="120">
				<circle fill="none" stroke="#377dff" stroke-width="75" cx="167.6" cy="167.6" r="130.1"/>
				</svg>
			</figure>

			<figure class="d-none d-sm-block position-absolute top-0 start-0 mt-10" data-aos="fade-up" data-aos-delay="200">
				<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 515 515" width="200" height="200">
				<g>
					<defs>
					<path id="circleImgID4" d="M260,515h-5C114.2,515,0,400.8,0,260v-5C0,114.2,114.2,0,255,0h5c140.8,0,255,114.2,255,255v5
						C515,400.9,400.8,515,260,515z"/>
					</defs>
					<clipPath id="circleImgID3">
					<use xlink:href="#circleImgID4"/>
					</clipPath>
					<g clip-path="url(#circleImgID3)">
					<image width="515" height="515" xlink:href="{{ Storage::disk('s3l')->url('img/515x515/img1.jpg') }}" transform="matrix(1 0 0 1 1.639390e-02 2.880859e-02)"></image>
					</g>
				</g>
				</svg>
			</figure>

			<figure class="position-absolute top-0 end-0" style="margin-top: 11rem; margin-right: 13rem;" data-aos="fade-up" data-aos-delay="250">
				<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 67 67" width="25" height="25">
				<circle fill="#00C9A7" cx="33.5" cy="33.5" r="33.5"/>
				</svg>
			</figure>

			<figure class="position-absolute top-0 end-0 me-3" style="margin-top: 8rem;" data-aos="fade-up" data-aos-delay="350">
				<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 141 141" width="50" height="50">
				<circle fill="#FFC107" cx="70.5" cy="70.5" r="70.5"/>
				</svg>
			</figure>

			<figure class="position-absolute bottom-0 end-0" data-aos="fade-up" data-aos-delay="400">
				<svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 770.4 770.4" width="280" height="280">
				<g>
					<defs>
					<path id="circleImgID6" d="M385.2,770.4L385.2,770.4c212.7,0,385.2-172.5,385.2-385.2l0,0C770.4,172.5,597.9,0,385.2,0l0,0
						C172.5,0,0,172.5,0,385.2l0,0C0,597.9,172.4,770.4,385.2,770.4z"/>
					</defs>
					<clipPath id="circleImgID5">
					<use xlink:href="#circleImgID6"/>
					</clipPath>
					<g clip-path="url(#circleImgID5)">
					<image width="900" height="900" xlink:href="{{ Storage::disk('s3l')->url('img/900x900/img2.jpg') }}" transform="matrix(1 0 0 1 -64.8123 -64.8055)"></image>
					</g>
				</g>
				</svg>
			</figure>
			</div>
			<!-- End SVG Element -->
		</div>
		<!-- End Col -->
		</div>
		<!-- End Row -->
	</div>
	<!-- End Features -->

	<!-- Features -->
	<div class="position-relative bg-light rounded-2 mx-3 mx-lg-10">
		<div class="container content-space-2 content-space-lg-3">
			<!-- Heading -->
			<div class="w-md-75 w-lg-50 text-center mx-md-auto mb-5">
				<h2>Stop Overspending</h2>
				<p>Gain real-time insights into your spending. See exactly where your money is going and identify areas where you can save.</p>
			</div>
			<!-- End Heading -->

			<div class="text-center mb-10">
				<!-- List Checked -->

				<ul class="list-inline list-checked list-checked-primary">
					<li class="list-inline-item list-checked-item">Streamline Procurement</li>
					<li class="list-inline-item list-checked-item">Cost control</li>
					<li class="list-inline-item list-checked-item">Procurement Automation</li>
					<li class="list-inline-item list-checked-item">Spending insights</li>
				</ul>
				<!-- End List Checked -->
			</div>

			<div class="row">
				<div class="col-lg-7 mb-9 mb-lg-0">
				<div class="pe-lg-6">
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
						<img class="device-browser-img" src="{{ Storage::disk('s3l')->url('img/1618x1010/img6.jpg') }}" alt="Image Description">
					</div>
					</figure>
					<!-- End Browser Device -->
				</div>
				</div>
				<!-- End Col -->

				<div class="col-lg-5">
				<!-- Heading -->
				<div class="mb-4">
					<h2>Small Business? Big Dreams.	</h2>
					<p>Simplify Purchasing & Budgeting with Our Powerful SaaS Platform.</p>
				</div>
				<!-- End Heading -->

				<!-- List Checked -->
				<ul class="list-checked list-checked-primary mb-5">
					<li class="list-checked-item">Streamline Procurement</li>
					<li class="list-checked-item">Cost control and Stay on Budget</li>
					<li class="list-checked-item">Real-Time Spending insights</li>
					<li class="list-checked-item">Enhanced Efficiency</li>
					<li class="list-checked-item">Save Time and Effort</li>
					<li class="list-checked-item">Approval Workflows</li>
					<li class="list-checked-item">Easy Integration (with Core Accounting System)</li>
					<li class="list-checked-item">Customer Support</li>
					<li class="list-checked-item">Peace of Mind</li>
				</ul>
				<!-- End List Checked -->

				<a class="btn btn-primary" href="{{ route('pricing') }}">Get started</a>

				<hr class="my-5">

				<span class="d-block">Support most currencies of the world</span>
				<div class="row">
					<div class="col py-3">
						<img class="avatar-xs avatar-4x3" src="{{ Storage::disk('s3l')->url('currency/yen.svg') }}" alt="Logo">
						<img class="avatar-xs avatar-4x3" src="{{ Storage::disk('s3l')->url('currency/dollar.svg') }}" alt="Logo">
						<img class="avatar-xs avatar-4x3" src="{{ Storage::disk('s3l')->url('currency/pound.svg') }}" alt="Logo">
						<img class="avatar-xs avatar-4x3" src="{{ Storage::disk('s3l')->url('currency/euro.svg') }}" alt="Logo">
						<img class="avatar-xs avatar-4x3" src="{{ Storage::disk('s3l')->url('currency/rupee.svg') }}" alt="Logo">
						<img class="avatar-xs avatar-4x3" src="{{ Storage::disk('s3l')->url('currency/ruble.svg') }}" alt="Logo">
						<img class="avatar-xs avatar-4x3" src="{{ Storage::disk('s3l')->url('currency/lira.svg') }}" alt="Logo">
					</div>
					<!-- End Col -->
				
				</div>
				<!-- End Row -->
				</div>
				<!-- End Col -->
			</div>
			<!-- End Row -->
		</div>
	</div>
	<!-- End Features -->

	
		<!-- CTA -->
	<div class="container content-space-b-2">
		<div class="text-center bg-img-start py-6" style="background: url(../assets/svg/components/shape-6.svg) center no-repeat;">
			<div class="mb-5">
			<h2>Find the right learning path for you</h2>
			<p>Answer a few questions and match your goals to our programs.</p>
			</div>

			<a class="btn btn-primary btn-transition" href="{{ route('pricing') }}">Get started</a>
		</div>
	</div>
	<!-- End CTA -->
@endsection
