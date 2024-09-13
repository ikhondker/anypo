@extends('layouts.landlord.page')
@section('title','About Us')

@section('content')

<!-- Content -->
<div id="about-section" class="container content-space-t-1">
	<h3>About the company</h3>

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

