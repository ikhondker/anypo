@extends('layouts.landlord-app')
@section('title','View Invoice')
@section('breadcrumb','View Invoice')

@section('content')
	<!-- Card -->
	<div class="card">

		<div class="card-header border-bottom">
			<h4 class="card-header-title">View Invoice</h4>
		</div>


		<!-- Body -->
		<div class="card-body">
				<x-landlord.show.my-text 	value="{{ $invoice->invoice_no }}" label="Invoice No"/>
				<x-landlord.show.my-date 	value="{{ $invoice->invoice_date }}" label="Invoice Date"/>
				<x-landlord.show.my-badge	value="{{ $invoice->status->name }}" badge="{{ $invoice->status->badge }}" label="Status"/>

				<x-landlord.show.my-text	value="{{ $invoice->summary }}" label="Particulars"/>
				<x-landlord.show.my-date	value="{{ $invoice->from_date }}" label="From Date"/>
				<x-landlord.show.my-date	value="{{ $invoice->to_date }}" label="To Date"/>

				{{-- <x-landlord.show.my-text 	value="{{ $invoice->account->name }}" label="Account"/>
				<x-landlord.show.my-badge		value="{{ $invoice->id }}" label="ID"/>
											--}}
				<x-landlord.show.my-number value="{{ $invoice->price }}" label="Amount"/>
				<x-landlord.show.my-number value="{{ $invoice->amount_paid }}" label="Amount Paid"/>

				<x-landlord.show.my-date value="{{ $invoice->created_at }}" label="Created At:"/>

		</div>
		<!-- End Body -->

		@if (auth()->user()->isSystem())
			<!-- Footer -->
			<div class="card-footer pt-0">
				<div class="d-flex justify-content-end gap-3">
					<a class="btn btn-danger" href="{{ route('invoices.edit',$invoice->id) }}"><i class="bi bi-pencil-square me-1"></i> Edit</a>
				</div>
			</div>
			<!-- End Footer -->
		@endif	
	</div>
	<!-- End Card -->
@endsection
