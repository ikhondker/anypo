@extends('layouts.landlord.page')
@section('title','Control Expenses - anypo.net')
@section('content')

<section class="landing-intro text-bg-dark pt-5 pt-lg-6 pb-5 pb-lg-7">
	<div class="landing-intro-content container ">
		<div class="row align-items-center">
			<div class="col-lg-5 mx-auto">
				<span class="badge badge-subtle-primary p-1">Purchasing and Expense Control Solution</span>

				<h1 class="my-4 text-white">Streamline Your Purchasing. Supercharge <span class="text-primary">Your Growth</span></h1>

				<p class="text-lg text-white-50">
					Struggling with managing expenses and staying within budget? We offer a seamless purchasing and budget control solution that streamlines workflows, automates tasks, and gives you real-time spending insights.
				</p>

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
					<a href="{{ route('akk.pricing') }}" class="btn btn-primary btn-lg btn-pill">Get Started</a>
				</div>
			</div>
			<div class="col-lg-7 d-none d-lg-flex mx-auto text-center">
				<div class="landing-intro-screenshot pb-3">
					<img src="{{ asset('/assets/screenshots/screen_01.png') }}" alt="ANYPO.NET" class="img-fluid" />
				</div>
			</div>
		</div>
	</div>
</section>


	<!-- Hero -->
	{{-- <div class="position-relative bg-img-start" style="background-image: url({{ Storage::disk('s3l')->url('svg/components/card-11.svg') }});"> --}}
	<section class="py-6 bg-white">
		<div class="position-relative bg-img-start" style="background-image: url({{asset('/assets/bg/card-11.svg')}});">
			<div class="container content-space-t-3 content-space-t-lg-5 content-space-b-2 content-space-b-lg-3 position-relative zi-2">
				<div class="row justify-content-lg-between align-items-md-center">
					<div class="col-md-6 col-lg-5 mb-10 mb-md-0">
						<div class="mb-5">
							<h1 class="display-4">(Front Style) Streamline Your Purchasing. Supercharge Your Growth.</h1>
							<p class="lead">
							Struggling with managing expenses and staying within budget? We offer a seamless purchasing and budget control solution that streamlines workflows, automates tasks, and gives you real-time spending insights.</p>
						</div>

						<div class="d-flex align-items-center gap-2 mb-8">
							<a href="{{ route('akk.pricing') }}" class="btn btn-primary btn-lg btn-pill">Get Started</a>
						</div>
					</div>
					<!-- End Col -->

					<div class="col-md-6">
						<div class="row justify-content-end">
							<div class="col-3 mb-4">
								<!-- Logo -->
								<div class="d-block avatar avatar-lg rounded-circle shadow-sm p-2 mt-n3 ms-5" data-aos="fade-up">
									<img class="rounded-circle rounded me-2 mb-2" src="{{ Storage::disk('s3l')->url('currency/yen.svg') }}" alt="yen" width="65" height="65">
								</div>
								<!-- End Logo -->
							</div>
							<div class="col-4 mb-4">
								<!-- Logo -->
								<div class="d-block avatar avatar-xl rounded-circle shadow-sm p-2 mx-auto mt-5" data-aos="fade-up" data-aos-delay="50">
									<img class="rounded-circle rounded me-2 mb-2" src="{{ Storage::disk('s3l')->url('currency/dollar.svg') }}" alt="dollar" width="165" height="165">
								</div>
								<!-- End Logo -->
							</div>
							<div class="col-4 mb-4">
								<!-- Logo -->
								<div class="d-block avatar avatar-xl rounded-circle shadow-sm p-3 ms-auto" data-aos="fade-up" data-aos-delay="150">
									<img class="rounded-circle rounded me-2 mb-2" src="{{ Storage::disk('s3l')->url('currency/euro.svg') }}" alt="euro" width="145" height="145">
								</div>
								<!-- End Logo -->
							</div>
						</div>

						<div class="row">
							<div class="col-3 offset-1 my-4">
								<!-- Logo -->
								<div class="d-block avatar avatar-xl rounded-circle shadow-sm p-3 ms-auto" data-aos="fade-up" data-aos-delay="200">
									<img class="rounded-circle rounded me-2 mb-2" src="{{ Storage::disk('s3l')->url('currency/ruble.svg') }}" alt="ruble" width="95" height="95">
								</div>
								<!-- End Logo -->
							</div>
							<div class="col-3 offset-2 my-4">
								<!-- Logo -->
								<div class="d-block avatar avatar-xl rounded-circle shadow-sm p-3 ms-auto" data-aos="fade-up" data-aos-delay="250">
									<img class="rounded-circle rounded me-2 mb-2" src="{{ Storage::disk('s3l')->url('currency/rupee.svg') }}" alt="rupee" width="95" height="95">
								</div>
								<!-- End Logo -->
							</div>
						</div>

						<div class="row d-none d-md-flex">
							<div class="col-6">
								<!-- Logo -->
								<div class="d-block avatar avatar-lg rounded-circle shadow-sm p-3 ms-auto" data-aos="fade-up" data-aos-delay="300">
									<img class="rounded-circle rounded me-2 mb-2" src="{{ Storage::disk('s3l')->url('currency/lira.svg') }}" alt="lira" width="245" height="245">
								</div>
								<!-- End Logo -->
							</div>
							<div class="col-6 mt-6">
								<!-- Logo -->
								<div class="d-block avatar avatar-xl rounded-circle shadow-sm p-2 ms-auto" data-aos="fade-up" data-aos-delay="350">
									<img class="rounded-circle rounded me-2 mb-2" src="{{ Storage::disk('s3l')->url('currency/pound.svg') }}" alt="pound" width="260" height="260">
								</div>
								<!-- End Logo -->
							</div>
						</div>
					</div>
					<!-- End Col -->
				</div>
				<!-- End Row -->
			</div>
		</div>
		<!-- End Hero -->
	</section>



	<section class="py-6 bg-white">
		<div class="container">
			<div class="mb-5 text-center">
				<span class="text-uppercase text-primary text-sm fw-medium mb-1 d-block">2. What's ANYPO.NET?</span>
				<h2 class="h1">The All-in-One Purchasing and Expense Control Solution Built <br>for Small Businesses and Startups.</h2>
				<p class="text-muted fs-lg">A responsive dashboard built for everyone who wants to create webapps on top of Bootstrap.</p>
			</div>
			<div class="row align-items-center">
				<div class="col-lg-5 mx-auto">
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
				<div class="col-lg-7 d-none d-lg-flex mx-auto text-center">
					<div class="landing-intro-screenshot pb-3">

						<img src="{{ asset('/assets/img/screenshots/mixed.jpg') }}" alt="Dark/Light Bootstrap Admin Template" class="img-fluid" />
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Testimonials -->
	<section class="py-6 bg-white">
		<div class="container">
			<div class="mb-5 text-center">
				{{-- <span class="text-uppercase text-primary text-sm fw-medium mb-1 d-block">2. What's ANYPO.NET?</span>
				<h2 class="h1">The All-in-One Purchasing and Expense Control Solution Built <br>for Small Businesses and Startups.</h2>
				<p class="text-muted fs-lg">A responsive dashboard built for everyone who wants to create webapps on top of Bootstrap.</p> --}}
			</div>
			<div class="row align-items-center">
				<div class="col-lg-6 d-none d-lg-flex mx-auto text-center">
					<div class="landing-intro-screenshot pb-3">
						<img src="{{ asset('/assets/img/screenshots/mixed.jpg') }}" alt="Dark/Light Bootstrap Admin Template" class="img-fluid" />
					</div>
				</div>
				<div class="col-lg-5 mx-auto">

					<blockquote class="landing-quote card border">
						<div class="card-body p-4">
							<div class="d-flex align-items-center mb-3">
								<div>
									<a href="https://anypo.net">
										<img src="{{ Storage::disk('s3l')->url('logo/logo.svg') }}" class="rounded me-2 mb-2" alt="Placeholder" width="90" height="90">
									</a>
								</div>
								<div class="ps-3">
									<h5 class="mb-1 mt-2">ANYPO.NET</h5><small class="d-block text-muted h5 fw-normal">CONTROL EXPENSES</small>
								</div>
							</div>
							<p class="lead mb-2">
								Say goodbye to complex spreadsheets and hello to effortless budgeting. Our affordable and user-friendly SaaS solution is designed to help small and medium businesses thrive!
							</p>

							<div class="landing-stars">
								<img class="rounded-circle rounded me-2 mb-2" src="{{ Storage::disk('s3l')->url('currency/yen.svg') }}" alt="yen" width="45" height="45">
								<img class="rounded-circle rounded me-2 mb-2" src="{{ Storage::disk('s3l')->url('currency/dollar.svg') }}" alt="dollar" width="45" height="45">
								<img class="rounded-circle rounded me-2 mb-2" src="{{ Storage::disk('s3l')->url('currency/euro.svg') }}" alt="euro" width="45" height="45">
								<img class="rounded-circle rounded me-2 mb-2" src="{{ Storage::disk('s3l')->url('currency/ruble.svg') }}" alt="ruble" width="45" height="45">
								<img class="rounded-circle rounded me-2 mb-2" src="{{ Storage::disk('s3l')->url('currency/rupee.svg') }}" alt="rupee" width="45" height="45">
								<img class="rounded-circle rounded me-2 mb-2" src="{{ Storage::disk('s3l')->url('currency/lira.svg') }}" alt="lira" width="45" height="45">
								<img class="rounded-circle rounded me-2 mb-2" src="{{ Storage::disk('s3l')->url('currency/pound.svg') }}" alt="pound" width="45" height="45">
							</div>
						</div>
					</blockquote>

				</div>
			</div>
		</div>
	</section>
	<!-- End Testimonials -->

	<!-- Features -->
	<section class="py-6 bg-white">
		<div class="container">
			<div class="mb-5 text-center">
				<span class="text-uppercase text-primary text-sm fw-medium mb-1 d-block">4. Why ANYPO.NET?</span>
				<h2 class="h1">Do more with an end-to-end solution</h2>
				<p class="text-muted fs-lg">A responsive dashboard built for everyone who wants to create webapps on top of Bootstrap.</p>
			</div>
			<div class="row text-start">
				<div class="col-12 col-md-4">
					<div class="d-flex align-items-start py-3">
						<div class="landing-feature">
							<i data-lucide="sliders"></i>
						</div>
						<div class="flex-grow-1">
							<h4 class="mt-0">Enhanced Efficiency</h4>
							<p class="fs-lg">Streamline procurement processes, automate budget tracking, and minimize manual data entry, saving time and resources.</p>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div class="d-flex align-items-start py-3">
						<div class="landing-feature">
							<i data-lucide="smartphone"></i>
						</div>
						<div class="flex-grow-1">
							<h4 class="mt-0">Save Time and Effort</h4>
							<p class="fs-lg">Ditch the spreadsheets! This software automates tasks like creating purchase orders and processing invoices, freeing you up to focus on other important things.</p>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div class="d-flex align-items-start py-3">
						<div class="landing-feature">
							<i data-lucide="mail"></i>
						</div>
						<div class="flex-grow-1">
							<h4 class="mt-0">Stay on Budget</h4>
							<p class="fs-lg">Set spending limits and track your progress easily. The software will alert you if you're at risk of going over budget, so you can make adjustments before it's too late.</p>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div class="d-flex align-items-start py-3">
						<div class="landing-feature">
							<i data-lucide="chrome"></i>
						</div>
						<div class="flex-grow-1">
							<h4 class="mt-0">Peace of Mind</h4>
							<p class="fs-lg">Know your finances are under control. The software helps ensure you're paying invoices on time and staying compliant with regulations.</p>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div class="d-flex align-items-start py-3">
						<div class="landing-feature">
							<i data-lucide="code"></i>
						</div>
						<div class="flex-grow-1">
							<h4 class="mt-0">Real-Time Insights</h4>
							<p class="fs-lg">ANYPO.NET provides real-time visibility into your spending, budgets, and financial performance. This means you can make data-driven decisions quickly, identify areas for cost savings or optimization.</p>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-4">
					<div class="d-flex align-items-start py-3">
						<div class="landing-feature">
							<i data-lucide="download-cloud"></i>
						</div>
						<div class="flex-grow-1">
							<h4 class="mt-0">Accessibility & Security</h4>
							<p class="fs-lg">Securely access your financial data anytime, anywhere from any device.</p>
						</div>
					</div>
				</div>

				<div class="text-center">
					<div class="d-grid d-sm-flex justify-content-center gap-2 mb-3">
						<a href="{{ route('akk.pricing') }}" class="btn btn-primary btn-lg btn-pill">Sign up and Start Building</a>
						<a class="btn btn-link" href="{{ route('contact-us') }}">Let's Talk <i data-lucide="chevron-right"></i></a>
					</div>
					{{-- <p class="small">Start free trial. * No credit card required.</p> --}}
				</div>

			</div>
		</div>
	</section>
	<!-- End Features -->


	<section class="landing-intro pt-5 pt-lg-6 pb-5 pb-lg-7 bg-white">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-5 mx-auto">
					<span class="badge badge-subtle-primary p-1">Purchasing and Expense Control Solution</span>

					<h2 class="my-4">Small Business? Big Dreams. </br>Simplify Purchasing & Budgeting with Our Powerful SaaS Platform.</h2>

					<div class="my-4">
						<a href="{{ route('akk.pricing') }}" class="btn btn-primary btn-lg btn-pill">Get Started</a>
					</div>
				</div>
				<div class="col-lg-7 d-none d-lg-flex mx-auto text-center">
					<div class="landing-intro-screenshot pb-3">
						{{-- <img src="{{ asset('/assets/img/screenshots/mixed.jpg') }}" alt="Dark/Light Bootstrap Admin Template" class="img-fluid" /> --}}
						<img src="{{ Storage::disk('s3l')->url('svg/illustrations/oc-relaxing.svg') }}" class="img-fluid" alt="Image Description">
					</div>
				</div>
			</div>
		</div>
	</section>



	<section class="landing-intro pt-5 pt-lg-6 pb-5 pb-lg-7 bg-white">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-5 mx-auto">
					<span class="badge badge-subtle-primary p-1">CHK : Purchasing and Expense Control Solution</span>

					<h1 class="my-4">Streamline Your Purchasing. Supercharge <span class="text-primary">Your Growth</span></h1>

					<p class="text-lg">
						Take control of your spending and empower your business with our SAAS-based Purchasing and Budget Control Solution. Designed for small and medium-sized companies and startups, our platform ensures financial stability and strategic spending.
					</p>

					<div class="my-4">
						<a href="{{ route('akk.pricing') }}" class="btn btn-primary btn-lg btn-pill">Get Started</a>
					</div>
				</div>
				<div class="col-lg-7 d-none d-lg-flex mx-auto text-center">
					<div class="landing-intro-screenshot pb-3">
						{{-- <img src="{{ asset('/assets/img/screenshots/mixed.jpg') }}" alt="Dark/Light Bootstrap Admin Template" class="img-fluid" /> --}}
						<img src="{{ Storage::disk('s3l')->url('svg/illustrations/oc-relaxing.svg') }}" class="img-fluid" alt="Image Description">
					</div>
				</div>
			</div>
		</div>
	</section>





@endsection
