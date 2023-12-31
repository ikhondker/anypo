@extends('layouts.landlord')
@section('title','About Sub 1')

@section('content')
{{-- <script src="https://cdn.paddle.com/paddle/paddle.js"></script> --}}
<script src="https://cdn.paddle.com/paddle/v2/paddle.js"></script>


<!-- Content -->
<div id="about-section" class="container content-space-t-1">

	<h3>Paddle Sub</h3>

	<script src="https://cdn.paddle.com/paddle/v2/paddle.js"></script>
	<script type="text/javascript">
	  Paddle.Environment.set("sandbox");
	  Paddle.Setup({
		seller: 15117 // replace with your Paddle seller ID
	  });
	</script>

<script type="text/javascript">
	function openCheckout() {
	  Paddle.Checkout.open({
		settings: {
		  theme: "light",
		},
		items: [
		  {
			priceId: 'pri_01hcyxfsp4exswz4zzsweyxayf',
			quantity: 1
		  },
		]
	  });
	}
  </script>


<a href="#!" class="paddle_button" data-product="pri_01hcyxfsp4exswz4zzsweyxayf">Buy Now (12345)!</a>

<a href='#' class='paddle_button' data-theme='light'>Buy Now</a>



	{{-- <a href="#" class="paddle_button" data-product="1001">Buy Now!</a> --}}

	<div class="row mb-5">
	  <div class="col-md-3 order-md-2 mb-3 mb-md-0">
		<div class="ps-md-4">
		  <!-- List -->
		  <ul class="list-unstyled list-py-2">
			<li>
			  <h5>Founded</h5>
			  <p class="small mb-0">2009</p>
			</li>
			<li>
			  <h5>Company size</h5>
			  <p class="small mb-0">150 - 300</p>
			</li>
			<li>
			  <h5>Avg. Salary</h5>
			  <p class="small mb-0">$25 - $45</p>
			</li>
			<li>
			  <h5>Industry</h5>
			  <p class="small mb-0">Information Technology</p>
			</li>
			<li>
			  <h5>Links</h5>

			  <!-- Socials -->
			  <ul class="list-inline">
				<li class="list-inline-item">
				  <a class="btn btn-soft-secondary btn-xs btn-icon rounded-circle" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Capsule on Facebook">
					<i class="bi-facebook"></i>
				  </a>
				</li>

				<li class="list-inline-item">
				  <a class="btn btn-soft-secondary btn-xs btn-icon rounded-circle" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Capsule on Twitter">
					<i class="bi-twitter"></i>
				  </a>
				</li>

				<li class="list-inline-item">
				  <a class="btn btn-soft-secondary btn-xs btn-icon rounded-circle" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Capsule on Github">
					<i class="bi-github"></i>
				  </a>
				</li>
			  </ul>
			  <!-- End Socials -->
			</li>
		  </ul>
		  <!-- End List -->
		</div>
	  </div>
	  <!-- End Col -->

	  <div class="col-md-9">
		<div class="mb-5">
		  <p>Capsule was launched in 2009 following the founders' frustration with existing CRM services that were either overly simplistic or far too complex for most businesses. We believe the value of a modern CRM lies in the ability to help businesses stay organized, know more about their customers, build strong relationships and to make the most of sales opportunities, all while minimizing user input. We built Capsule to deliver on these values and today Capsule is used by thousands of businesses of all sizes all over the world.</p>

		  <div class="collapse" id="employerOverviewDescriptionCollapse">
			<p>We're based in Manchester, United Kingdom, a city with a creative heart that was founded on science and industry and the birthplace of the modern computer.</p>
		  </div>

		  <a class="link link-collapse" data-bs-toggle="collapse" href="#employerOverviewDescriptionCollapse" role="button" aria-expanded="false" aria-controls="employerOverviewDescriptionCollapse">
			<span class="link-collapse-default">Read more</span>
			<span class="link-collapse-active">Read less</span>
		  </a>
		</div>

		<div id="fancyboxGallery">
		  <div class="row gx-3">
			<div class="col-4 col-sm px-2 mb-3 mb-sm-0">
			  <!-- Media Viewer -->
			  <a class="media-viewer" href="../assets/img/900x900/img1.jpg" data-fslightbox="jobOverviewGallery">
				<img class="img-fluid rounded-2" src="../assets/img/900x900/img1.jpg" alt="Image Description">

				<span class="media-viewer-container">
				  <span class="media-viewer-icon">
					<i class="bi-plus media-viewer-icon-inner"></i>
				  </span>
				</span>
			  </a>
			  <!-- End Media Viewer -->
			</div>
			<!-- End Col -->

			<div class="col-4 col-sm px-2 mb-3 mb-sm-0">
			  <!-- Media Viewer -->
			  <a class="media-viewer" href="../assets/img/900x900/img8.jpg" data-fslightbox="jobOverviewGallery">
				<img class="img-fluid rounded-2" src="../assets/img/900x900/img8.jpg" alt="Image Description">

				<span class="media-viewer-container">
				  <span class="media-viewer-icon">
					<i class="bi-plus media-viewer-icon-inner"></i>
				  </span>
				</span>
			  </a>
			  <!-- End Media Viewer -->
			</div>
			<!-- End Col -->

			<div class="col-4 col-sm px-2 mb-3 mb-sm-0">
			  <!-- Media Viewer -->
			  <a class="media-viewer" href="../assets/img/900x900/img7.jpg" data-fslightbox="jobOverviewGallery">
				<img class="img-fluid rounded-2" src="../assets/img/900x900/img7.jpg" alt="Image Description">

				<span class="media-viewer-container">
				  <span class="media-viewer-icon">
					<i class="bi-plus media-viewer-icon-inner"></i>
				  </span>
				</span>
			  </a>
			  <!-- End Media Viewer -->
			</div>
			<!-- End Col -->

			<div class="col-4 col-sm px-2 mb-3 mb-sm-0">
			  <!-- Media Viewer -->
			  <a class="media-viewer" href="../assets/img/900x900/img23.jpg" data-fslightbox="jobOverviewGallery">
				<img class="img-fluid rounded-2" src="../assets/img/900x900/img23.jpg" alt="Image Description">

				<span class="media-viewer-container">
				  <span class="media-viewer-icon">
					<i class="bi-plus media-viewer-icon-inner"></i>
				  </span>
				</span>
			  </a>
			  <!-- End Media Viewer -->
			</div>
			<!-- End Col -->

			<div class="col-4 col-sm px-2 mb-3 mb-sm-0">
			  <!-- Media Viewer -->
			  <a class="media-viewer" href="../assets/img/900x900/img9.jpg" data-fslightbox="jobOverviewGallery">
				<img class="img-fluid rounded-2" src="../assets/img/900x900/img9.jpg" alt="Image Description">

				<span class="media-viewer-container">
				  <span class="media-viewer-icon media-viewer-icon-active">
					<span class="media-viewer-icon-inner">+2</span>
				  </span>
				</span>
			  </a>
			  <!-- End Media Viewer -->
			</div>
			<!-- End Col -->
		  </div>
		  <!-- End Row -->

		  <a class="d-none" href="../assets/img/900x900/img2.jpg" data-fslightbox="jobOverviewGallery"></a>
		  <a class="d-none" href="../assets/img/900x900/img19.jpg" data-fslightbox="jobOverviewGallery"></a>
		</div>
	  </div>
	  <!-- End Col -->
	</div>
	<!-- End Row -->
  </div>
  <!-- Content -->

	<!-- Features -->
	<div class="position-relative bg-light rounded-2 mx-3 mx-lg-10">
		<div class="container content-space-2 content-space-lg-3">
		<!-- Heading -->
		<div class="w-md-75 w-lg-50 text-center mx-md-auto mb-5">
			<h2>Wow your audience from the first second</h2>
			<p>The powerful and flexible theme for all kinds of businesses</p>
		</div>
		<!-- End Heading -->

		<div class="text-center mb-10">
			<!-- List Checked -->
			<ul class="list-inline list-checked list-checked-primary">
			<li class="list-inline-item list-checked-item">Responsive</li>
			<li class="list-inline-item list-checked-item">5-star support</li>
			<li class="list-inline-item list-checked-item">Constant updates</li>
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
					<img class="device-browser-img" src="../assets/img/1618x1010/img6.jpg" alt="Image Description">
				</div>
				</figure>
				<!-- End Browser Device -->
			</div>
			</div>
			<!-- End Col -->

			<div class="col-lg-5">
			<!-- Heading -->
			<div class="mb-4">
				<h2>Collaborative tools to design user experience</h2>
				<p>We help businesses bring ideas to life in the digital world, by designing and implementing the technology tools that they need to win.</p>
			</div>
			<!-- End Heading -->

			<!-- List Checked -->
			<ul class="list-checked list-checked-primary mb-5">
				<li class="list-checked-item">Less routine – more creativity</li>
				<li class="list-checked-item">Hundreds of thousands saved</li>
				<li class="list-checked-item">Scale budgets efficiently</li>
			</ul>
			<!-- End List Checked -->

			<a class="btn btn-primary" href="#">Get started</a>

			<hr class="my-5">

			<span class="d-block">Trusted by leading companies</span>

			<div class="row">
				<div class="col py-3">
				<img class="avatar avatar-4x3" src="../assets/svg/brands/fitbit-dark.svg" alt="Logo">
				</div>
				<!-- End Col -->

				<div class="col py-3">
				<img class="avatar avatar-4x3" src="../assets/svg/brands/forbes-dark.svg" alt="Logo">
				</div>
				<!-- End Col -->

				<div class="col py-3">
				<img class="avatar avatar-4x3" src="../assets/svg/brands/mailchimp-dark.svg" alt="Logo">
				</div>
				<!-- End Col -->

				<div class="col py-3">
				<img class="avatar avatar-4x3" src="../assets/svg/brands/layar-dark.svg" alt="Logo">
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


  @endsection

