@extends('layouts.landlord')
@section('title','Home')

@section('content')
	 <!-- Hero Start -->
	 <section class="bg-half-170 bg-light pb-0 d-table w-100" style="background: url('{{ asset('/site/images/bg/corporate01.png') }} ') center center;">
		<div class="container">
			<div class="row mt-5 align-items-center">
				<div class="col-lg-7 col-md-6">
					<div class="title-heading">
						<h4 class="display-3 mb-4 fw-bold title-dark"> Insuring Your Future <br> From Today </h4>
						<p class="para-desc text-muted">From banking to wealth management and securities distribution, we dedicated financial services the teams serve all major sectors.</p>
						<div class="mt-4 pt-2">
							<a href="javascript:void(0)" class="btn btn-lg btn-pills btn-primary">Work with us</a>
						</div>
					</div>
				</div><!--end col-->

				<div class="col-lg-5 col-md-6 mt-5 mt-sm-0">
					<img src="{{asset('/site/images/corporate01.png')}}" class="img-fluid" alt="">
				</div>
			</div><!--end row-->
		</div> <!--end container-->
	</section><!--end section-->
	<!-- Hero End -->

	<!-- Start services -->
	<section class="section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12">
					<div class="section-title text-center mb-4 pb-2">
						<h4 class="title fw-semibold mb-3">Explore Solutions</h4>
						<p class="text-muted para-desc mx-auto mb-0">Our design projects are fresh and simple and will benefit your business greatly. Learn more about our work!</p>
					</div>
				</div><!--end col-->
			</div><!--end row-->

			<div class="row">
				<div class="col-lg-4 mt-4 pt-2">
					<div class="features feature-primary feature-bg border-0 p-4 rounded shadow">
						<div class="fea-icon rounded text-white title-dark">
							<i class="uil uil-airplay"></i>
						</div>

						<div class="content mt-3">
							<a href="page-single-service.html" class="title h5 text-dark">Responsive Design</a>
							<p class="text-muted para mt-2 mb-0">This prevents repetitive patterns from impairing the overall facilitates the comparison.</p>
						</div>
					</div>
				</div><!--end col-->

				<div class="col-lg-4 col-md-6 mt-4 pt-2">
					<div class="features feature-primary feature-bg border-0 p-4 rounded shadow">
						<div class="fea-icon rounded text-white title-dark">
							<i class="uil uil-eye"></i>
						</div>

						<div class="content mt-3">
							<a href="page-single-service.html" class="title h5 text-dark">Retina Ready Graphics</a>
							<p class="text-muted para mt-2 mb-0">This prevents repetitive patterns from impairing the overall facilitates the comparison.</p>
						</div>
					</div>
				</div><!--end col-->

				<div class="col-lg-4 col-md-6 mt-4 pt-2">
					<div class="features feature-primary feature-bg border-0 p-4 rounded shadow">
						<div class="fea-icon rounded text-white title-dark">
							<i class="uil uil-tachometer-fast-alt"></i>
						</div>

						<div class="content mt-3">
							<a href="page-single-service.html" class="title h5 text-dark">Powerful Performance</a>
							<p class="text-muted para mt-2 mb-0">This prevents repetitive patterns from impairing the overall facilitates the comparison.</p>
						</div>
					</div>
				</div><!--end col-->

				<div class="col-lg-4 col-md-6 mt-4 pt-2">
					<div class="features feature-primary feature-bg border-0 p-4 rounded shadow">
						<div class="fea-icon rounded text-white title-dark">
							<i class="uil uil-palette"></i>
						</div>

						<div class="content mt-3">
							<a href="page-single-service.html" class="title h5 text-dark">Unlimited Color Options</a>
							<p class="text-muted para mt-2 mb-0">This prevents repetitive patterns from impairing the overall facilitates the comparison.</p>
						</div>
					</div>
				</div><!--end col-->

				<div class="col-lg-4 col-md-6 mt-4 pt-2">
					<div class="features feature-primary feature-bg border-0 p-4 rounded shadow">
						<div class="fea-icon rounded text-white title-dark">
							<i class="uil uil-font"></i>
						</div>

						<div class="content mt-3">
							<a href="page-single-service.html" class="title h5 text-dark">Customizable Fonts</a>
							<p class="text-muted para mt-2 mb-0">This prevents repetitive patterns from impairing the overall facilitates the comparison.</p>
						</div>
					</div>
				</div><!--end col-->

				<div class="col-lg-4 col-md-6 mt-4 pt-2">
					<div class="features feature-primary feature-bg border-0 p-4 rounded shadow">
						<div class="fea-icon rounded text-white title-dark">
							<i class="uil uil-file-upload-alt"></i>
						</div>

						<div class="content mt-3">
							<a href="page-single-service.html" class="title h5 text-dark">Free Updates</a>
							<p class="text-muted para mt-2 mb-0">This prevents repetitive patterns from impairing the overall facilitates the comparison.</p>
						</div>
					</div>
				</div><!--end col-->
			</div><!--end row-->
		</div><!--end container-->

		<div class="container mt-100 mt-60">
			<div class="row align-items-center">
				<div class="col-lg-5 col-md-6">
					<img src="{{asset('/site/images/about02.jpg')}}" class="img-fluid rounded shadow" alt="">
				</div><!--end col-->

				<div class="col-lg-7 col-md-6 mt-4 mt-sm-0 pt-2 pt-sm-0">
					<div class="section-title ms-lg-5">
						<h4 class="title fw-semibold mb-3">Crafted For Digital Agency.</h4>
						<p class="text-muted para-desc mb-0">The advantage of its Latin origin and the relative meaninglessness of Lorum Ipsum is that the text does not attract attention to itself or distract the viewer's attention from the layout.</p>
					
						<div class="row mt-4">
							<div class="col-lg-6 col-12">
								<ul class="mb-0 list-unstyled">
									<li class="mb-0"><span class="text-primary h4 me-2"><i class="uil uil-check-circle align-middle"></i></span> Fully Responsive</li>
									<li class="mb-0"><span class="text-primary h4 me-2"><i class="uil uil-check-circle align-middle"></i></span> Finance & Restructuring </li>
									<li class="mb-0"><span class="text-primary h4 me-2"><i class="uil uil-check-circle align-middle"></i></span> Audit & Assurance </li>
									<li class="mb-0"><span class="text-primary h4 me-2"><i class="uil uil-check-circle align-middle"></i></span> Trades & Stock Market </li>
								</ul>
							</div><!--end col-->

							<div class="col-lg-6 col-12">
								<ul class="mb-0 list-unstyled">
									<li class="mb-0"><span class="text-primary h4 me-2"><i class="uil uil-check-circle align-middle"></i></span> Strategy & Planning </li>
									<li class="mb-0"><span class="text-primary h4 me-2"><i class="uil uil-check-circle align-middle"></i></span> Software & Research </li>
									<li class="mb-0"><span class="text-primary h4 me-2"><i class="uil uil-check-circle align-middle"></i></span> Support & Maintenance </li>
								</ul>
							</div><!--end col-->
						</div><!--end row-->

						<div class="mt-4">
							<a href="javascript:void(0)" class="btn btn-primary">Read More <i class="uil uil-arrow-right align-middle"></i></a>
						</div>
					</div>
				</div><!--end col-->
			</div><!--end row-->
		</div><!--end container-->
	</section><!--end section-->
	<!-- End services -->

	<!-- Start -->
	<section class="section bg-light">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12 mb-4 pb-2">
					<div class="section-title text-center">
						<h4 class="title fw-semibold mb-3">Meet Our Team Expert</h4>
						<p class="text-muted para-desc mx-auto mb-0">Our design projects are fresh and simple and will benefit your business greatly. Learn more about our work!</p>
					</div>
				</div><!--end col-->
			</div><!--end row-->
		</div><!--end container-->

		<div class="container-fluid mt-4 pt-2">
			<div class="row">
				<div class="col-12 px-0">
					<div class="tiny-six-item">
						<div class="tiny-slide">
							<div class="card team team-primary">
								<div class="card-img">
									<img src="{{asset('/site/images/client/09.jpg')}}" class="img-fluid" alt="">
									<div class="card-overlay"></div>
								</div>
								<div class="team-content">
									<a href="javascript:void(0)" class="h6 name text-uppercase d-block mb-0 text-white title-dark">Dennis Rosario</a>
									<small class="text-white title-dark">C.E.O</small>
								</div>
							</div>
						</div>
						
						<div class="tiny-slide">
							<div class="card team team-primary">
								<div class="card-img">
									<img src="{{asset('/site/images/client/10.jpg')}}" class="img-fluid" alt="">
									<div class="card-overlay"></div>
								</div>
								<div class="team-content">
									<div class="name">
										<a href="javascript:void(0)" class="h6 name text-uppercase d-block mb-0 text-white title-dark">Billy Gregory</a>
										<small class="text-white title-dark">Manager</small>
									</div>
								</div>
							</div>
						</div>
						
						<div class="tiny-slide">
							<div class="card team team-primary">
								<div class="card-img">
									<img src="{{asset('/site/images/client/11.jpg')}}" class="img-fluid" alt="">
									<div class="card-overlay"></div>
								</div>
								<div class="team-content">
									<div class="name">
										<a href="javascript:void(0)" class="h6 name text-uppercase d-block mb-0 text-white title-dark">Connie Dunton</a>
										<small class="text-white title-dark">Manager</small>
									</div>
								</div>
							</div>
						</div>
						
						<div class="tiny-slide">
							<div class="card team team-primary">
								<div class="card-img">
									<img src="{{asset('/site/images/client/12.jpg')}}" class="img-fluid" alt="">
									<div class="card-overlay"></div>
								</div>
								<div class="team-content">
									<div class="name">
										<a href="javascript:void(0)" class="h6 name text-uppercase d-block mb-0 text-white title-dark">Alberta Petty</a>
										<small class="text-white title-dark">Manager</small>
									</div>
								</div>
							</div>
						</div>
						
						<div class="tiny-slide">
							<div class="card team team-primary">
								<div class="card-img">
									<img src="{{asset('/site/images/client/13.jpg')}}" class="img-fluid" alt="">
									<div class="card-overlay"></div>
								</div>
								<div class="team-content">
									<div class="name">
										<a href="javascript:void(0)" class="h6 name text-uppercase d-block mb-0 text-white title-dark">Shirley Garcia</a>
										<small class="text-white title-dark">Manager</small>
									</div>
								</div>
							</div>
						</div>
						
						<div class="tiny-slide">
							<div class="card team team-primary">
								<div class="card-img">
									<img src="{{asset('/site/images/client/14.jpg')}}" class="img-fluid" alt="">
									<div class="card-overlay"></div>
								</div>
								<div class="team-content">
									<div class="name">
										<a href="javascript:void(0)" class="h6 name text-uppercase d-block mb-0 text-white title-dark">Michael Wheeler</a>
										<small class="text-white title-dark">Manager</small>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div><!--end col-->
			</div><!--end row-->
		</div><!--end container-->

		<div class="container mt-100 mt-60">
			<div class="row align-items-center">
				<div class="col-lg-5 col-md-6">
					<div class="section-title mb-4 pb-2 mb-md-0 pb-md-0 me-lg-5">
						<h4 class="title fw-semibold mb-3">Our Skills & Expertise</h4>
						<p class="text-muted para-desc mb-0">Our design projects are fresh and simple and will benefit your business greatly. Learn more about our work!</p>
					</div>
				</div><!--end col-->

				<div class="col-lg-7 col-md-6 mt-4 pt-2 mt-sm-0 pt-sm-0">
					<div class="ms-lg-5">
						<div class="progress-box">
							<h6 class="text-muted fw-normal">Research</h6>
							<div class="progress position-relative">
								<div class="progress-bar position-relative bg-primary" style="width:84%;"></div>
								<div class="progress-value d-block text-muted h6 fw-normal">84%</div>
							</div>
						</div><!--end process box-->

						<div class="progress-box mt-4">
							<h6 class="text-muted fw-normal">Sales & Trading</h6>
							<div class="progress position-relative">
								<div class="progress-bar position-relative bg-primary" style="width:75%;"></div>
								<div class="progress-value d-block text-muted h6 fw-normal">75%</div>
							</div>
						</div><!--end process box-->

						<div class="progress-box mt-4">
							<h6 class="text-muted fw-normal">Investment</h6>
							<div class="progress position-relative">
								<div class="progress-bar position-relative bg-primary" style="width:79%;"></div>
								<div class="progress-value d-block text-muted h6 fw-normal">79%</div>
							</div>
						</div><!--end process box-->

						<div class="progress-box mt-4">
							<h6 class="text-muted fw-normal">Finance</h6>
							<div class="progress position-relative">
								<div class="progress-bar position-relative bg-primary" style="width:95%;"></div>
								<div class="progress-value d-block text-muted h6 fw-normal">95%</div>
							</div>
						</div><!--end process box-->
					</div>
				</div><!--end col-->
			</div><!--end row-->
		</div><!--end container-->
	</section><!--end container-->
	<!-- End -->

	<!-- Start CTA -->
	<section class="bg-cta" style="background: url({{asset('images/cta03.jpg')}} center;">
		<div class="container">
			<div class="row justify-content-end">
				<div class="col-lg-4 col-md-6 col-12">
					<div class="card py-5 px-4 border-0 rounded bg-white">
						<div class="tiny-single-item">
							<div class="tiny-slide">
								<div class="card client-testi text-center">
									<img src="{{asset('/site/images/client/01.jpg')}}" class="avatar avatar-small rounded-pill mx-auto" alt="">

									<div class="card-body pb-0 content">
										<p class="h6 fw-normal text-muted fst-italic">" The advantage of its Latin origin and the relative meaninglessness of Lorum Ipsum is that the text does not attract attention to itself or distract the viewer's attention from the layout. "</p>

										<div class="name mt-4">
											<small class="text-uppercase fw-semibold d-block">Johnny Rosario</small>
											<small class="text-muted">C.E.O</small>
										</div>
									</div>
								</div>
							</div>
							
							<div class="tiny-slide">
								<div class="card client-testi text-center">
									<img src="{{asset('/site/images/client/02.jpg')}}" class="avatar avatar-small rounded-pill mx-auto" alt="">

									<div class="card-body pb-0 content">
										<p class="h6 fw-normal text-muted fst-italic">" One disadvantage of Lorum Ipsum is that in Latin certain letters appear more frequently than others - which creates a distinct visual impression. "</p>

										<div class="name mt-4">
											<small class="text-uppercase fw-semibold d-block">Gale Larose</small>
											<small class="text-muted">Manager</small>
										</div>
									</div>
								</div>
							</div>
							
							<div class="tiny-slide">
								<div class="card client-testi text-center">
									<img src="{{asset('/site/images/client/03.jpg')}}" class="avatar avatar-small rounded-pill mx-auto" alt="">

									<div class="card-body pb-0 content">
										<p class="h6 fw-normal text-muted fst-italic">" Thus, Lorem Ipsum has only limited suitability as a visual filler for German texts. If the fill text is intended to illustrate the characteristics of different typefaces. "</p>

										<div class="name mt-4">
											<small class="text-uppercase fw-semibold d-block">Shelly Goodman</small>
											<small class="text-muted">Manager</small>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div><!--end col-->
			</div><!--end row-->
		</div><!--end container-->
	</section><!--end section-->
	<!-- End CTA -->

	<!-- Start -->
	<section class="section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-12">
					<div class="section-title text-center mb-4 pb-2">
						<h6 class="text-primary">Blogs</h6>
						<h4 class="title fw-semibold mt-2 mb-3">Latest Blog & News</h4>
						<p class="text-muted para-desc mx-auto mb-0">Our design projects are fresh and simple and will benefit your business greatly. Learn more about our work!</p>
					</div>
				</div><!--end col-->
			</div><!--end row-->

			<div class="row justify-content-center">
				<div class="col-lg-4 col-md-6 mt-4 pt-2">
					<div class="card blog blog-primary shadow rounded overflow-hidden">
						<div class="image position-relative overflow-hidden">
							<img src="{{asset('/site/images/blog/01.jpg')}}" class="img-fluid" alt="">

							<div class="blog-tag">
								<a href="javascript:void(0)" class="badge bg-light">Corporate</a>
							</div>
						</div>

						<div class="card-body content">
							<a href="blog-detail-four.html" class="h5 title text-dark d-block mb-0">Building Your Corporate Identity from Starty</a>
							<p class="text-muted mt-2 mb-2">The most well-known dummy text is the 'Lorem Ipsum', in the 16th century.</p>
							<a href="blog-detail-four.html" class="link text-dark">Read More <i class="uil uil-arrow-right align-middle"></i></a>
						</div>
					</div>
				</div><!--end col-->

				<div class="col-lg-4 col-md-6 mt-4 pt-2">
					<div class="card blog blog-primary shadow rounded overflow-hidden">
						<div class="image position-relative overflow-hidden">
							<img src="{{asset('/site/images/blog/02.jpg')}}" class="img-fluid" alt="">

							<div class="blog-tag">
								<a href="javascript:void(0)" class="badge bg-light">Branding</a>
							</div>
						</div>

						<div class="card-body content">
							<a href="blog-detail-four.html" class="h5 title text-dark d-block mb-0">The Dark Side of Overnight Success</a>
							<p class="text-muted mt-2 mb-2">The most well-known dummy text is the 'Lorem Ipsum', in the 16th century.</p>
							<a href="blog-detail-four.html" class="link text-dark">Read More <i class="uil uil-arrow-right align-middle"></i></a>
						</div>
					</div>
				</div><!--end col-->
				
				<div class="col-lg-4 col-md-6 mt-4 pt-2">
					<div class="card blog blog-primary shadow rounded overflow-hidden">
						<div class="image position-relative overflow-hidden">
							<img src="{{asset('/site/images/blog/03.jpg')}}" class="img-fluid" alt="">

							<div class="blog-tag">
								<a href="javascript:void(0)" class="badge bg-light">Technology</a>
							</div>
						</div>

						<div class="card-body content">
							<a href="blog-detail-four.html" class="h5 title text-dark d-block mb-0">The Right Hand of Business IT World</a>
							<p class="text-muted mt-2 mb-2">The most well-known dummy text is the 'Lorem Ipsum', in the 16th century.</p>
							<a href="blog-detail-four.html" class="link text-dark">Read More <i class="uil uil-arrow-right align-middle"></i></a>
						</div>
					</div>
				</div><!--end col-->
			</div><!--end row-->
		</div><!--end container-->
	</section><!--end section-->
	<!-- End -->

	<!-- CTA Start -->
	<div class="container-fluid px-0">
		<div class="py-5 position-relative" style="background: url('images/cta02.jpg') center;">
			<div class="bg-overlay bg-gradient-overlay"></div>
			<div class="container my-5">
				<div class="row align-items-center">
					<div class="col-lg-8 col-md-7">
						<h4 class="display-6 h4 mb-0 text-white title-dark fw-medium">Make your website unforgettable <br> Join the Starty community.</h4>
					</div><!--end col-->

					<div class="col-lg-4 col-md-5 text-md-end mt-4 mt-sm-0">
						<a href="javascript:void(0)" class="btn btn-light">Join us Now</a>
					</div><!--end col-->
				</div><!--end row-->
			</div><!--end container-->
		</div><!--end bg image-->
	</div><!--end container-->
	<!-- CTA End -->
@endsection