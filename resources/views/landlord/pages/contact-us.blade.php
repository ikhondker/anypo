@extends('layouts.landlord')
@section('title','Contact Us')

@section('content')
	<!-- Contact Form -->
	<div class="container content-space-t-3 content-space-t-lg-5 content-space-b-2">
		<div class="row">
		<div class="col-lg-6 mb-9 mb-lg-0">
			<!-- Heading -->
			<div class="mb-5">
				<h1>Get in touch</h1>
				<p>We'd love to talk about how we can help you.</p>
			</div>
			<!-- End Heading -->

			<div class="row">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2881.449977578028!2d-79.20774052320225!3d43.763517345287994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89d4d07731af9e1d%3A0x991daf7a9ece9b2b!2s3939%20Lawrence%20Ave%20E%2C%20Scarborough%2C%20ON%20M1G%201R9%2C%20Canada!5e0!3m2!1sen!2sbd!4v1713009286254!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
			</div>

			<div class="row mt-4">
				<div class="col-sm-6">
					<h5 class="mb-1">Call us:</h5>
					<p>{{ $config->cell }} </p>
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
						<img class="avatar-img" src="{{ Storage::disk('s3l')->url('flag/ca.png') }}" alt="Image Description">
					</span>
				</div>
				<!-- End Col -->
			</div>
			<!-- End Row -->
		</div>
		<!-- End Col -->

		<div class="col-lg-6">
			<div class="ps-lg-5">
			<!-- Card -->
			<div class="card">
				<div class="card-header border-bottom text-center">
				<h3 class="card-header-title">Contact Us</h3>
				</div>

				<div class="card-body">
				<!-- Form -->
				<form action="{{ route('home.save-contact') }}" method="POST" name="myForm" id="myForm" onsubmit="return validateForm()" enctype="multipart/form-data">
					@csrf
					<div class="row gx-3">
					<div class="col-sm-6">
						<!-- Form -->
						<div class="mb-3">
							<label class="form-label" for="first_name">First name</label>
							<input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror"
								name="first_name" id="first_name" placeholder="First name"
								value="{{ old('first_name', auth()->check() ? auth()->user()->name : '') }}"
								required/>
							@error('first_name')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>
						<!-- End Form -->
					</div>
					<!-- End Col -->

					<div class="col-sm-6">
						<!-- Form -->
						<div class="mb-3">
							<label class="form-label" for="last_name">Last name</label>
							<input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror"
								name="last_name" id="last_name" placeholder="Last name"
								value="{{ old('last_name', '' ) }}"/>
							@error('last_name')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>
						<!-- End Form -->
					</div>
					<!-- End Col -->
					</div>
					<!-- End Row -->

					<div class="row gx-3">
					<div class="col-sm-6">
						<!-- Form -->
						<div class="mb-3">
							<label class="form-label" for="email">Email address</label>
							<input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror"
								name="email" id="email" placeholder="you@example.com"
								value="{{ old('email', auth()->check() ? auth()->user()->email : '' ) }}"
								required/>
							@error('email')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>
						<!-- End Form -->
					</div>
					<!-- End Col -->

					<div class="col-sm-6">
						<!-- Form -->
						<div class="mb-3">
							<label class="form-label" for="cell">Cell <span class="form-label-secondary">(Optional)</span></label>
							<input type="text" class="form-control form-control-lg @error('cell') is-invalid @enderror"
								name="cell" id="cell" placeholder="+x(xxx)xxx-xx-xx"
								value="{{ old('cell', auth()->check() ? auth()->user()->cell : ''  ) }}"/>
							@error('cell')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>
						<!-- End Form -->
					</div>
					<!-- End Col -->
					</div>
					<!-- End Row -->

					<!-- Form -->
					<div class="mb-3">
						<label class="form-label" for="message">Details</label>
						<textarea class="form-control form-control-lg @error('message') is-invalid @enderror"
							name="message" placeholder="Tell us about your ..." rows="4" required>{{ old('message', 'Tell us about your ...') }}</textarea>
						@error('message')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>
					<!-- End Form -->

					<!-- Form -->
					<div class="mb-3">
						<label class="form-label" for="message">Attachment</label>
						<input type="file" class="form-control form-control-sm" name="file_to_upload"
									id="file_to_upload"
									accept=".docs,.xlsx.jpg,.jpeg,.png,.zip,.rar"
									placeholder="file_to_upload">
						@error('file_to_upload')
							<div class="text-danger text-xs">{{ $message }}</div>
						@enderror
					</div>
					<!-- End Form -->

					<div class="d-grid">
						<button type="submit" class="btn btn-primary btn-lg">Send inquiry</button>
					</div>

					<div class="text-center">
					<p class="form-text">We'll get back to you in 1-2 business days.</p>
					</div>
				</form>
				<!-- End Form -->
				</div>
			</div>
			<!-- End Card -->
			</div>
		</div>
		<!-- End Col -->
		</div>
		<!-- End Row -->
	</div>
	<!-- End Contact Form -->

@endsection

