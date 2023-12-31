@extends('layouts.landlord')
@section('title','FAQ')
@section('content')

<!-- Hero -->
<div class="bg-img-start" style="background-image: url(./assets/svg/components/card-11.svg);">
	<div class="container content-space-t-3 content-space-t-lg-5 content-space-b-2">
		<div class="w-md-75 w-lg-50 text-center mx-md-auto">
			<h1>FAQ</h1>
			<p>Search our FAQ for answers to anything you might ask.</p>
		</div>
	</div>
</div>
<!-- End Hero -->

<!-- FAQ -->
<div class="container content-space-2 content-space-b-lg-3">
		<div class="w-lg-75 mx-lg-auto">
			<div class="d-grid gap-10">
				<div class="d-grid gap-3">
					<h2>Basics 1</h2>
	
					<!-- Accordion -->
					<div class="accordion accordion-flush accordion-lg" id="accordionFAQBasics">
						<!-- Accordion Item -->
						<div class="accordion-item">
							<div class="accordion-header" id="headingBasicsOne">
								<a class="accordion-button" role="button" data-bs-toggle="collapse" data-bs-target="#collapseBasicsOne" aria-expanded="true" aria-controls="collapseBasicsOne">
									What methods of payments are supported?
								</a>
							</div>
							<div id="collapseBasicsOne" class="accordion-collapse collapse show" aria-labelledby="headingBasicsOne" data-bs-parent="#accordionFAQBasics">
								<div class="accordion-body">
									You can purchase the themes on Bootstrap Themes via any major credit/debit card (via Stripe) or with your Paypal account. We don't support cryptocurrencies or invoicing at this time.
								</div>
							</div>
						</div>
						<!-- End Accordion Item -->
	
						<!-- Accordion Item -->
						<div class="accordion-item">
							<div class="accordion-header" id="headingBasicsTwo">
								<a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapseBasicsTwo" aria-expanded="false" aria-controls="collapseBasicsTwo">
									Can I cancel at anytime?
								</a>
							</div>
							<div id="collapseBasicsTwo" class="accordion-collapse collapse" aria-labelledby="headingBasicsTwo" data-bs-parent="#accordionFAQBasics">
								<div class="accordion-body">
									If you'd like a refund please reach out to us at <a href="#">themes@getbootstrap.com</a>. If you need technical help with the theme before a refund please reach out to the seller first and they can get in touch with us if they're unable to resolve the issue.
								</div>
							</div>
						</div>
						<!-- End Accordion Item -->
	
						<!-- Accordion Item -->
						<div class="accordion-item">
							<div class="accordion-header" id="headingBasicsThree">
								<a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapseBasicsThree" aria-expanded="false" aria-controls="collapseBasicsThree">
									How do I get a receipt for my purchase?
								</a>
							</div>
							<div id="collapseBasicsThree" class="accordion-collapse collapse" aria-labelledby="headingBasicsThree" data-bs-parent="#accordionFAQBasics">
								<div class="accordion-body">
									You'll receive an email from Bootstrap themes once your purchase is complete.
								</div>
							</div>
						</div>
						<!-- End Accordion Item -->
	
						<!-- Accordion Item -->
						<div class="accordion-item">
							<div class="accordion-header" id="headingBasicsFour">
								<a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapseBasicsFour" aria-expanded="false" aria-controls="collapseBasicsFour">
									Which license do I need?
								</a>
							</div>
							<div id="collapseBasicsFour" class="accordion-collapse collapse" aria-labelledby="headingBasicsFour" data-bs-parent="#accordionFAQBasics">
								<div class="accordion-body">
									There are three license types - <a href="#">Standard</a>, <a href="#">Multisite</a>, and <a href="#">Extended</a>. We've provided the table below for a quick look at the difference between the them, as well as a few examples of ways each license could be used. If you'd like more of the nitty-gritty details you can find them below and always feel free to reach out with any questions you have at <a href="#">themes@getbootstrap.com</a>.
								</div>
							</div>
						</div>
						<!-- End Accordion Item -->
	
						<!-- Accordion Item -->
						<div class="accordion-item">
							<div class="accordion-header" id="headingBasicsFive">
								<a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapseBasicsFive" aria-expanded="false" aria-controls="collapseBasicsFive">
									How do I get access to a theme I purchased?
								</a>
							</div>
							<div id="collapseBasicsFive" class="accordion-collapse collapse" aria-labelledby="headingBasicsFive" data-bs-parent="#accordionFAQBasics">
								<div class="accordion-body">
									If you lose the link for a theme you purchased, don't panic! We've got you covered. You can login to your account, tap your avatar in the upper right corner, and tap Purchases. If you didn't create a login or can't remember the information, you can use our handy Redownload page, just remember to use the same email you originally made your purchases with.
								</div>
							</div>
						</div>
						<!-- End Accordion Item -->
	
						<!-- Accordion Item -->
						<div class="accordion-item">
							<div class="accordion-header" id="headingBasicsSix">
								<a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapseBasicsSix" aria-expanded="false" aria-controls="collapseBasicsSix">
									Upgrade License Type
								</a>
							</div>
							<div id="collapseBasicsSix" class="accordion-collapse collapse" aria-labelledby="headingBasicsSix" data-bs-parent="#accordionFAQBasics">
								<div class="accordion-body">
									There may be times when you need to upgrade your license from the original type you purchased and we have a solution that ensures you can apply your original purchase cost to the new license purchase.
								</div>
							</div>
						</div>
						<!-- End Accordion Item -->
					</div>
					<!-- End Accordion -->
				</div>
	
				<div class="d-grid gap-3">
					<h2>Support</h2>
	
					<!-- Accordion -->
					<div class="accordion accordion-flush accordion-lg" id="accordionFAQSupport">
						<!-- Accordion Item -->
						<div class="accordion-item">
							<div class="accordion-header" id="headingSupportOne">
								<a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapseSupportOne" aria-expanded="false" aria-controls="collapseSupportOne">
									How do I get help with the theme I purchased?
								</a>
							</div>
							<div id="collapseSupportOne" class="accordion-collapse collapse" aria-labelledby="headingSupportOne" data-bs-parent="#accordionFAQSupport">
								<div class="accordion-body">
									Technical support for each theme is given directly by the creator of the theme. You'll be given a link to contact their support in a couple places:
	
									<ul>
										<li>Your confirmation email: Each theme in your confirmation email will have both the download link for your theme, and a "support" link which will connect you directly with the sellers support system or email.</li>
										<li>While logged in to your account go to Purchases > Click the Order # > Get Support</li>
									</ul>
								</div>
							</div>
						</div>
						<!-- End Accordion Item -->
	
						<!-- Accordion Item -->
						<div class="accordion-item">
							<div class="accordion-header" id="headingSupportTwo">
								<a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapseSupportTwo" aria-expanded="false" aria-controls="collapseSupportTwo">
									What version of Bootstrap are the themes built on?
								</a>
							</div>
							<div id="collapseSupportTwo" class="accordion-collapse collapse" aria-labelledby="headingSupportTwo" data-bs-parent="#accordionFAQSupport">
								<div class="accordion-body">
									All of the themes are built on versions of Bootstrap v4, currently all are on the v4.0.0 stable build. As more Bootstrap updates are launched the themes will be update as needed and as new features and bug fixes come out. You will want to download any updates that come out and update your installation as required.
								</div>
							</div>
						</div>
						<!-- End Accordion Item -->
	
						<!-- Accordion Item -->
						<div class="accordion-item">
							<div class="accordion-header" id="headingSupportThree">
								<a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapseSupportThree" aria-expanded="false" aria-controls="collapseSupportThree">
									What if I have a question that isn't answered here?
								</a>
							</div>
							<div id="collapseSupportThree" class="accordion-collapse collapse" aria-labelledby="headingSupportThree" data-bs-parent="#accordionFAQSupport">
								<div class="accordion-body">
									For anything we haven't covered feel free to reach out to the Bootstrap Themes team at <a href="#">themes@getbootstrap.com</a> !We're here to help.
								</div>
							</div>
						</div>
						<!-- End Accordion Item -->
	
						<!-- Accordion Item -->
						<div class="accordion-item">
							<div class="accordion-header" id="headingSupportFour">
								<a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapseSupportFour" aria-expanded="false" aria-controls="collapseSupportFour">
									Uh oh! Where's my theme download?
								</a>
							</div>
							<div id="collapseSupportFour" class="accordion-collapse collapse" aria-labelledby="headingSupportFour" data-bs-parent="#accordionFAQSupport">
								<div class="accordion-body">
									We just switched to a whole new platform and if you're a customer from our previous platform, we will be migrating you to the new platform, but in the meantime your download link for our old platform won't work.
								</div>
							</div>
						</div>
						<!-- End Accordion Item -->
					</div>
					<!-- End Accordion -->
				</div>
	
				<div class="d-grid gap-3">
					<h2>Payments</h2>
	
					<!-- Accordion -->
					<div class="accordion accordion-flush accordion-lg" id="accordionFAQPayments">
						<!-- Accordion Item -->
						<div class="accordion-item">
							<div class="accordion-header" id="headingPaymentsOne">
								<a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapsePaymentsOne" aria-expanded="false" aria-controls="collapsePaymentsOne">
									What methods of payments are supported?
								</a>
							</div>
							<div id="collapsePaymentsOne" class="accordion-collapse collapse" aria-labelledby="headingPaymentsOne" data-bs-parent="#accordionFAQPayments">
								<div class="accordion-body">
									You can purchase the themes on Bootstrap Themes via any major credit/debit card (via Stripe) or with your Paypal account. We don't support cryptocurrencies or invoicing at this time.
								</div>
							</div>
						</div>
						<!-- End Accordion Item -->
	
						<!-- Accordion Item -->
						<div class="accordion-item">
							<div class="accordion-header" id="headingPaymentsTwo">
								<a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapsePaymentsTwo" aria-expanded="false" aria-controls="collapsePaymentsTwo">
									How do I get a receipt for my purchase?
								</a>
							</div>
							<div id="collapsePaymentsTwo" class="accordion-collapse collapse" aria-labelledby="headingPaymentsTwo" data-bs-parent="#accordionFAQPayments">
								<div class="accordion-body">
									You'll receive an email from Bootstrap themes once your purchase is complete.
								</div>
							</div>
						</div>
						<!-- End Accordion Item -->
	
						<!-- Accordion Item -->
						<div class="accordion-item">
							<div class="accordion-header" id="headingPaymentsThree">
								<a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapsePaymentsThree" aria-expanded="false" aria-controls="collapsePaymentsThree">
									How can I get a refund?
								</a>
							</div>
							<div id="collapsePaymentsThree" class="accordion-collapse collapse" aria-labelledby="headingPaymentsThree" data-bs-parent="#accordionFAQPayments">
								<div class="accordion-body">
									If you'd like a refund please reach out to us at <a href="#">themes@getbootstrap.com</a>. If you need technical help with the theme before a refund please reach out to the seller first and they can get in touch with us if they're unable to resolve the issue.
								</div>
							</div>
						</div>
						<!-- End Accordion Item -->
					</div>
					<!-- End Accordion -->
				</div>
			</div>
		</div>
