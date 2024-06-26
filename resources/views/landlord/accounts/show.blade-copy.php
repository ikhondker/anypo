@extends('layouts.landlord.app')
@section('title','Account')
@section('breadcrumb','View Account')

@section('content')

	<h1 class="h3 mb-3">Account Overview</h1>
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="card-actions float-end">
						<a href="{{ route('accounts.edit', $account->id) }}" class="btn btn-sm btn-light"><i class="fas fa-edit"></i>  Edit Account</a>
					</div>
					<h5 class="card-title">Account Overview</h5>
					<h6 class="card-subtitle text-muted">View Account Details.</h6>
				</div>
				<div class="card-body">
					<div class="row g-0">
						<div class="col-sm-3 col-xl-12 col-xxl-3 text-center">
							<img src="{{ Storage::disk('s3l')->url('logo/'.$account->logo) }}" width="100" height="100" class="rounded-circle mt-2" alt="{{ $account->name }}" title="{{ $account->name }}">

						</div>
						<div class="col-sm-9 col-xl-12 col-xxl-9">
							{{-- <strong>{{ $account->primaryProduct->name }}</strong> --}}
							<div class="mb-1">
								<span class="card-subtitle">Your plan:
								<strong>{{ $account->primaryProduct->name }}</strong></span>
							</div>
                            <div class="mb-1">
								<span class="card-subtitle">Subscription:
								<strong class="text-primary">${{ $account->price }} USD/mo</strong></span>
							</div>
                            <div class="mb-1">
								<span class="card-subtitle">Account Name:
								<strong>{{ $account->name }}</strong></span>
							</div>
                            <div class="mb-1">
								<span class="card-subtitle">URL:
								<strong>{{ $account->site.'.'.env('APP_DOMAIN') }}</strong></span>
							</div>
						</div>
					</div>
					<div class="row pt-5">
						<div class="col-md-6">
							<div class="table-responsive">
								<table class="table table-sm mb-0">
									<tbody>
                                        <x-landlord.show.my-text value="{{ $account->name }}" label="Account Name" />
										<tr>
											<th scope="row" style="width: 320px;">Licensed User</th>
											<td><span class="badge badge-subtle-success">{{ $account->user }}</span></td>
										</tr>
										<tr>
											<th scope="row">Validity</th>
											<td><x-landlord.list.my-date :value="$account->start_date" /> to <x-landlord.list.my-date :value="$account->end_date" /></td>
										</tr>
										<tr>
											<th scope="row">Last Billed</th>
											<td><x-landlord.list.my-date :value="$account->last_bill_date" /></td>
										</tr>
										<tr>
											<th scope="row">Status</th>
											<td><span class="badge badge badge-subtle-{{ $account->status->badge }}">{{ $account->status->name }}</span></td>
										</tr>

                                        <x-landlord.show.my-text value="{{ $account->email }}" label="E-mail" />
                                            <x-landlord.show.my-text value="{{ $account->cell }}" label="Cell" />
                                        <tr>
											<th scope="row">Created At</th>
											<td>{{ $account->created_at }}</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="col-md-6">
							<div class="table-responsive">
								<table class="table table-sm mb-0">
									<tbody>
                                        <x-landlord.show.my-text value="{{ $account->tagline }}" label="Tagline" />

                                            <x-landlord.show.my-text value="{{ $account->address1 }}" label="Address1" />
                                            <x-landlord.show.my-text value="{{ $account->address2 }}" label="Address2" />
                                            <x-landlord.show.my-text value="{{ $account->city.', '.$account->state.', '.$account->zip }}" label="City-State-Zip" />
                                            <x-landlord.show.my-text value="{{ $account->relCountry->name }}" label="Country" />
                                            <x-landlord.show.my-url value="{{ $account->website }}" label="Website" />
                                            <x-landlord.show.my-url value="{{ $account->facebook }}" label="Facebook" />
                                            <x-landlord.show.my-url value="{{ $account->linkedin }}" label="LinkedIn" />
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>



