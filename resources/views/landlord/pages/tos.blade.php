@extends('layouts.landlord.page')
@section('title','Terms of Use')

@section('content')


	<!-- Content -->
	<div class="container pt-4 content-space-3 content-space-lg-2">
		<div class="row">
			<div class="col-md-4 col-lg-3 mb-3 mb-md-0">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0 text-primary">Contents</h5>
						</div>
						<div class="list-group list-group-flush" role="tablist">
							<a class="list-group-item list-group-item-action" href="#content" role="tab">1. Accounts</a>
							<a class="list-group-item list-group-item-action" href="#linksToOtherWebsInfo" role="tab">2. Links to other websites</a>
							<a class="list-group-item list-group-item-action" href="#terminationInfo" role="tab">3. Termination</a>
							<a class="list-group-item list-group-item-action" href="#goveringLawInfo">4. Governing law</a>
							<a class="list-group-item list-group-item-action" href="#changesInfo" role="tab">5. Changes</a>
						</div>
					</div>
			</div>
			<!-- End Col -->

			<div class="col-md-8 col-lg-9">
				<!-- Card -->
				<div class="card card-lg">
					<!-- Header -->
					<div class="card-header bg-dark p-4 py-sm-10">
						<h1 class="card-title h2 text-white">Terms of Use</h1>
						<p class="card-text text-white">Effective date: 1 December 2024</p>
					</div>
					<!-- End Header -->

					<!-- Card Body -->
					<div class="card-body">
						<div class="mb-4">
							<p>Thanks for using our products and services ("Services"). The Services are provided by Pixeel Ltd. ("Space"), located at 153 Williamson Plaza, Maggieberg, MT 09514, England, United Kingdom.</p>
							<p>By using our Services, you are agreeing to these terms. Please read them carefully.</p>
							<p>Our Services are very diverse, so sometimes additional terms or product requirements (including age requirements) may apply. Additional terms will be available with the relevant Services, and those additional terms become part of your agreement with us if you use those Services.</p>
						</div>
		
						<div id="accountInfo" class="mb-4">
							<h4>1. Accounts</h4>
							<p>When you create an account with us, you must provide us information that is accurate, complete, and current at all times. Failure to do so constitutes a breach of the Terms, which may result in immediate termination of your account on our Service.</p>
							<p>You are responsible for safeguarding the password that you use to access the Service and for any activities or actions under your password, whether your password is with our Service or a third-party service.</p>
							<p>You agree not to disclose your password to any third party. You must notify us immediately upon becoming aware of any breach of security or unauthorized use of your account.</p>
						</div>
		
						<div id="linksToOtherWebsInfo" class="mb-4">
							<h4>2. Links to other websites</h4>
							<p>Our Service may contain links to third-party web sites or services that are not owned or controlled by Space.</p>
							<p>Space has no control over, and assumes no responsibility for, the content, privacy policies, or practices of any third party web sites or services. You further acknowledge and agree that Space shall not be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with use of or reliance on any such content, goods or services available on or through any such web sites or services.</p>
							<p>We strongly advise you to read the terms and conditions and privacy policies of any third-party web sites or services that you visit.</p>
						</div>
		
						<div id="terminationInfo" class="mb-4">
							<h4>3. Termination</h4>
							<p>We may terminate or suspend access to our Service immediately, without prior notice or liability, for any reason whatsoever, including without limitation if you breach the Terms.</p>
							<p>All provisions of the Terms which by their nature should survive termination shall survive termination, including, without limitation, ownership provisions, warranty disclaimers, indemnity and limitations of liability.</p>
							<p>We may terminate or suspend your account immediately, without prior notice or liability, for any reason whatsoever, including without limitation if you breach the Terms.</p>
							<p>Upon termination, your right to use the Service will immediately cease. If you wish to terminate your account, you may simply discontinue using the Service.</p>
							<p>All provisions of the Terms which by their nature should survive termination shall survive termination, including, without limitation, ownership provisions, warranty disclaimers, indemnity and limitations of liability.</p>
						</div>
		
						<div id="goveringLawInfo" class="mb-4">
							<h4>4. Governing law</h4>
							<p>These Terms shall be governed and construed in accordance with the laws of Jersey, without regard to its conflict of law provisions.</p>
							<p>Our failure to enforce any right or provision of these Terms will not be considered a waiver of those rights. If any provision of these Terms is held to be invalid or unenforceable by a court, the remaining provisions of these Terms will remain in effect. These Terms constitute the entire agreement between us regarding our Service, and supersede and replace any prior agreements we might have between us regarding the Service.</p>
						</div>
		
						<div id="changesInfo" class="mb-4">
							<h4>5. Changes</h4>
							<p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material we will try to provide at least 30 days notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.</p>
							<p>By continuing to access or use our Service after those revisions become effective, you agree to be bound by the revised terms. If you do not agree to the new terms, please stop using the Service.</p>
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
	<!-- End Content -->


@endsection