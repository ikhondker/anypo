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
						<label class="form-label" for="hireUsFormFirstNameEg3">First name</label>
						<input type="text" class="form-control form-control-lg" name="hireUsFormNameFirstName" id="hireUsFormFirstNameEg3" placeholder="First name" aria-label="First name">
						<input type="text" class="form-control @error('name') is-invalid @enderror" 
							name="first_name" id="first_name" placeholder="First name"     
							value="{{ old('first_name', '' ) }}"
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
						<label class="form-label" for="hireUsFormLasttNameEg3">Last name</label>
						<input type="text" class="form-control form-control-lg" name="hireUsFormNameLastName" id="hireUsFormLasttNameEg3" placeholder="Last name" aria-label="Last name">
						<input type="text" class="form-control @error('name') is-invalid @enderror" 
							name="last_name" id="last_name" placeholder="Last name"     
							value="{{ old('last_name', '' ) }}"
							required/>
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
						<label class="form-label" for="hireUsFormWorkEmailEg3">Email address</label>
						<input type="email" class="form-control form-control-lg" name="hireUsFormNameWorkEmail" id="hireUsFormWorkEmailEg3" placeholder="you@example.com" aria-label="you@example.com">
						</div>
						<!-- End Form -->
					</div>
					<!-- End Col -->
	
					<div class="col-sm-6">
						<!-- Form -->
						<div class="mb-3">
						<label class="form-label" for="hireUsFormPhoneEg3">Phone <span class="form-label-secondary">(Optional)</span></label>
						<input type="text" class="form-control form-control-lg" name="hireUsFormNamePhone" id="hireUsFormPhoneEg3" placeholder="+x(xxx)xxx-xx-xx" aria-label="+x(xxx)xxx-xx-xx">
						</div>
						<!-- End Form -->
					</div>
					<!-- End Col -->
					</div>
					<!-- End Row -->
	
					<!-- Form -->
					<div class="mb-3">
					<label class="form-label" for="hireUsFormDetails">Details</label>
					<textarea class="form-control form-control-lg" name="hireUsFormNameDetails" id="hireUsFormDetails" placeholder="Tell us about your ..." aria-label="Tell us about your ..." rows="4"></textarea>
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