<div class="col-lg-12">
	<div class="d-grid gap-3 gap-lg-5">
		<!-- Card -->
		<div class="card">
			<!-- Header -->
			<div class="card-header d-flex justify-content-between align-items-center border-bottom">
				<h5 class="card-header-title">Account Overview</h5>
				<a class="btn btn-primary btn-sm" href="{{ route('accounts.edit', $account->id) }}">
					<i class="bi bi-pencil-square me-1"></i> Edit Account
				</a>
			</div>
			<!-- End Header -->

			<!-- Body -->
			<div class="card-body">
				<div class="row">
					<div class="col-md mb-4 mb-md-0">
						<div class="mb-4">
							<span class="card-subtitle">Your plan:</span>
							<h5>{{ $account->primaryProduct->name }}</h5>
						</div>
						<div class="mb-4">
							<span class="card-subtitle">Account Name:</span>
							<h5>{{ $account->name }}</h5>
						</div>

						<div>
							<span class="card-subtitle">Total per month</span>
							<h3 class="text-primary">${{ $account->price }} USD</h3>
						</div>
					</div>
					<!-- End Col -->

					<div class="col-md-auto">
						<div class="d-grid d-md-flex gap-3">
							<span class="avatar avatar-xxl avatar-circle">
								<img id="avatarImg" class="avatar-img" src="{{ Storage::disk('s3l')->url('logo/'.$account->logo) }}" alt="{{ $account->name }}" title="{{ $account->name }}">
							</span>
						</div>
						{{ $account->site.'.'.env('APP_DOMAIN') }}
					</div>
					<!-- End Col -->
				</div>
				<!-- End Row -->
			</div>
			<!-- End Body -->

			<hr class="my-3">

			<!-- Body -->
			<div class="card-body">
				<div class="row align-items-center flex-grow-1 mb-2">
					<div class="col">
						<h4 class="card-header-title">Licensed User</h4>
					</div>
					<!-- End Col -->

					<div class="col-auto">
						<span class="text-dark fw-semibold"><span class="badge bg-info rounded-pill">{{ $account->user }}</span></span>
					</div>
					<!-- End Col -->
				</div>
				<!-- End Row -->

				<!-- Progress -->
				<div class="progress rounded-pill mb-3">
					<div class="progress-bar" role="progressbar" style="width: 100%;" aria-valuenow="33" aria-valuemin="0" aria-valuemax="100"></div>
					{{-- <div class="progress-bar" role="progressbar" style="width: 25%; opacity: .6" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div> --}}
				</div>
				<!-- End Progress -->

				<!-- Legend Indicators -->
				<div class="list-inline">
					<div class="list-inline-item">
						<span class="legend-indicator bg-primary"></span>Validity : <x-landlord.list.my-date :value="$account->start_date" /> to <x-landlord.list.my-date :value="$account->end_date" />
					</div>
					<div class="list-inline-item">
						<span class="legend-indicator bg-primary"></span>Last Billed: <x-landlord.list.my-date :value="$account->last_bill_date" />
					</div>
					<div class="list-inline-item">
						<span class="legend-indicator bg-primary"></span>Status:
						<span class="badge bg-{{ $account->status->badge }}">{{ $account->status->name }}</span>
					</div>
				</div>
				<!-- End Legend Indicators -->
			</div>
			<!-- End Body -->
		</div>
		<!-- End Card -->


		<x-landlord.widgets.account-services/>



		<!-- Card -->
		<div class="card">

			<div class="card-header d-sm-flex justify-content-sm-between align-items-sm-center border-bottom">
				<h5 class="card-header-title">Account Detail</h5>
				<a class="btn btn-primary btn-sm" href="{{ route('accounts.edit', $account->id) }}">
					<i class="bi bi-pencil-square me-1"></i> Edit Account
				</a>
			</div>

			<!-- Body -->
			<div class="card-body">
				<x-landlord.show.my-text value="{{ $account->name }}" label="Account Name" />

                <x-landlord.show.my-text value="{{ $account->email }}" label="E-mail" />

                <x-landlord.show.my-text value="{{ $account->tagline }}" label="Tagline" />
                <x-landlord.show.my-text value="{{ $account->cell }}" label="Cell" />
				<x-landlord.show.my-text value="{{ $account->address1 }}" label="Address1" />
				<x-landlord.show.my-text value="{{ $account->address2 }}" label="Address2" />
				<x-landlord.show.my-text value="{{ $account->city.', '.$account->state.', '.$account->zip }}" label="City-State-Zip" />
				<x-landlord.show.my-text value="{{ $account->relCountry->name }}" label="Country" />
				<x-landlord.show.my-url value="{{ $account->website }}" label="Website" />
				<x-landlord.show.my-url value="{{ $account->facebook }}" label="Facebook" />
				<x-landlord.show.my-url value="{{ $account->linkedin }}" label="LinkedIn" />

				<x-landlord.show.my-date-time value="{{ $account->created_at }}" label="Created At" />


			</div>
			<!-- End Body -->

			<!-- Footer -->
			<div class="card-footer pt-0">
				<div class="d-flex justify-content-end gap-3">
					@if ( auth()->user()->role->value == UserRoleEnum::SYSTEM->value)
						<a href="{{ route('accounts.delete', $account->id) }}"
							class="btn btn-danger btn-sm sw2-advance" data-entity="Account"
							data-name="{{ $account->name }}"
							data-status="DELETE" data-bs-toggle="tooltip"
							data-bs-placement="top" title="DELETE">
							** DELETE ACCOUNT **
						</a>
					@endif

					<a class="btn btn-primary btn-sm" href="{{ route('accounts.edit', $account->id) }}">
						<i class="bi bi-pencil-square me-1"></i> Edit Account
					</a>

				</div>
			</div>
			<!-- End Footer -->
		</div>
		<!-- End Card -->
	</div>
</div>
<!-- End Col -->







@endsection
