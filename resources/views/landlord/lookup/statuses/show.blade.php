@extends('layouts.landlord-app')
@section('title','Statuses')
@section('breadcrumb','View Statuses')

@section('content')
	<!-- Card -->
	<div class="card">
		<div class="card-header border-bottom">
			<h4 class="card-header-title">Status info</h4>
		</div>

		<!-- Body -->
		<div class="card-body">
			
			<x-landlord.show.my-badge	value="{{ $status->code }}" label="Code"/>
			<x-landlord.show.my-text	value="{{ $status->name }}"/>
			<x-landlord.show.my-badge	value="{{ $status->badge }}" label="Badge"/>
		
			<x-landlord.show.my-enable	value="{{ $status->accounts }}" label="Accounts"/>
			<x-landlord.show.my-enable	value="{{ $status->accounts }}" label="Services"/>
			<x-landlord.show.my-enable	value="{{ $status->tickets }}" label="Tickets"/>
			<x-landlord.show.my-enable	value="{{ $status->checkouts }}" label="Checkouts"/>
			<x-landlord.show.my-enable	value="{{ $status->invoices }}" label="Invoices"/>
			<x-landlord.show.my-enable	value="{{ $status->payments }}" label="Payments"/>
			<x-landlord.show.my-enable	value="{{ $status->enable }}"/>

		</div>
		<!-- End Body -->

		<!-- Footer -->
		<div class="card-footer pt-0">
			<div class="d-flex justify-content-end gap-3">
			  <a class="btn btn-primary" href="{{ route('statuses.edit',$status->code) }}">Edit</a>
			</div>
		</div>
		<!-- End Footer -->
	</div>
	<!-- End Card -->
@endsection

