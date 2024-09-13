@extends('layouts.landlord.page')
@section('title','FAQ')
@section('content')



	<div class="container pt-4 content-space-3 content-space-lg-2">
		<div class="mb-5 text-center">
			<span class="text-uppercase text-primary text-sm fw-medium mb-1 d-block">FAQ</span>
			<h2 class="h1">Frequently asked questions (FAQ)</h2>
			{{-- <p>Search our FAQ for answers to anything you might ask.</p> --}}
			<p class="text-muted fs-lg">Here are some of the answers you might be looking for.</p>
			<p class="text-muted">For anything we haven't covered, please create a <a href="{{ route('tickets.create') }}" class="text-primary">support ticket</a>. We're here to help.</p>
		</div>

		<div class="row">
			<div class="col-md-4 col-lg-3 mb-3 mb-md-0">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0 text-primary">Contents</h5>
						</div>
						<div class="list-group list-group-flush" role="tablist">
							<a class="list-group-item list-group-item-action" href="#basics" role="tab">1. Basics</a>
							<a class="list-group-item list-group-item-action" href="#support" role="tab">2. Support</a>
							<a class="list-group-item list-group-item-action" href="#payments" role="tab">3. Payments</a>
						</div>
					</div>
			</div>
			<!-- End Col -->

			<div class="col-md-8 col-lg-9">
				<!-- Card -->
				<div class="card card-lg">
					<!-- Card Body -->
					<div class="card-body">
						<div id="basics" class="mb-5 text-center">
							<span class="text-uppercase text-primary fw-medium mb-1 d-block">Basics</span>
						</div>
						<div class="row">
							<div class="col-md-12 col-lg-12 mx-auto">
								<div class="accordion" id="accordionBasics">
										
									<div class="card border mb-3">
										<div class="card-header cursor-pointer" id="basicsOne" data-bs-toggle="collapse" data-bs-target="#collapseOne"
											aria-expanded="true" aria-controls="collapseOne">
											<h6 class="mb-0">
												What is a cloud-based SAAS service for purchasing and spend control?
											</h6>
										</div>
										<div id="collapseOne" class="collapse show" aria-labelledby="basicsOne" data-bs-parent="#accordionBasics">
											<div class="card-body py-3">
												A cloud-based SAAS service for purchasing and spend control is a software-as-a-service solution that enables businesses to streamline and manage their purchasing processes and control expenses through a cloud-based platform.
											</div>
										</div>
									</div>
									
									<div class="card border mb-3">
										<div class="card-header cursor-pointer" id="basicsTwo" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
											aria-expanded="true" aria-controls="collapseTwo">
											<h6 class="mb-0">
												How does a cloud-based SAAS service help in managing purchasing?
											</h6>
										</div>
										<div id="collapseTwo" class="collapse" aria-labelledby="basicsTwo" data-bs-parent="#accordionBasics">
											<div class="card-body py-3">
												This service automates the procurement process, from requisition to payment, by providing a centralized platform for requesting, approving, and tracking purchases.
											</div>
										</div>
									</div>
									
									<div class="card border mb-3">
										<div class="card-header cursor-pointer" id="basicsThree" data-bs-toggle="collapse" data-bs-target="#collapseThree"
											aria-expanded="true" aria-controls="collapseThree">
											<h6 class="mb-0">
													What are the benefits of using a cloud-based SAAS service for spend control?
											</h6>
										</div>
										<div id="collapseThree" class="collapse" aria-labelledby="basicsThree" data-bs-parent="#accordionBasics">
											<div class="card-body py-3">
												The benefits include better visibility into spending, improved compliance with purchasing policies, cost savings through supplier management, and enhanced decision-making based on data analytics.
											</div>
										</div>
									</div>
									
									
									<div class="card border mb-3">
										<div class="card-header cursor-pointer" id="basicsFour" data-bs-toggle="collapse" data-bs-target="#collapseFour"
											aria-expanded="true" aria-controls="collapseFour">
											<h6 class="mb-0">
												Can multiple users access the cloud-based SAAS service for purchasing and spend control?
											</h6>
										</div>
										<div id="collapseFour" class="collapse" aria-labelledby="basicsFour" data-bs-parent="#accordionBasics">
											<div class="card-body py-3">
												Yes, multiple users within an organization can access the platform with designated roles and permissions to collaborate on purchasing activities and monitor spending.
											</div>
										</div>
									</div>
									
									<div class="card border mb-3">
										<div class="card-header cursor-pointer" id="basicsFive" data-bs-toggle="collapse" data-bs-target="#collapseFive"
											aria-expanded="true" aria-controls="collapseFive">
											<h6 class="mb-0">
												How does pricing work for a cloud-based SAAS service for purchasing and spend control?
											</h6>
										</div>
										<div id="collapseFive" class="collapse" aria-labelledby="basicsFive" data-bs-parent="#accordionBasics">
											<div class="card-body py-3">
												Pricing models vary among providers and may be based on factors such as the number of users, features required, and transaction volume. We offer subscription-based pricing plans. One simple <a href="{{ route('pricing') }}">pricing model</a>. All you need to start. No hidden costs.
											</div>
										</div>
									</div>
									
				
									<div class="card border mb-3">
										<div class="card-header cursor-pointer" id="basicsSix" data-bs-toggle="collapse" data-bs-target="#collapseSix"
											aria-expanded="true" aria-controls="collapseSix">
											<h6 class="mb-0">
												What kind of customer support is available ?
											</h6>
										</div>
										<div id="collapseSix" class="collapse " aria-labelledby="basicsSix" data-bs-parent="#accordionBasics">
											<div class="card-body py-3">
												Customer support options typically include email, phone, and chat support, as well as online help resources and knowledge bases to assist users with any questions or issues they may encounter.
											</div>
										</div>
									</div>
									<div class="card border mb-3">
										<div class="card-header cursor-pointer" id="basicsSeven" data-bs-toggle="collapse" data-bs-target="#collapseSeven"
											aria-expanded="true" aria-controls="collapseSeven">
											<h6 class="mb-0">
												What are the benefits of using a cloud-based SAAS service for purchasing and spend control?
											</h6>
										</div>
										<div id="collapseSeven" class="collapse " aria-labelledby="basicsSeven" data-bs-parent="#accordionBasics">
											<div class="card-body py-3">
												Some of the key benefits include increased efficiency in the purchasing process, better control and visibility over spending, cost savings through improved negotiation and budgeting, and reduced risk of errors.
											</div>
										</div>
									</div>

									<div class="card border mb-3">
										<div class="card-header cursor-pointer" id="basicsEight" data-bs-toggle="collapse" data-bs-target="#collapseEight"
											aria-expanded="true" aria-controls="collapseEight">
											<h6 class="mb-0">
												Is this service suitable for businesses of all sizes?
											</h6>
										</div>
										<div id="collapseEight" class="collapse " aria-labelledby="basicsEight" data-bs-parent="#accordionBasics">
											<div class="card-body py-3">
												Yes, this service is suitable for businesses of Small and Medium Businesses and Startups. It can be customized to fit the specific needs and budget of each business.
											</div>
										</div>
									</div>
								
									<div class="card border mb-3">
										<div class="card-header cursor-pointer" id="basicsNine" data-bs-toggle="collapse" data-bs-target="#collapseNine"
											aria-expanded="true" aria-controls="collapseNine">
											<h6 class="mb-0">
												Is there a free trial or demo available for this service?
											</h6>
										</div>
										<div id="collapseNine" class="collapse " aria-labelledby="basicsNine" data-bs-parent="#accordionBasics">
											<div class="card-body py-3">
												Yes, we can provide you access to a demo instance. Please <a href="{{ route('contact-us') }}">Contact us</a>. Many providers of cloud-based SAAS services for purchasing and spend control offer free trials or demos for businesses to test out the software before committing to a subscription. This allows businesses to see the features and benefits firsthand and determine if it is the right solution for their needs.
											</div>
										</div>
									</div>
							
									<div class="card border mb-3">
										<div class="card-header cursor-pointer" id="basicsTen" data-bs-toggle="collapse" data-bs-target="#collapseTen"
											aria-expanded="true" aria-controls="collapseTen">
											<h6 class="mb-0">
												Is it easy to implement a cloud-based SAAS solution for purchasing and spend control?
											</h6>
										</div>
										<div id="collapseTen" class="collapse " aria-labelledby="basicsTen" data-bs-parent="#accordionBasics">
											<div class="card-body py-3">
												Yes, implementing a cloud-based SAAS solution is typically quick and easy. Since the software is hosted in the cloud, there is no need for complex installations or hardware upgrades. Businesses can simply sign up for the service, perfoom the very basic configuration as per their needs, and start using it right away to streamline their purchasing processes and improve spend control.
											</div>
										</div>
									</div>
								
								
									<div class="card border mb-3">
										<div class="card-header cursor-pointer" id="basicsEleven" data-bs-toggle="collapse"
											data-bs-target="#collapseEleven" aria-expanded="true" aria-controls="collapseEleven">
											<h6 class="mb-0">
												Can I use a cloud-based SAAS service in a casual setting?
											</h6>
										</div>
										<div id="collapseEleven" class="collapse " aria-labelledby="basicsEleven" data-bs-parent="#accordionBasics">
											<div class="card-body py-3">
												Absolutely! Cloud-based SAAS services are designed to be user-friendly and accessible from any device with an internet connection. Whether you're managing your personal finances or running a small business, a cloud-based SAAS service can help you track spending and analyze your expenses with ease.
											</div>
										</div>
									</div>
								
				
								</div>
							</div>
						</div>
				
						<div id="support" class="mb-5 mt-5 text-center">
							<span class="text-uppercase text-primary fw-medium mb-1 d-block">Support</span>
						</div>
						<div class="row">
							<div class="col-md-12 col-lg-12 mx-auto">
								<div class="accordion" id="accordionSupport">
									
									<div class="card border mb-3">
										<div class="card-header cursor-pointer" id="supportOne" data-bs-toggle="collapse" data-bs-target="#collapseOne"
											aria-expanded="true" aria-controls="collapseOne">
											<h6 class="mb-0">
												How do I get help with this SAAS Service?
											</h6>
										</div>
										<div id="collapseOne" class="collapse show" aria-labelledby="supportOne" data-bs-parent="#accordionSupport">
											<div class="card-body py-3">
												Technical support typically include email, phone, and chat support, as well as online knowledge bases to assist users with any questions or issues they may encounter.
											</div>
										</div>
									</div>
							
								
								
									<div class="card border mb-3">
										<div class="card-header cursor-pointer" id="supportTwo" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
											aria-expanded="true" aria-controls="collapseTwo">
											<h6 class="mb-0">
												Is this service secure?
											</h6>
										</div>
										<div id="collapseTwo" class="collapse " aria-labelledby="supportTwo" data-bs-parent="#accordionSupport">
											<div class="card-body py-3">
												Yes, this service is highly secure, with advanced encryption and security measures in place to protect sensitive business data and financial information.
											</div>
										</div>
									</div>
								
								
								
									<div class="card border mb-3">
										<div class="card-header cursor-pointer" id="supportThree" data-bs-toggle="collapse" data-bs-target="#collapseThree"
											aria-expanded="true" aria-controls="collapseThree">
											<h6 class="mb-0">
												What if I have a question that isn't answered here?
											</h6>
										</div>
										<div id="collapseThree" class="collapse " aria-labelledby="supportThree" data-bs-parent="#accordionSupport">
											<div class="card-body py-3">
												For anything we haven't covered, feel free to reach out <a href="{{ route('contact-us') }}">reach out</a> to the team or create a <a href="{{ route('tickets.create') }}">support ticket</a>. We're here to help.
											</div>
										</div>
									</div>
								
									<div class="card border mb-3">
										<div class="card-header cursor-pointer" id="supportFour" data-bs-toggle="collapse" data-bs-target="#collapseFour"
											aria-expanded="true" aria-controls="collapseFour">
											<h6 class="mb-0">
												How do I get access to the application?
											</h6>
										</div>
										<div id="collapseFour" class="collapse " aria-labelledby="supportFour" data-bs-parent="#accordionSupport">
											<div class="card-body py-3">
												Once you have purchased our servicer and your application is provisioned, we will e-mail you all details. The URL will be like https://yourcompany.anypo.net. just remember to use the same email you originally made your purchases with.
											</div>
										</div>
									</div>
								
								</div>
							</div>
						</div>
				
						<div id="payments" class="mb-5 mt-5 text-center">
							<span class="text-uppercase text-primary fw-medium mb-1 d-block">Payment</span>
						</div>
						<div class="row">
							<div class="col-md-12 col-lg-12 mx-auto">
								<div class="accordion" id="accordionPayment">
									<div class="card border mb-3">
										<div class="card-header cursor-pointer" id="paymentOne" data-bs-toggle="collapse" data-bs-target="#collapseOne"
											aria-expanded="true" aria-controls="collapseOne">
											<h6 class="mb-0">
												What methods of payments are supported?
											</h6>
										</div>
										<div id="collapseOne" class="collapse show" aria-labelledby="paymentOne" data-bs-parent="#accordionPayment">
											<div class="card-body py-3">
												You can purchase the service directly from https://anypo.net website via any major credit/debit card (via Stripe) or with your Paypal account. We don't support cryptocurrencies or invoicing at this time.
											</div>
										</div>
									</div>
								
								
									<div class="card border mb-3">
										<div class="card-header cursor-pointer" id="paymentTwo" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
											aria-expanded="true" aria-controls="collapseTwo">
											<h6 class="mb-0">
												How do I get a receipt for my purchase?
											</h6>
										</div>
										<div id="collapseTwo" class="collapse " aria-labelledby="paymentTwo" data-bs-parent="#accordionPayment">
											<div class="card-body py-3">
												You'll receive an email from ANYPO.NET once your purchase is complete. Also you will be able to download all payment receipt (in pdf format) for your record keeping purpose.
											</div>
										</div>
									</div>
								
								
									<div class="card border mb-3">
										<div class="card-header cursor-pointer" id="paymentThree" data-bs-toggle="collapse" data-bs-target="#collapseThree"
											aria-expanded="true" aria-controls="collapseThree">
											<h6 class="mb-0">
												Which license do I need?
											</h6>
										</div>
										<div id="collapseThree" class="collapse " aria-labelledby="paymentThree" data-bs-parent="#accordionPayment">
											<div class="card-body py-3">
												We have one simple plan and one license types and pricing model. 'Small and Medium Enterprise (5 User)'. All you need to start.
											</div>
										</div>
									</div>
								
								
									<div class="card border mb-3">
										<div class="card-header cursor-pointer" id="paymentFour" data-bs-toggle="collapse" data-bs-target="#collapseFour"
											aria-expanded="true" aria-controls="collapseFour">
											<h6 class="mb-0">
												How does this service handle compliance and regulatory requirements?
											</h6>
										</div>
										<div id="collapseFour" class="collapse " aria-labelledby="paymentFour" data-bs-parent="#accordionPayment">
											<div class="card-body py-3">
												This service typically includes features for managing compliance and regulatory requirements, such as tracking and reporting on spending in specific categories or with certain vendors. It may also have built-in compliance checks and approvals to ensure all purchases and spending are in line with company policies.
											</div>
										</div>
									</div>
								
								</div>
							</div>
						</div>

					</div>
					<!-- End Card Body -->
				</div>
				<!-- End Card -->
			</div>
			<!-- End Col -->
		</div>
		<!-- End row -->

	

	</div>




@endsection

