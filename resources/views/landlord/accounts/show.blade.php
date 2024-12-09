@extends('layouts.landlord.app')
@section('title','Account')

@section('breadcrumb')
	@if (auth()->user()->isSeeded())
		<li class="breadcrumb-item"><a href="{{ route('accounts.index') }}" class="text-muted">Accounts</a></li>
	@endif
	<li class="breadcrumb-item active">{{ $account->name }}</li>
@endsection

@section('content')

	<x-landlord.page-header>
		@slot('title')
			Billing Account Overview
		@endslot
		@slot('buttons')
				@if (auth()->user()->isSeeded())
					<x-landlord.actions.account-actions-support accountId="{{ $account->id }}"/>
				@else
					<x-landlord.actions.account-actions accountId="{{ $account->id }}"/>
				@endif
				<a href="{{ route('tickets.create') }}" class="btn btn-primary float-end me-1"><i data-lucide="plus"></i> New Ticket</a>
				@if (auth()->user()->isSupport())
					<a href="{{ route('accounts.index') }}" class="btn btn-primary float-end me-1"><i class="fas fa-list"></i> View all</a>
				@endif
		@endslot
	</x-landlord.page-header>

	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				<a href="{{ route('accounts.edit', $account->id) }}" class="btn btn-sm btn-light"><i data-lucide="edit"></i> Edit</a>
			</div>
			<h5 class="card-title">Account Overview</h5>
			<h6 class="card-subtitle text-muted">Detail Information of your account.</h6>
		</div>
		<div class="card-body">
			<div class="row g-0">
				<div class="col-sm-3 col-xl-12 col-xxl-3 text-center">
					<img src="{{ Storage::disk('s3l')->url('logo/'.$account->logo) }}" width="100" height="100" class="rounded-circle mt-2" alt="{{ $account->name }}" title="{{ $account->name }}">
				</div>
				<div class="col-sm-9 col-xl-12 col-xxl-9">
					{{-- <strong>{{ $account->primaryProduct->name }}</strong> --}}
					<div class="mb-1">
						<span class="card-subtitle">Account Name :
						<strong>{{ $account->name }}</strong></span>
					</div>
					<div class="mb-1">
						<span class="card-subtitle">Your plan :
						<strong>{{ $account->primaryProduct->name }}</strong></span>
					</div>
					<div class="mb-1">
						<span class="card-subtitle">Subscription :
						<strong class="text-info">${{number_format($account->price, 2)}} USD/mo</strong></span>
					</div>
					<div class="mb-1">
						<span class="card-subtitle">URL :
							<strong>
							<a href="https://{{ $account->site.'.'.config('app.domain') }}" target="_blank" class="text-info">{{ $account->site.'.'.config('app.domain') }}</a>
							</strong>
						</span>
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
									<th scope="row" style="width: 320px;">Licensed User :</th>
									<td><span class="badge badge-subtle-success">{{ $account->user }}</span></td>
								</tr>
								<tr>
									<th scope="row">Validity :</th>
									<td><x-landlord.list.my-date :value="$account->start_date" /> to <x-landlord.list.my-date :value="$account->end_date" /></td>
								</tr>
								<tr>
									<th scope="row">Last Billed :</th>
									<td><x-landlord.list.my-date :value="$account->last_bill_date" /></td>
								</tr>
								<tr>
									<th scope="row">Status :</th>
									<td><span class="badge badge badge-subtle-{{ $account->status->badge }}">{{ $account->status->name }}</span></td>
								</tr>

								<x-landlord.show.my-text value="{{ $account->email }}" label="E-mail" />
								<x-landlord.show.my-text value="{{ $account->cell }}" label="Cell" />

								<tr>
									<th scope="row">Created At :</th>
									<td>{{ strtoupper(date('d-M-Y H:i:s', strtotime($account->created_at ))) }}</td>
								</tr>
								@if (auth()->user()->isSystem())
                                    <tr>
                                        <th scope="row" class="text-danger" >Lifetime Discount % :</th>
                                        <td>{{ number_format($account->discount, 2) }}</td>
                                    </tr>
								@endif
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
                                @if (auth()->user()->isSystem())
                                    <tr>
                                        <th scope="row" class="text-danger" >Tenant id :</th>
                                        <td>{{ $account->tenant_id }}</td>
                                    </tr>
								@endif

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<x-landlord.widgets.account-services accountId="{{ $account->id }}"/>

@endsection
