@extends('layouts.app')
@section('title','View Invoice')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Invoice
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Invoice"/>
			{{-- <x-tenant.buttons.header.create object="Invoice"/> --}}
			<x-tenant.buttons.header.edit object="Invoice" :id="$invoice->id"/>
			<div class="dropdown me-2 d-inline-block position-relative">
				<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
					<i class="align-middle mt-n1" data-feather="folder"></i> Actions
				</a>
				<div class="dropdown-menu dropdown-menu-end">
					<a class="dropdown-item" href="{{ route('invoices.edit', $invoice->id) }}"><i class="align-middle me-1" data-feather="user"></i> Edit</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item modal-boolean-advance"  href="{{ route('invoices.cancel', $invoice->id) }}"
						data-entity="" data-name="Invoice #{{ $invoice->invoice_no }}" data-status="Cancel"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel Payment">
						<i class="align-middle me-1" data-feather="copy"></i> Cancel Invoice</a>
				</div>
			</div>
	
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Invoice Info</h5>
				</div>
				<div class="card-body">
					<x-tenant.show.my-date		value="{{ $invoice->inv_date }}"/>
					<x-tenant.show.my-badge		value="{{ $invoice->po_id }}" label="PO#"/>
					<x-tenant.show.my-text		value="{{ $invoice->invoice_no }}"/>
					<x-tenant.show.my-text		value="{{ $invoice->summary }}"/>
					<x-tenant.show.my-text		value="{{ $invoice->currency }}"/>
					<x-tenant.show.my-number	value="{{ $invoice->sub_total }}"/>
					<x-tenant.show.my-number	value="{{ $invoice->tax }}"/>
					<x-tenant.show.my-number	value="{{ $invoice->gst }}"/>			
					<x-tenant.show.my-number	value="{{ $invoice->amount }}"/>
					<x-tenant.show.my-number	value="{{ $invoice->paid_amount }}"/>
					<x-tenant.show.my-text		value="{{ $invoice->poc->name }}"/>
					<x-tenant.show.my-badge		value="{{ $invoice->status }}" label="Status"/>
					<x-tenant.show.my-badge		value="{{ $invoice->payment_status }}" label="Payment Status"/>
					<x-tenant.show.my-text		value="{{ $invoice->notes }}"/>
				</div>
			</div>
		</div>
		<!-- end col-6 -->
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Supporting Info</h5>
				</div>
				<div class="card-body">
					<x-tenant.show.my-date-time value="{{$invoice->created_at }}" label="Created At"/>
					<x-tenant.show.my-date-time value="{{$invoice->updated_at }}" label="Updated At"/>
				</div>
			</div>
		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->

	<x-tenant.widgets.inv-payments :id="$invoice->id" />

	@include('tenant.includes.modal-boolean-advance')
@endsection

