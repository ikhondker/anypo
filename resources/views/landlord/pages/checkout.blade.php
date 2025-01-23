@extends('layouts.landlord.page')
@section('title', 'Checkout')

@section('content')

	<section class="py-6 bg-white">
		<div class="container">
			<div class="mb-5 text-center">
				<span class="text-uppercase text-primary text-sm fw-medium mb-1 d-block">3. CHECKOUT</span>
				<h2 class="h1">CHECKOUT</h2>
				<p class="text-muted fs-lg">One simple pricing model. All you need to start. No hidden costs.</p>
			</div>
			<div class="row align-items-center">
				<div class="col-lg-7 mx-auto">
						<div class="col-md-7 col-lg-8">
							<h4 class="mb-3">Service Detail</h4>
							<form action="{{ route('akk.process-signup') }}" method="POST" class="needs-validation">
								<input type="hidden" value="{{ csrf_token() }}" name="_token" />

								<div class="row g-3">
									<div class="col-12">
										<label for="site" class="form-label">Site Name* :</label>
										<div class="input-group has-validation">
											{{-- <input type="text" class="form-control form-control-sm" id="site" value="XYZ" placeholder="sitename"> --}}
											<input type="text" class="form-control form-control-sm" name="site"
												id="site" placeholder="sitename" value="{{ old('site', 'XYZ') }}"
												class="@error('site') is-invalid @enderror" required>
											<span class="input-group-text">.ANYPO.NET</span>
										</div>
										@error('site')
											<div class="small text-danger">{{ $message }}</div>
										@enderror
									</div>

									<div class="col-12">
										<label for="email" class="form-label">Business Email* :</label>
										@auth
											<input type="email" class="form-control form-control-sm" name="email"
												id="email" placeholder="you@example.com"
												value="{{ old('email', auth()->user()->email) }}"
												class="@error('email') is-invalid @enderror" readonly>
											@error('email')
												<div class="small text-danger">{{ $message }}</div>
											@enderror
											{{-- {{ auth()->user()->email }} --}}
										@endauth
										@guest
											<input type="email" class="form-control form-control-sm" name="email"
												id="email" placeholder="you@example.com"
												value="{{ old('email', 'you@example.com') }}"
												class="@error('email') is-invalid @enderror" required>
											@error('email')
												<div class="small text-danger">{{ $message }}</div>
											@enderror
										@endguest

									</div>

									<div class="col-sm-12">
										<label for="name" class="form-label">Your/Company Name* :</label>
										@auth
											<input type="text" class="form-control form-control-sm" name="account_name"
												id="account_name" placeholder="John Doe"
												value="{{ old('account_name', auth()->user()->name) }}"
												class="@error('account_name') is-invalid @enderror">
											@error('account_name')
												<div class="small text-danger">{{ $message }}</div>
											@enderror
										@endauth
										@guest
											<input type="text" class="form-control form-control-sm" name="account_name"
												id="account_name" placeholder="John Doe"
												value="{{ old('account_name', 'John Doe') }}"
												class="@error('account_name') is-invalid @enderror" required>
											@error('account_name')
												<div class="small text-danger">{{ $message }}</div>
											@enderror
										@endguest
									</div>
								</div>

								<hr class="my-4">
								<h4 class="mb-3">Need initial configuration service?</h4>
								<div class="form-check align-items-center">
									<input id="admin" type="checkbox" class="form-check-input" value="user-role" name="installation">
									<label class="form-check-label text-small" for="customControlInline"><b>Yes! Configure it for me</b></label>
									<span class="d-block small text-secondary">
										$35/Hr. Get it configured by the our team.
										Generally takes 2/3 hour for a SME.	We will communicate with you within 6 hrs, to configure your site, after you have purchased this service.
										<br>
										You will be billed later, separately, after your application is configured and in-use.
									</span>
								</div>


								<hr class="my-4">
								<h4 class="mb-3">Payment</h4>

								<span class="text-muted certificate-text"><i class="fa fa-lock"></i> Your transaction is
									secured with ssl certificate</span>
								<hr class="my-4">

								<button class="w-100 btn btn-primary btn-lg" type="submit"><i data-lucide="shopping-cart"></i> Continue to	Checkout</button>

							</form>
						</div>
				</div>
				<div class="col-lg-5 mx-auto">
					<!-- Card -->
					<div class="card card-sm shadow-sm mb-4">
						<div class="card-body">
							<div class="border-bottom pb-4 mb-4">
								<h3 class="card-header-title text-info">ORDER SUMMARY</h3>
								<span>1 item</span>
							</div>
							<form>

								<div class="border-bottom pb-4 mb-4">
									<div class="d-grid gap-3">
										<div class="row">
											<div class="col-sm-8">
												<p class="h4">{{ $product->sku }}</p>
												<span class="small">{{ $product->name }}</span><br>
												<span class="small">ALL FUNCTIONALITIES.<span>
											</div>
											<div class="col-sm-4 text-end h3">
												${{ number_format($product->price,2) }}
											</div>
										</div>
										<div class="row">
										</div>
										<div class="row">
										</div>

									</div>
								</div>
								<div class="d-grid gap-3 mb-4">
									<dl class="row">
										<dt class="col-sm-6">TOTAL</dt>
										<dd class="col-sm-6 text-sm-end mb-0 h3">${{ number_format($product->price,2) }}</dd>
									</dl>
									<!-- End Row -->
								</div>
								<div class="d-grid">
									{{-- <a class="btn btn-primary btn-lg" href="../demo-shop/checkout.html"><i data-lucide="shopping-cart"></i> Checkout</a> --}}
								</div>
							</form>
						</div>
						<!-- End Card -->
					</div>
					<div class="flex-grow-1 ms-2">
						<span class="small me-1">Need Help?</span>
						<a class="link small" href="#">Chat now</a>
					</div>
				</div>
			</div>
		</div>
	</section>

@endsection


