@extends('layouts.landlord-app')
@section('title','Checkouts')
@section('breadcrumb','View Checkout')

@section('content')


<!-- Card -->
<div class="card">
	<div class="card-header border-bottom">
		<h4 class="card-header-title">Checkout info</h4>
	</div>

	<!-- Body -->
	<div class="card-body">

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

		<x-landlord.show.my-enable value="{{ $checkout->existing_user }}" label="existing_user" />
		<x-landlord.show.my-text value="{{ $checkout->owner_id }}" label="Owner #" />
		<x-landlord.show.my-text value="{{ $checkout->session_id }}" label="Session ID" />

		<x-landlord.show.my-text value="{{ $checkout->product->sku }}" label="Product SKU" />
		<x-landlord.show.my-number value="{{ $checkout->price }}" label="Price" />
		<x-landlord.show.my-number value="{{ $checkout->mnth }}" label="Mnth" />
		<x-landlord.show.my-badge value="{{ $checkout->status->name }}" badge="{{ $checkout->status->badge }}" label="Status" />

	</div>
	<!-- End Body -->


	<!-- Footer -->
	<div class="card-footer pt-0">
		<div class="d-flex justify-content-end gap-3">
			<a class="btn btn-primary" href="{{ route('checkouts.edit',$checkout->id) }}">Edit</a>
		</div>
	</div>
	<!-- End Footer -->
</div>
<!-- End Card -->

@endsection