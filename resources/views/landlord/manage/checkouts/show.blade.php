@extends('layouts.landlord.app')
@section('title','Checkouts')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('checkouts.index') }}" class="text-muted">Checkouts</a></li>
	<li class="breadcrumb-item active">{{ $checkout->account_name }}</li>
@endsection


@section('content')

	<a href="{{ route('checkouts.index') }}" class="btn btn-primary float-end mt-n1"><i data-lucide="database"></i> View all</a>
	<h1 class="h3 mb-3">View Checkout</h1>

	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				{{-- <a href="{{ route('checkouts.index') }}" class="btn btn-sm btn-light"><i data-lucide="database"></i>View all</a> --}}
				@if (auth()->user()->isSystem())
				<a class="btn btn-sm btn-danger text-white" href="{{ route('checkouts.edit', $checkout->id) }}"><i data-lucide="edit"></i> Edit(*)</a>

				@endif
			</div>
			<h5 class="card-title">View Checkout</h5>
			<h6 class="card-subtitle text-muted">View Checkout Detail.</h6>
		</div>
		<div class="card-body">
			<table class="table table-sm my-2">
				<tbody>
					<x-landlord.show.my-badge value="{{ $checkout->id }}" label="ID" />
					<x-landlord.show.my-date-time value="{{ $checkout->checkout_date }}" />
					<x-landlord.show.my-text value="{{ $checkout->site }}" label="Site" />
					<x-landlord.show.my-text value="{{ $checkout->account_name }}" label="Name" />
					<x-landlord.show.my-text value="{{ $checkout->email }}" label="Email" />

					<x-landlord.show.my-text value="{{ $checkout->account_id }}" label="Account #" />
					<x-landlord.show.my-text value="{{ $checkout->account_name }}" label="Account Name" />
					<x-landlord.show.my-text value="{{ $checkout->invoice_id }}" label="Invoice #" />
					<x-landlord.show.my-date value="{{ $checkout->start_date }}" abel="Start"/>
					<x-landlord.show.my-date value="{{ $checkout->end_date }}" abel="End"/>

					<x-landlord.show.my-enable value="{{ $checkout->existing_user }}" label="Existing user?" />
					<x-landlord.show.my-text value="{{ $checkout->owner_id }}" label="Owner #" />
					<x-landlord.show.my-text value="{{ $checkout->session_id }}" label="Session ID" />

					<x-landlord.show.my-text value="{{ $checkout->product->sku }}" label="Product SKU" />
					<x-landlord.show.my-number value="{{ $checkout->price }}" label="Price" />
					<x-landlord.show.my-number value="{{ $checkout->mnth }}" label="Mnth" />
					<x-landlord.show.my-badge value="{{ $checkout->status->name }}" badge="{{ $checkout->status->badge }}" label="Status" />
				</tbody>
			</table>
		</div>
	</div>



@endsection
