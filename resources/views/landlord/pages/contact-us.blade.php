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

			<!-- Leaflet -->
			<div class="overflow-hidden">
			<div id="mapEg3" class="leaflet mb-5"
				data-hs-leaflet-options='{
				"map": {
					"scrollWheelZoom": false,
					"coords": [37.4040344, -122.0289704]
				},
				"marker": [
					{
					"coords": [37.4040344, -122.0289704],
					"icon": {
						"iconUrl": "../assets/svg/components/map-pin.svg",
						"iconSize": [50, 45]
					},
					"popup": {
						"text": "153 Williamson Plaza, Maggieberg"
					}
					}
				]
				}'></div>
			</div>
			<!-- End Leaflet -->

			<div class="row">
			<div class="col-sm-6">
				<h5 class="mb-1">Call us:</h5>
				<p>+1 (062) 109-9222</p>
			</div>
			<!-- End Col -->

			<div class="col-sm-6">
				<h5 class="mb-1">Email us:</h5>
				<p>hello@example.com</p>
			</div>
			<!-- End Col -->

			<div class="col-sm-6">
				<h5 class="mb-1">Address:</h5>
				<p>153 Williamson Plaza, Maggieberg</p>
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
				<form action="{{ route('home.savecontact') }}" method="POST" name="myForm" id="myForm" onsubmit="return validateForm()" enctype="multipart/form-data">
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