@section('bo04-content')


		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-5 col-md-6">
					<img src="{{asset('/site/images/about.jpg')}}" class="img-fluid rounded shadow" alt="">
				</div><!--end col-->

				<div class="col-lg-7 col-md-6 mt-4 pt-2 mt-sm-0 pt-sm-0">
					<div class="section-title ms-lg-5">
						<h4 class="title mb-3">We are a creative design studio!</h4>
						<p class="text-muted">This prevents repetitive patterns from impairing the overall visual impression and facilitates the comparison of different typefaces. Furthermore, it is advantageous when the dummy text is relatively realistic so that the layout impression of the final publication is not compromised.</p>
						<ul class="list-unstyled text-muted mb-0">
							<li class="mb-0"><span class="text-dark h5 me-2"><i class="uil uil-check-circle align-middle"></i></span>Beautiful and easy to understand animations</li>
							<li class="mb-0"><span class="text-dark h5 me-2"><i class="uil uil-check-circle align-middle"></i></span>Our Talented & Experienced Marketing Agency</li>
							<li class="mb-0"><span class="text-dark h5 me-2"><i class="uil uil-check-circle align-middle"></i></span>Theme advantages are pixel perfect design</li>
						</ul>
					</div>
				</div><!--end col-->
			</div><!--end row-->
		</div><!--end container-->

		<div class="container mt-100 mt-60">
			<div class="row justify-content-center">
				<div class="col-lg-4 col-md-6">
					<div class="card shadow p-4 rounded features features-classic feature-primary">
						<i class="uil uil-airplay h1 mb-0 text-primary"></i>

						<div class="content my-3 border-bottom">
							<a href="page-single-service.html" class="title h5 text-dark">Developing strategy</a>

							<p class="text-muted mt-3">It is said that song composers of the past used dummy texts as lyrics when writing to sing with the melody.</p>
						</div>

						<a href="page-single-service.html" class="d-flex align-items-center justify-content-between">
							<span class="fw-medium text-dark">Read More</span>
							<i class="mdi mdi-arrow-right"></i>
						</a>
					</div>
				</div><!--end col-->

				<div class="col-lg-4 col-md-6 mt-4 pt-2 mt-sm-0 pt-sm-0">
					<div class="card shadow p-4 rounded features features-classic feature-primary">
						<i class="uil uil-atom h1 mb-0 text-primary"></i>

						<div class="content my-3 border-bottom">
							<a href="page-single-service.html" class="title h5 text-dark">Blazing performance</a>

							<p class="text-muted mt-3">It is said that song composers of the past used dummy texts as lyrics when writing to sing with the melody.</p>
						</div>

						<a href="page-single-service.html" class="d-flex align-items-center justify-content-between">
							<span class="fw-medium text-dark">Read More</span>
							<i class="mdi mdi-arrow-right"></i>
						</a>
					</div>
				</div><!--end col-->

				<div class="col-lg-4 col-md-6 mt-4 pt-2 mt-lg-0 pt-lg-0">
					<div class="card shadow p-4 rounded features features-classic feature-primary">
						<i class="uil uil-users-alt h1 mb-0 text-primary"></i>

						<div class="content my-3 border-bottom">
							<a href="page-single-service.html" class="title h5 text-dark">Customer satisfaction</a>

							<p class="text-muted mt-3">It is said that song composers of the past used dummy texts as lyrics when writing to sing with the melody.</p>
						</div>

						<a href="page-single-service.html" class="d-flex align-items-center justify-content-between">
							<span class="fw-medium text-dark">Read More</span>
							<i class="mdi mdi-arrow-right"></i>
						</a>
					</div>
				</div><!--end col-->
			</div><!--end row-->
		</div><!--end container-->

		<div class="container-fluid px-0 mt-100 mt-60">
			<div class="bg-half-260" style="background: url('images/cta.jpg') top;">
				<div class="bg-overlay"></div>
				<div class="play-icon">
					<a href="javascript:void(0)" data-type="youtube" data-id="yba7hPeTSjk" class="play-btn lightbox">
						<i class="mdi mdi-play text-primary rounded-circle bg-white shadow"></i>
					</a>
				</div>
			</div>
		</div><!--end container-->

		<div class="container mt-100 mt-60">
			<div class="row justify-content-center">
				<div class="col-lg-9">
					<div class="tiny-single-item">
						<div class="tiny-slide px-md-5">
							<div class="card client-testi text-center">
								<img src="images/client/01.jpg" class="avatar avatar-small rounded-pill mx-auto" alt="">

								<div class="card-body pb-0 content">
									<p class="h5 fw-normal text-muted fst-italic">" The advantage of its Latin origin and the relative meaninglessness of Lorum Ipsum is that the text does not attract attention to itself or distract the viewer's attention from the layout. "</p>

									<div class="name mt-4">
										<small class="text-uppercase fw-semibold d-block">Johnny Rosario</small>
										<small class="text-muted">C.E.O</small>
									</div>
								</div>
							</div>
						</div>

						<div class="tiny-slide px-md-5">
							<div class="card client-testi text-center">
								<img src="images/client/02.jpg" class="avatar avatar-small rounded-pill mx-auto" alt="">

								<div class="card-body pb-0 content">
									<p class="h5 fw-normal text-muted fst-italic">" One disadvantage of Lorum Ipsum is that in Latin certain letters appear more frequently than others - which creates a distinct visual impression. "</p>

									<div class="name mt-4">
										<small class="text-uppercase fw-semibold d-block">Gale Larose</small>
										<small class="text-muted">Manager</small>
									</div>
								</div>
							</div>
						</div>

						<div class="tiny-slide px-md-5">
							<div class="card client-testi text-center">
								<img src="images/client/03.jpg" class="avatar avatar-small rounded-pill mx-auto" alt="">

								<div class="card-body pb-0 content">
									<p class="h5 fw-normal text-muted fst-italic">" Thus, Lorem Ipsum has only limited suitability as a visual filler for German texts. If the fill text is intended to illustrate the characteristics of different typefaces. "</p>

									<div class="name mt-4">
										<small class="text-uppercase fw-semibold d-block">Shelly Goodman</small>
										<small class="text-muted">Manager</small>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div><!--end col-->
			</div><!--end row-->
		</div><!--end container-->

		<!-- Partners start -->
		<div class="container mt-5">
			<div class="row justify-content-center">
				<div class="col-lg-2 col-md-2 col-6 text-center">
					<img src="images/client/logo-1.svg" class="img-fluid" alt="">
				</div><!--end col-->

				<div class="col-lg-2 col-md-2 col-6 text-center">
					<img src="images/client/logo-2.svg" class="img-fluid" alt="">
				</div><!--end col-->

				<div class="col-lg-2 col-md-2 col-6 text-center">
					<img src="images/client/logo-3.svg" class="img-fluid" alt="">
				</div><!--end col-->

				<div class="col-lg-2 col-md-2 col-6 text-center">
					<img src="images/client/logo-4.svg" class="img-fluid" alt="">
				</div><!--end col-->

				<div class="col-lg-2 col-md-2 col-6 text-center">
					<img src="images/client/logo-5.svg" class="img-fluid" alt="">
				</div><!--end col-->

				<div class="col-lg-2 col-md-2 col-6 text-center">
					<img src="images/client/logo-6.svg" class="img-fluid" alt="">
				</div><!--end col-->
			</div><!--end row-->
		</div><!--end container-->
		<!-- Partners End -->

		<div class="container-fluid mt-100 mt-60">
			<div class="row">
				<div class="col-12 px-0">
					<div class="tiny-six-item">
						<div class="tiny-slide">
							<div class="card team team-primary">
								<div class="card-img">
									<img src="images/client/09.jpg" class="img-fluid" alt="">
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
									<img src="images/client/10.jpg" class="img-fluid" alt="">
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
									<img src="images/client/11.jpg" class="img-fluid" alt="">
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
									<img src="images/client/12.jpg" class="img-fluid" alt="">
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
									<img src="images/client/13.jpg" class="img-fluid" alt="">
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
									<img src="images/client/14.jpg" class="img-fluid" alt="">
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
			<div class="row">
				<div class="col-md-3 col-6">
					<div class="counter-box position-relative text-center">
						<h2 class="mb-0 display-1 fw-bold title-dark mt-2 opacity-05"><span class="counter-value" data-target="5458">3</span></h2>
						<span class="counter-head fw-semibold title-dark position-absolute top-50 start-50 translate-middle">Investment Projects</span>
					</div><!--end counter box-->
				</div><!--end col-->

				<div class="col-md-3 col-6">
					<div class="counter-box position-relative text-center">
						<h2 class="mb-0 display-1 fw-bold title-dark mt-2 opacity-05"><span class="counter-value" data-target="15">1</span></h2>
						<span class="counter-head fw-semibold title-dark position-absolute top-50 start-50 translate-middle">Years of Experience</span>
					</div><!--end counter box-->
				</div><!--end col-->

				<div class="col-md-3 col-6">
					<div class="counter-box position-relative text-center">
						<h2 class="mb-0 display-1 fw-bold title-dark mt-2 opacity-05"><span class="counter-value" data-target="54">0</span></h2>
						<span class="counter-head fw-semibold title-dark position-absolute top-50 start-50 translate-middle">Offices in the World</span>
					</div><!--end counter box-->
				</div><!--end col-->

				<div class="col-md-3 col-6">
					<div class="counter-box position-relative text-center">
						<h2 class="mb-0 display-1 fw-bold title-dark mt-2 opacity-05"><span class="counter-value" data-target="214">3</span></h2>
						<span class="counter-head fw-semibold title-dark position-absolute top-50 start-50 translate-middle">Successful Cases</span>
					</div><!--end counter box-->
				</div><!--end col-->
			</div><!--end row-->
		</div><!--end container-->


@endsection