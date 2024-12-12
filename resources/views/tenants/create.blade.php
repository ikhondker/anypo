@extends('layouts.landlord.app')
@section('title','Tenant')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('tenants.index') }}" class="text-muted">Tenant</a></li>
	<li class="breadcrumb-item active">Create Tenant</li>
@endsection

@section('content')

	<h1 class="h3 mb-3">Create Tenant</h1>

	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<div class="card-actions float-end">
						<a class="btn btn-sm btn-light" href="{{ route('reports.pr', 11) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Print"><i data-lucide="printer"></i></a>
						<a class="btn btn-sm btn-light" href="{{ route('prs.edit', 11 ) }}"><i data-lucide="edit"></i> Edit</a>
					</div>
					<h5 class="card-title">Create Tenant</h5>
					<h6 class="card-subtitle text-muted">Create Tenant, bypassing payment</h6>
				</div>
				<div class="card-body">
					<form action="{{ route('tenants.store') }}" method="POST">
						@csrf

						<div class="row g-3">
							<div class="col-12">
								<label for="site" class="form-label">Site Name*</label>
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
								<label for="email" class="form-label">Business Email*</label>
								<input type="email" class="form-control form-control-sm" name="email"
									id="email" placeholder="you@example.com"
									value="{{ old('email', 'you@example.com') }}"
									class="@error('email') is-invalid @enderror" required>
								@error('email')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</div>

							<div class="col-sm-12">
								<label for="name" class="form-label">Your/Company Name*</label>
								<input type="text" class="form-control form-control-sm" name="account_name"
									id="account_name" placeholder="John Doe"
									value="{{ old('account_name', 'John Doe') }}"
									class="@error('account_name') is-invalid @enderror" required>
								@error('account_name')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</div>
						</div>
						<hr class="my-4">
						<button class="w-100 btn btn-primary btn-lg" onclick="return confirm('Do you really want to create this new Tenant? ')" type="submit"><i data-lucide="shopping-cart"></i> Create Tenant</button>
					</form>
				</div>
			</div>
		</div>
		<!-- end col-6 -->
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<div class="card-actions float-end">
						<a class="btn btn-sm btn-light" href="{{ route('reports.pr', 11) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Print"><i data-lucide="printer"></i></a>
						<a class="btn btn-sm btn-light" href="{{ route('prs.edit', 11 ) }}"><i data-lucide="edit"></i> Edit</a>
					</div>
				</div>
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
			</div>
		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->

@endsection

