@extends('layouts.landlord.page')
@section('title','FAQ')
@section('content')

<!-- Hero -->
<div class="bg-img-start" style="background-image: url({{asset('/assets/bg/card-11.svg')}});">
	<div class="container content-space-t-3 content-space-t-lg-5 content-space-b-2">
		<div class="w-md-75 w-lg-50 text-center mx-md-auto">
			<h1>FAQ</h1>
			<p>Search our FAQ for answers to anything you might ask.</p>

			<p class="small">For anything we haven't covered, please create a <a href="{{ route('tickets.create') }}">support ticket</a>. We're here to help.</p>


		</div>
	</div>
</div>
<!-- End Hero -->

<!-- FAQ -->
<div class="container content-space-2 content-space-b-lg-3">
		<div class="w-lg-75 mx-lg-auto">
			<div class="d-grid gap-10">
				<div class="d-grid gap-3">
					<h2>Basics</h2>

					<!-- Accordion -->
					<div class="accordion accordion-flush accordion-lg" id="accordionFAQBasics">
						<!-- Accordion Item -->
						<div class="accordion-item">
							<div class="accordion-header" id="headingBasicsOne">
								<a class="accordion-button" role="button" data-bs-toggle="collapse" data-bs-target="#collapseBasicsOne" aria-expanded="true" aria-controls="collapseBasicsOne">
									What is a cloud-based SAAS service for purchasing and spend control?
								</a>
							</div>
							<div id="collapseBasicsOne" class="accordion-collapse collapse show" aria-labelledby="headingBasicsOne" data-bs-parent="#accordionFAQBasics">
								<div class="accordion-body">
									A cloud-based SAAS service for purchasing and spend control is a software-as-a-service solution that enables businesses to streamline and manage their purchasing processes and control expenses through a cloud-based platform.
								</div>
							</div>
						</div>
						<!-- End Accordion Item -->

						<!-- Accordion Item -->
						<div class="accordion-item">
							<div class="accordion-header" id="headingBasicsTwo">
								<a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapseBasicsTwo" aria-expanded="false" aria-controls="collapseBasicsTwo">
									How does a cloud-based SAAS service help in managing purchasing?
								</a>
							</div>
							<div id="collapseBasicsTwo" class="accordion-collapse collapse" aria-labelledby="headingBasicsTwo" data-bs-parent="#accordionFAQBasics">
								<div class="accordion-body">
									This service automates the procurement process, from requisition to payment, by providing a centralized platform for requesting, approving, and tracking purchases.
								</div>
							</div>
						</div>
						<!-- End Accordion Item -->

						<!-- Accordion Item -->
						<div class="accordion-item">
							<div class="accordion-header" id="headingBasicsThree">
								<a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapseBasicsThree" aria-expanded="false" aria-controls="collapseBasicsThree">
									What are the benefits of using a cloud-based SAAS service for spend control?
								</a>
							</div>
							<div id="collapseBasicsThree" class="accordion-collapse collapse" aria-labelledby="headingBasicsThree" data-bs-parent="#accordionFAQBasics">
								<div class="accordion-body">
									The benefits include better visibility into spending, improved compliance with purchasing policies, cost savings through supplier management, and enhanced decision-making based on data analytics.
								</div>
							</div>
						</div>
						<!-- End Accordion Item -->

						<!-- Accordion Item -->
						<div class="accordion-item">
							<div class="accordion-header" id="headingBasicsFour">
								<a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapseBasicsFour" aria-expanded="false" aria-controls="collapseBasicsFour">
									Can multiple users access the cloud-based SAAS service for purchasing and spend control?
								</a>
							</div>
							<div id="collapseBasicsFour" class="accordion-collapse collapse" aria-labelledby="headingBasicsFour" data-bs-parent="#accordionFAQBasics">
								<div class="accordion-body">
									Yes, multiple users within an organization can access the platform with designated roles and permissions to collaborate on purchasing activities and monitor spending.
								</div>
							</div>
						</div>
						<!-- End Accordion Item -->

						<!-- Accordion Item -->
						<div class="accordion-item">
							<div class="accordion-header" id="headingBasicsFive">
								<a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapseBasicsFive" aria-expanded="false" aria-controls="collapseBasicsFive">
									How does pricing work for a cloud-based SAAS service for purchasing and spend control?
								</a>
							</div>
							<div id="collapseBasicsFive" class="accordion-collapse collapse" aria-labelledby="headingBasicsFive" data-bs-parent="#accordionFAQBasics">
								<div class="accordion-body">
									Pricing models vary among providers and may be based on factors such as the number of users, features required, and transaction volume. We offer subscription-based pricing plans. One simple <a href="{{ route('pricing') }}">pricing model</a>. All you need to start. No hidden costs.

								</div>
							</div>
						</div>
						<!-- End Accordion Item -->

						<!-- Accordion Item -->
						<div class="accordion-item">
							<div class="accordion-header" id="headingBasicsSix">
								<a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapseBasicsSix" aria-expanded="false" aria-controls="collapseBasicsSix">
									What kind of customer support is available ?
								</a>
							</div>
							<div id="collapseBasicsSix" class="accordion-collapse collapse" aria-labelledby="headingBasicsSix" data-bs-parent="#accordionFAQBasics">
								<div class="accordion-body">
									Customer support options typically include email, phone, and chat support, as well as online help resources and knowledge bases to assist users with any questions or issues they may encounter.
								</div>
							</div>
						</div>
						<!-- End Accordion Item -->
						<!-- Accordion Item -->
						<div class="accordion-item">
							<div class="accordion-header" id="headingBasicsSeven">
								<a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapseBasicsSeven" aria-expanded="false" aria-controls="collapseBasicsSeven">
									What are the benefits of using a cloud-based SAAS service for purchasing and spend control?
								</a>
							</div>
							<div id="collapseBasicsSeven" class="accordion-collapse collapse" aria-labelledby="headingBasicsSeven" data-bs-parent="#accordionFAQBasics">
								<div class="accordion-body">
									Some of the key benefits include increased efficiency in the purchasing process, better control and visibility over spending, cost savings through improved negotiation and budgeting, and reduced risk of errors.
								</div>
							</div>
						</div>
						<!-- End Accordion Item -->
						<!-- Accordion Item -->
						<div class="accordion-item">
							<div class="accordion-header" id="headingBasicsEight">
								<a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapseBasicsEight" aria-expanded="false" aria-controls="collapseBasicsEight">
									Is this service suitable for businesses of all sizes?
								</a>
							</div>
							<div id="collapseBasicsEight" class="accordion-collapse collapse" aria-labelledby="headingBasicsEight" data-bs-parent="#accordionFAQBasics">
								<div class="accordion-body">
									Yes, this service is suitable for businesses of Small and Medium Businesses and Startups. It can be customized to fit the specific needs and budget of each business.
								</div>
							</div>
						</div>
						<!-- End Accordion Item -->
						<!-- Accordion Item -->
						<div class="accordion-item">
							<div class="accordion-header" id="headingBasicsNine">
								<a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapseBasicsNine" aria-expanded="false" aria-controls="collapseBasicsNine">
									Is there a free trial or demo available for this service?
								</a>
							</div>
							<div id="collapseBasicsNine" class="accordion-collapse collapse" aria-labelledby="headingBasicsNine" data-bs-parent="#accordionFAQBasics">
								<div class="accordion-body">
									Yes, we can provide you access to a demo instance. Please <a href="{{ route('contact-us') }}">Contact us</a>. Many providers of cloud-based SAAS services for purchasing and spend control offer free trials or demos for businesses to test out the software before committing to a subscription. This allows businesses to see the features and benefits firsthand and determine if it is the right solution for their needs.
								</div>
							</div>
						</div>
						<!-- End Accordion Item -->
						<!-- Accordion Item -->
						<div class="accordion-item">
							<div class="accordion-header" id="headingBasicsTen">
								<a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapseBasicsTen" aria-expanded="false" aria-controls="collapseBasicsTen">
									Is it easy to implement a cloud-based SAAS solution for purchasing and spend control?
								</a>
							</div>
							<div id="collapseBasicsTen" class="accordion-collapse collapse" aria-labelledby="headingBasicsTen" data-bs-parent="#accordionFAQBasics">
								<div class="accordion-body">
									Yes, implementing a cloud-based SAAS solution is typically quick and easy. Since the software is hosted in the cloud, there is no need for complex installations or hardware upgrades. Businesses can simply sign up for the service, perfoom the very basic configuration as per their needs, and start using it right away to streamline their purchasing processes and improve spend control.
								</div>
							</div>
						</div>
						<!-- End Accordion Item -->
						<!-- Accordion Item -->
						<div class="accordion-item">
							<div class="accordion-header" id="headingBasics11">
								<a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapseBasics11" aria-expanded="false" aria-controls="collapseBasics11">
									Can I use a cloud-based SAAS service in a casual setting?
								</a>
							</div>
							<div id="collapseBasics11" class="accordion-collapse collapse" aria-labelledby="headingBasics11" data-bs-parent="#accordionFAQBasics">
								<div class="accordion-body">
									Absolutely! Cloud-based SAAS services are designed to be user-friendly and accessible from any device with an internet connection. Whether you're managing your personal finances or running a small business, a cloud-based SAAS service can help you track spending and analyze your expenses with ease.
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
									How do I get help with this SAAS Service?
								</a>
							</div>
							<div id="collapseSupportOne" class="accordion-collapse collapse" aria-labelledby="headingSupportOne" data-bs-parent="#accordionFAQSupport">
								<div class="accordion-body">
									Technical support typically include email, phone, and chat support, as well as online knowledge bases to assist users with any questions or issues they may encounter.

								</div>
							</div>
						</div>
						<!-- End Accordion Item -->

						<!-- Accordion Item -->
						<div class="accordion-item">
							<div class="accordion-header" id="headingSupportTwo">
								<a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapseSupportTwo" aria-expanded="false" aria-controls="collapseSupportTwo">
									Is this service secure?
								</a>
							</div>
							<div id="collapseSupportTwo" class="accordion-collapse collapse" aria-labelledby="headingSupportTwo" data-bs-parent="#accordionFAQSupport">
								<div class="accordion-body">
									Yes, this service is highly secure, with advanced encryption and security measures in place to protect sensitive business data and financial information.
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
									For anything we haven't covered, feel free to reach out <a href="{{ route('contact-us') }}">reach out</a> to the team or create a <a href="{{ route('tickets.create') }}">support ticket</a>. We're here to help.
								</div>
							</div>
						</div>
						<!-- End Accordion Item -->

						<!-- Accordion Item -->
						<div class="accordion-item">
							<div class="accordion-header" id="headingSupportFour">
								<a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapseSupportFour" aria-expanded="false" aria-controls="collapseSupportFour">
									How do I get access to the application?
								</a>
							</div>
							<div id="collapseSupportFour" class="accordion-collapse collapse" aria-labelledby="headingSupportFour" data-bs-parent="#accordionFAQSupport">
								<div class="accordion-body">
									Once you have purchased our servicer and your application is provisioned, we will e-mail you all details. The URL will be like https://yourcompany.anypo.net. just remember to use the same email you originally made your purchases with.
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
									You can purchase the service directly from https://anypo.net website via any major credit/debit card (via Stripe) or with your Paypal account. We don't support cryptocurrencies or invoicing at this time.
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
									You'll receive an email from ANYPO.NET once your purchase is complete. Also you will be able to download all payment receipt (in pdf format) for your record keeping purpose.
								</div>
							</div>
						</div>
						<!-- End Accordion Item -->

						<!-- Accordion Item -->
						<div class="accordion-item">
							<div class="accordion-header" id="headingPaymentsThree">
								<a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapsePaymentsThree" aria-expanded="false" aria-controls="collapsePaymentsThree">
									Which license do I need?
								</a>
							</div>
							<div id="collapsePaymentsThree" class="accordion-collapse collapse" aria-labelledby="headingPaymentsThree" data-bs-parent="#accordionFAQPayments">
								<div class="accordion-body">
									We have one simple plan and one license types and pricing model. 'Small and Medium Enterprise (5 User)'. All you need to start.
								</div>
							</div>
						</div>
						<!-- End Accordion Item -->

						<!-- Accordion Item -->
						<div class="accordion-item">
							<div class="accordion-header" id="headingPaymentsFour">
								<a class="accordion-button collapsed" role="button" data-bs-toggle="collapse" data-bs-target="#collapsePaymentsFour" aria-expanded="false" aria-controls="collapsePaymentsFour">
									How does this service handle compliance and regulatory requirements?
								</a>
							</div>
							<div id="collapsePaymentsFour" class="accordion-collapse collapse" aria-labelledby="headingPaymentsFour" data-bs-parent="#accordionFAQPayments">
								<div class="accordion-body">
									This service typically includes features for managing compliance and regulatory requirements, such as tracking and reporting on spending in specific categories or with certain vendors. It may also have built-in compliance checks and approvals to ensure all purchases and spending are in line with company policies.
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