@section('bo04-content')

		<div class="container">
			<div class="row">
				<div class="col-md-4">
					<div class="card border-0 text-center features feature-clean bg-transparent">
						<div class="icons text-primary text-center mx-auto">
							<i class="uil uil-phone d-block rounded h3 mb-0"></i>
						</div>
						<div class="content mt-3">
							<h5 class="footer-head">Phone</h5>
							<p class="text-muted">Start working with Starty that can provide everything</p>
							<a href="tel:+152534-468-854" class="text-foot">+152 534-468-854</a>
						</div>
					</div>
				</div><!--end col-->
				
				<div class="col-md-4 mt-4 mt-sm-0 pt-2 pt-sm-0">
					<div class="card border-0 text-center features feature-clean bg-transparent">
						<div class="icons text-primary text-center mx-auto">
							<i class="uil uil-envelope d-block rounded h3 mb-0"></i>
						</div>
						<div class="content mt-3">
							<h5 class="footer-head">Email</h5>
							<p class="text-muted">Start working with Starty that can provide everything</p>
							<a href="mailto:contact@example.com" class="text-foot">contact@example.com</a>
						</div>
					</div>
				</div><!--end col-->
				
				<div class="col-md-4 mt-4 mt-sm-0 pt-2 pt-sm-0">
					<div class="card border-0 text-center features feature-clean bg-transparent">
						<div class="icons text-primary text-center mx-auto">
							<i class="uil uil-map-marker d-block rounded h3 mb-0"></i>
						</div>
						<div class="content mt-3">
							<h5 class="footer-head">Location</h5>
							<p class="text-muted">C/54 Northwest Freeway, Suite 558, <br>Houston, USA 485</p>
							<a href="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d39206.002432144705!2d-95.4973981212445!3d29.709510002925988!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8640c16de81f3ca5%3A0xf43e0b60ae539ac9!2sGerald+D.+Hines+Waterwall+Park!5e0!3m2!1sen!2sin!4v1566305861440!5m2!1sen!2sin"
								data-type="iframe" class="video-play-icon text-foot lightbox">View on Google map</a>
						</div>
					</div>
				</div><!--end col-->
			</div><!--end row-->
		</div><!--end container-->

		<div class="container mt-100 mt-60">
			<div class="row justify-content-center">
				<div class="col-lg-8">
					<div class="section-title mb-5 pb-2 text-center">
						<h4 class="title mb-3">Get In Touch !</h4>
						<p class="text-muted para-desc mx-auto mb-0">Our design projects are fresh and simple and will benefit your business greatly. Learn more about our work!</p>
					</div>
					<div class="custom-form">

						<!-- form start -->
						<form action="{{ route('home.savecontact') }}" method="POST" name="myForm" id="myForm" onsubmit="return validateForm()" enctype="multipart/form-data">
							@csrf
							<p id="error-msg" class="mb-0"></p>
							<div id="simple-msg"></div>
							<div class="row">
								<div class="col-md-6">
									<div class="mb-3">
										<label class="form-label">Your Name <x-landlord.red-star/></label>
										{{-- <input name="name" id="name" type="text" class="form-control" placeholder="Name :" required> --}}
										@auth
										<input type="text" class="form-control" 
											name="name" id="name" placeholder="John Doe" 
											value="{{ old('name', auth()->user()->name ) }}"     
											class="@error('name') is-invalid @enderror" hidden>
											@error('name')
												<div class="text-danger text-xs">{{ $message }}</div>
											@enderror
											<p> {{ auth()->user()->name  }}</p>
										@endauth
										@guest
											<input type="text" class="form-control form-control-sm" 
												name="name" id="name" placeholder="John Doe" 
												value="{{ old('name', "John Doe" ) }}"     
												class="@error('name') is-invalid @enderror" required>
												@error('name')
													<div class="text-danger text-xs">{{ $message }}</div>
												@enderror
										@endguest
									</div>
								</div><!--end col-->

								<div class="col-md-6">
									<div class="mb-3">
										<label class="form-label">Your Email <x-landlord.red-star/></label>
										{{-- <input name="email" id="email" type="email" class="form-control" placeholder="Email :" required> --}}
										@auth
											<input type="email" class="form-control" 
												name="email" id="email" placeholder="you@example.com" 
												value="{{ old('email', auth()->user()->email )  }}"     
												class="@error('email') is-invalid @enderror" hidden>
											@error('email')
												<div class="text-danger text-xs">{{ $message }}</div>
											@enderror
											<p>{{ auth()->user()->email  }}</p>
										@endauth
										@guest
											<input type="email" class="form-control" 
												name="email" id="email" placeholder="you@example.com" 
												value="{{ old('email', "you@example.com") }}"     
												class="@error('email') is-invalid @enderror" required>
												@error('email')
													<div class="text-danger text-xs">{{ $message }}</div>
												@enderror
										@endguest
									</div> 
								</div><!--end col-->


								<div class="col-12">
									<div class="mb-3">
										<label class="form-label">Subject<x-landlord.red-star/></label>
										<input name="subject" id="subject" class="form-control" placeholder="Subject :" required>
									</div>
								</div><!--end col-->

								<div class="col-12">
									<div class="mb-3">
										<label class="form-label">Message <span class="text-danger">*</span></label>
										<textarea name="message" id="message" rows="4" class="form-control" placeholder="Message :" required></textarea>
									</div>
								</div><!--end col-->
								<div class="col-12">
									<div class="mb-3">
										<label class="form-label">Attachment</label>
										<x-landlord.attachment.create />
									</div>
								</div><!--end col-->

							</div>
							<div class="row">
								<div class="col-12">
									<div class="d-grid">
										<button type="submit" id="submit" name="send" class="btn btn-primary">Send Message</button>
									</div>
								</div><!--end col-->
							</div><!--end row-->
						</form>
					</div><!--end custom-form-->
				</div><!--end col-->
			</div><!--end row-->
		</div><!--end container-->

		<div class="container-fluid mt-100 mt-60">
			<div class="row">
				<div class="col-12 p-0">
					<div class="card map border-0">
						<div class="card-body p-0">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d39206.002432144705!2d-95.4973981212445!3d29.709510002925988!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8640c16de81f3ca5%3A0xf43e0b60ae539ac9!2sGerald+D.+Hines+Waterwall+Park!5e0!3m2!1sen!2sin!4v1566305861440!5m2!1sen!2sin" style="border:0" allowfullscreen></iframe>
						</div>
					</div>
				</div><!--end col-->
			</div><!--end row-->
		</div><!--end container-->
		

@endsection