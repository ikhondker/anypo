@extends('layouts.landlord.page')
@section('title','Contact Us')

@section('content')


<section class="py-6 bg-white">
	<div class="container">
		<div class="mb-5 text-center">
			<span class="text-uppercase text-primary text-sm fw-medium mb-1 d-block">Contact Us</span>
			<h2 class="h1">Get in touch.</h2>
			<p class="text-muted fs-lg">We'd love to talk about how we can help you..</p>
		</div>
		<div class="row">
			<div class="col-lg-6 mb-9 mb-lg-0">
				<div class="row">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2881.449977578028!2d-79.20774052320225!3d43.763517345287994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89d4d07731af9e1d%3A0x991daf7a9ece9b2b!2s3939%20Lawrence%20Ave%20E%2C%20Scarborough%2C%20ON%20M1G%201R9%2C%20Canada!5e0!3m2!1sen!2sbd!4v1713009286254!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>

				<div class="row mt-4">
					<div class="col-sm-6">
						<h5 class="mb-1">Call us:</h5>
						<p>{{ $config->cell }}</p>
					</div>
					<!-- End Col -->

					<div class="col-sm-6">
						<h5 class="mb-1">Email us:</h5>
						<p>{{ $config->email }}</p>
					</div>
					<!-- End Col -->

					<div class="col-sm-6">
						<h5 class="mb-1">Address:</h5>
						<p>{{ $config->address1 }} {{ $config->city.' '.$config->state.' '. $config->zip.' ,'. $config->relCountry->name }}.</p>
						<span class="avatar avatar-xs avatar-circle">
							<img class="avatar-img" src="{{ Storage::disk('s3l')->url('flags/ca.png') }}" alt="Image Description">
						</span>
					</div>
					<!-- End Col -->
				</div>
				<!-- End Row -->
			</div>
			<!-- End Col -->

			<div class="col-lg-6">
				<div class="ps-lg-5">
					<x-landlord.forms.contact/>
				</div>
			</div>
			<!-- End Col -->
		</div>
		<!-- End Row -->
	</div>
</section>


@endsection

