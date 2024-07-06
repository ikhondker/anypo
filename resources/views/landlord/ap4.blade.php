{{-- @extends('layouts.landlord.page') --}}
@extends('layouts.landlord.app')
@section('title','Control Expenses - anypo.net')



@section('content')
	<br><br><br>
	<i class="align-middle me-2" data-lucide="compass"></i> <span class="align-middle">compass</span>
	<i class="align-middle me-2" data-lucide="compass"></i>
	<i class="align-middle me-2" data-lucide="compass"></i>
	<i class="align-middle me-2" data-lucide="compass"></i>
	<div class="landing-feature">
		<i data-lucide="sliders"></i>
	</div>

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

	<br><br><br>
@endsection
