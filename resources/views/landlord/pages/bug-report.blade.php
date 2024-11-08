@extends('layouts.landlord.page')
@section('title','Bug Report')

@section('content')


<section class="py-6 bg-white">
	<div class="container">
		<div class="mb-5 text-center">
			<span class="text-uppercase text-primary text-sm fw-medium mb-1 d-block">Request a Demo</span>
			<h2 class="h1">Bug Report</h2>
			<p class="text-muted fs-lg">See what anypo.net application can do for you.....</p>
		</div>
		<div class="row">
			<div class="col-lg-6 mb-9 mb-lg-0">
					<div class="row align-items-center">

					<h1 class="my-4">Streamline Your Purchasing. Supercharge <span class="text-primary">Your Growth</span></h1>
					<p class="text-lg">
						Take control of your spending and empower your business with our SAAS-based Purchasing and Budget Control Solution. Designed for small and medium-sized companies and startups, our platform ensures financial stability and strategic spending.
					</p>
					<div class="my-4">
						<a href="{{ route('akk.pricing') }}" class="btn btn-primary btn-lg btn-pill">Get Started</a>
					</div>
			</div>

			</div>
			<!-- End Col -->

			<div class="col-lg-6">
				<div class="ps-lg-5">
					<x-landlord.forms.contact formType="bug" />
				</div>
			</div>
			<!-- End Col -->
		</div>
		<!-- End Row -->
	</div>
</section>


@endsection