</div>
<!-- End FAQ -->
@endsection

@section('bo04-content')

				<div class="container">
						<div class="row">
								<div class="col-lg-4 col-md-5 col-12">
										<div class="card section-title bg-white p-4 shadow rounded border-0">
												<ul class="nav nav-pills nav-justified flex-column bg-transparent mb-0" id="pills-tab" role="tablist">
														<li class="nav-item">
																<a class="nav-link rounded shadow active" id="pills-buying-tab" data-bs-toggle="pill" href="#pills-buying" role="tab" aria-controls="pills-buying" aria-selected="false">
																		<div class="text-start py-1 px-3">
																				<h6 class="mb-0">Buying Questions</h6>
																		</div>
																</a><!--end nav link-->
														</li><!--end nav item-->
														
														<li class="nav-item mt-3">
																<a class="nav-link rounded shadow" id="pills-general-tab" data-bs-toggle="pill" href="#pills-general" role="tab" aria-controls="pills-general" aria-selected="false">
																		<div class="text-start py-1 px-3">
																				<h6 class="mb-0">General Questions</h6>
																		</div>
																</a><!--end nav link-->
														</li><!--end nav item-->
														
														<li class="nav-item mt-3">
																<a class="nav-link rounded shadow" id="pills-payment-tab" data-bs-toggle="pill" href="#pills-payment" role="tab" aria-controls="pills-payment" aria-selected="false">
																		<div class="text-start py-1 px-3">
																				<h6 class="mb-0">Payments Questions</h6>
																		</div>
																</a><!--end nav link-->
														</li><!--end nav item-->

														<li class="nav-item mt-3">
																<a class="nav-link rounded shadow" id="pills-support-tab" data-bs-toggle="pill" href="#pills-support" role="tab" aria-controls="pills-support" aria-selected="false">
																		<div class="text-start py-1 px-3">
																				<h6 class="mb-0">Support Questions</h6>
																		</div>
																</a><!--end nav link-->
														</li><!--end nav item-->
												</ul><!--end nav pills-->
										</div>
								</div>

								<div class="col-lg-8 col-md-7 col-12 mt-4 pt-2 mt-sm-0 pt-sm-0">
										<div class="tab-content" id="pills-tabContent">
												<div class="tab-pane fade show active" id="pills-buying" role="tabpanel" aria-labelledby="pills-buying-tab">
														<div class="section-title" id="tech">
																<h4>Buying Product</h4>
														</div>
		
														<div class="accordion mt-4 pt-2" id="buyingquestion">
																<div class="accordion-item rounded border-0 shadow">
																		<h2 class="accordion-header" id="headingOne">
																				<button class="accordion-button border-0 bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
																						aria-expanded="true" aria-controls="collapseOne">
																						How does it work ?
																				</button>
																		</h2>
																		<div id="collapseOne" class="accordion-collapse border-0 collapse show" aria-labelledby="headingOne"
																				data-bs-parent="#buyingquestion">
																				<div class="accordion-body text-muted bg-white">
																						There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.
																				</div>
																		</div>
																</div>
																
																<div class="accordion-item rounded border-0 shadow mt-3">
																		<h2 class="accordion-header" id="headingTwo">
																				<button class="accordion-button border-0 bg-white collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
																						aria-expanded="false" aria-controls="collapseTwo">
																						Do I need a designer to use Starty ?
																				</button>
																		</h2>
																		<div id="collapseTwo" class="accordion-collapse border-0 collapse" aria-labelledby="headingTwo"
																				data-bs-parent="#buyingquestion">
																				<div class="accordion-body text-muted bg-white">
																						There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.
																				</div>
																		</div>
																</div>
		
																<div class="accordion-item rounded border-0 shadow mt-3">
																		<h2 class="accordion-header" id="headingThree">
																				<button class="accordion-button border-0 bg-white collapsed" type="button" data-bs-toggle="collapse"
																						data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
																						What do I need to do to start selling ?
																				</button>
																		</h2>
																		<div id="collapseThree" class="accordion-collapse border-0 collapse" aria-labelledby="headingThree"
																				data-bs-parent="#buyingquestion">
																				<div class="accordion-body text-muted bg-white">
																						There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.
																				</div>
																		</div>
																</div>
		
																<div class="accordion-item rounded border-0 shadow mt-3">
																		<h2 class="accordion-header" id="headingFour">
																				<button class="accordion-button border-0 bg-white collapsed" type="button" data-bs-toggle="collapse"
																						data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
																						What happens when I receive an order ?
																				</button>
																		</h2>
																		<div id="collapseFour" class="accordion-collapse border-0 collapse" aria-labelledby="headingFour"
																				data-bs-parent="#buyingquestion">
																				<div class="accordion-body text-muted bg-white">
																						There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.
																				</div>
																		</div>
																</div>
														</div>
												</div><!--end teb pane-->
												
												<div class="tab-pane fade" id="pills-general" role="tabpanel" aria-labelledby="pills-general-tab">
														<div class="section-title" id="general">
																<h4>General Questions</h4>
														</div>
		
														<div class="accordion mt-4 pt-2" id="generalquestion">
																<div class="accordion-item rounded border-0 shadow">
																		<h2 class="accordion-header" id="headingfive">
																				<button class="accordion-button border-0 bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapsefive"
																						aria-expanded="true" aria-controls="collapsefive">
																						How does it work ?
																				</button>
																		</h2>
																		<div id="collapsefive" class="accordion-collapse border-0 collapse show" aria-labelledby="headingfive"
																				data-bs-parent="#generalquestion">
																				<div class="accordion-body text-muted bg-white">
																						There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.
																				</div>
																		</div>
																</div>
																
																<div class="accordion-item rounded border-0 shadow mt-3">
																		<h2 class="accordion-header" id="headingsix">
																				<button class="accordion-button border-0 bg-white collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsesix"
																						aria-expanded="false" aria-controls="collapsesix">
																						Do I need a designer to use Starty ?
																				</button>
																		</h2>
																		<div id="collapsesix" class="accordion-collapse border-0 collapse" aria-labelledby="headingsix"
																				data-bs-parent="#generalquestion">
																				<div class="accordion-body text-muted bg-white">
																						There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.
																				</div>
																		</div>
																</div>
		
																<div class="accordion-item rounded border-0 shadow mt-3">
																		<h2 class="accordion-header" id="headingseven">
																				<button class="accordion-button border-0 bg-white collapsed" type="button" data-bs-toggle="collapse"
																						data-bs-target="#collapseseven" aria-expanded="false" aria-controls="collapseseven">
																						What do I need to do to start selling ?
																				</button>
																		</h2>
																		<div id="collapseseven" class="accordion-collapse border-0 collapse" aria-labelledby="headingseven"
																				data-bs-parent="#generalquestion">
																				<div class="accordion-body text-muted bg-white">
																						There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.
																				</div>
																		</div>
																</div>
		
																<div class="accordion-item rounded border-0 shadow mt-3">
																		<h2 class="accordion-header" id="headingeight">
																				<button class="accordion-button border-0 bg-white collapsed" type="button" data-bs-toggle="collapse"
																						data-bs-target="#collapseeight" aria-expanded="false" aria-controls="collapseeight">
																						What happens when I receive an order ?
																				</button>
																		</h2>
																		<div id="collapseeight" class="accordion-collapse border-0 collapse" aria-labelledby="headingeight"
																				data-bs-parent="#generalquestion">
																				<div class="accordion-body text-muted bg-white">
																						There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.
																				</div>
																		</div>
																</div>
														</div>
												</div><!--end teb pane-->

												<div class="tab-pane fade" id="pills-payment" role="tabpanel" aria-labelledby="pills-payment-tab">
														<div class="section-title" id="payment">
																<h4>Payments Questions</h4>
														</div>
		
														<div class="accordion mt-4 pt-2" id="paymentquestion">
																<div class="accordion-item rounded border-0 shadow">
																		<h2 class="accordion-header" id="headingnine">
																				<button class="accordion-button border-0 bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapsenine"
																						aria-expanded="true" aria-controls="collapsenine">
																						How does it work ?
																				</button>
																		</h2>
																		<div id="collapsenine" class="accordion-collapse border-0 collapse show" aria-labelledby="headingnine"
																				data-bs-parent="#paymentquestion">
																				<div class="accordion-body text-muted bg-white">
																						There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.
																				</div>
																		</div>
																</div>
																
																<div class="accordion-item rounded border-0 shadow mt-3">
																		<h2 class="accordion-header" id="headingten">
																				<button class="accordion-button border-0 bg-white collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseten"
																						aria-expanded="false" aria-controls="collapseten">
																						Do I need a designer to use Starty ?
																				</button>
																		</h2>
																		<div id="collapseten" class="accordion-collapse border-0 collapse" aria-labelledby="headingten"
																				data-bs-parent="#paymentquestion">
																				<div class="accordion-body text-muted bg-white">
																						There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.
																				</div>
																		</div>
																</div>
		
																<div class="accordion-item rounded border-0 shadow mt-3">
																		<h2 class="accordion-header" id="headingeleven">
																				<button class="accordion-button border-0 bg-white collapsed" type="button" data-bs-toggle="collapse"
																						data-bs-target="#collapseeleven" aria-expanded="false" aria-controls="collapseeleven">
																						What do I need to do to start selling ?
																				</button>
																		</h2>
																		<div id="collapseeleven" class="accordion-collapse border-0 collapse" aria-labelledby="headingeleven"
																				data-bs-parent="#paymentquestion">
																				<div class="accordion-body text-muted bg-white">
																						There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.
																				</div>
																		</div>
																</div>
		
																<div class="accordion-item rounded border-0 shadow mt-3">
																		<h2 class="accordion-header" id="headingtwelve">
																				<button class="accordion-button border-0 bg-white collapsed" type="button" data-bs-toggle="collapse"
																						data-bs-target="#collapsetwelve" aria-expanded="false" aria-controls="collapsetwelve">
																						What happens when I receive an order ?
																				</button>
																		</h2>
																		<div id="collapsetwelve" class="accordion-collapse border-0 collapse" aria-labelledby="headingtwelve"
																				data-bs-parent="#paymentquestion">
																				<div class="accordion-body text-muted bg-white">
																						There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.
																				</div>
																		</div>
																</div>
														</div>
												</div><!--end teb pane-->

												<div class="tab-pane fade" id="pills-support" role="tabpanel" aria-labelledby="pills-support-tab">
														<div class="section-title" id="support">
																<h4>Support Questions</h4>
														</div>
		
														<div class="accordion mt-4 pt-2" id="supportquestion">
																<div class="accordion-item rounded border-0 shadow">
																		<h2 class="accordion-header" id="headingthirteen">
																				<button class="accordion-button border-0 bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapsethirteen"
																						aria-expanded="true" aria-controls="collapsethirteen">
																						How does it work ?
																				</button>
																		</h2>
																		<div id="collapsethirteen" class="accordion-collapse border-0 collapse show" aria-labelledby="headingthirteen"
																				data-bs-parent="#supportquestion">
																				<div class="accordion-body text-muted bg-white">
																						There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.
																				</div>
																		</div>
																</div>
																
																<div class="accordion-item rounded border-0 shadow mt-3">
																		<h2 class="accordion-header" id="headingfourteen">
																				<button class="accordion-button border-0 bg-white collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsefourteen"
																						aria-expanded="false" aria-controls="collapsefourteen">
																						Do I need a designer to use Starty ?
																				</button>
																		</h2>
																		<div id="collapsefourteen" class="accordion-collapse border-0 collapse" aria-labelledby="headingfourteen"
																				data-bs-parent="#supportquestion">
																				<div class="accordion-body text-muted bg-white">
																						There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.
																				</div>
																		</div>
																</div>
		
																<div class="accordion-item rounded border-0 shadow mt-3">
																		<h2 class="accordion-header" id="headingfifteen">
																				<button class="accordion-button border-0 bg-white collapsed" type="button" data-bs-toggle="collapse"
																						data-bs-target="#collapsefifteen" aria-expanded="false" aria-controls="collapsefifteen">
																						What do I need to do to start selling ?
																				</button>
																		</h2>
																		<div id="collapsefifteen" class="accordion-collapse border-0 collapse" aria-labelledby="headingfifteen"
																				data-bs-parent="#supportquestion">
																				<div class="accordion-body text-muted bg-white">
																						There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.
																				</div>
																		</div>
																</div>
		
																<div class="accordion-item rounded border-0 shadow mt-3">
																		<h2 class="accordion-header" id="headingsixteen">
																				<button class="accordion-button border-0 bg-white collapsed" type="button" data-bs-toggle="collapse"
																						data-bs-target="#collapsesixteen" aria-expanded="false" aria-controls="collapsesixteen">
																						What happens when I receive an order ?
																				</button>
																		</h2>
																		<div id="collapsesixteen" class="accordion-collapse border-0 collapse" aria-labelledby="headingsixteen"
																				data-bs-parent="#supportquestion">
																				<div class="accordion-body text-muted bg-white">
																						There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form.
																				</div>
																		</div>
																</div>
														</div>
												</div><!--end teb pane-->
										</div><!--end tab content-->
								</div><!--end col-->
						</div><!--end row-->
				</div><!--end container-->

				<div class="container mt-100 mt-60">
						<div class="row align-items-center">
								<div class="col-12">
										<div class="section-title text-center mb-4 pb-2">
												<h6 class="text-primary">Pricing Plan</h6>
												<h4 class="title fw-semibold mt-2 mb-3">Select a Plan <br> Now To Get More Profit</h4>
												<p class="text-muted para-desc mx-auto mb-0">Our design projects are fresh and simple and will benefit your business greatly. Learn more about our work!</p>
										</div>
								</div><!--end col-->
						</div><!--end row-->

						<div class="row">
								<div class="col-lg-4 col-md-6 mt-4 pt-2">
										<div class="card pricing text-center border-0 rounded py-5">
												<h4 class="mb-0">FREE</h4>

												<div class="my-5">
														<h1 class="display-2 fw-medium mb-0">$0</h1>
														<p class="text-muted mb-0">Per Year</p>
												</div>

												<ul class="list-unstyled mb-0">
														<li class="text-muted mt-3">Number of People 01 Person</li>
														<li class="text-muted mt-3">Unlimited Projects</li>
														<li class="text-muted mt-3">Club Access Unlimited Access</li>
														<li class="text-muted mt-3">Class Access Fitness Classes</li>
														<li class="text-muted mt-3">Enhanced Security</li>
												</ul>

												<div class="mt-5">
														<a href="javascript:void(0)" class="btn btn-lg btn-primary">Free</a>
												</div>
										</div>
								</div><!--end col-->

								<div class="col-lg-4 col-md-6 mt-4 pt-2">
										<div class="card pricing bg-primary bg-gradient text-center border-0 rounded py-5">
												<h4 class="mb-0 text-white title-dark">STARTER</h4>

												<div class="my-5">
														<h1 class="display-2 fw-medium text-white title-dark mb-0">$39</h1>
														<p class="text-white-50 mb-0">Per Year</p>
												</div>

												<ul class="list-unstyled mb-0">
														<li class="text-white-50 mt-3">Number of People 01 Person</li>
														<li class="text-white-50 mt-3">Unlimited Projects</li>
														<li class="text-white-50 mt-3">Club Access Unlimited Access</li>
														<li class="text-white-50 mt-3">Class Access Fitness Classes</li>
														<li class="text-white-50 mt-3">Enhanced Security</li>
												</ul>

												<div class="mt-5">
														<a href="javascript:void(0)" class="btn btn-lg btn-light">Start Now</a>
												</div>
										</div>
								</div><!--end col-->

								<div class="col-lg-4 col-md-6 mt-4 pt-2">
										<div class="card pricing text-center border-0 rounded py-5">
												<h4 class="mb-0">PROFESSIONAL</h4>

												<div class="my-5">
														<h1 class="display-2 fw-medium mb-0">$59</h1>
														<p class="text-muted mb-0">Per Year</p>
												</div>

												<ul class="list-unstyled mb-0">
														<li class="text-muted mt-3">Number of People 01 Person</li>
														<li class="text-muted mt-3">Unlimited Projects</li>
														<li class="text-muted mt-3">Club Access Unlimited Access</li>
														<li class="text-muted mt-3">Class Access Fitness Classes</li>
														<li class="text-muted mt-3">Enhanced Security</li>
												</ul>

												<div class="mt-5">
														<a href="javascript:void(0)" class="btn btn-lg btn-primary">Update Now</a>
												</div>
										</div>
								</div><!--end col-->
						</div><!--end row-->
				</div><!--end container-->


@endsection