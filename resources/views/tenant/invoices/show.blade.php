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
			{{-- <x-tenant.buttons.header.edit object="Invoice" :id="$invoice->id"/> --}}
			<div class="dropdown me-2 d-inline-block position-relative">
				<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
					<i class="align-middle mt-n1" data-feather="folder"></i> Actions
				</a>
				<div class="dropdown-menu dropdown-menu-end">
					<a class="dropdown-item" href="{{ route('invoices.edit', $invoice->id) }}"><i class="align-middle me-1" data-feather="edit"></i> Edit Invoice</a>
					<a class="dropdown-item modal-boolean-advance"  href="{{ route('invoices.post', $invoice->id) }}"
						data-entity="" data-name="Invoice #{{ $invoice->id }}" data-status="Post"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Post Invoice">
						<i class="align-middle me-1" data-feather="copy"></i> Post Invoice *</a>
					<a class="dropdown-item" href="{{ route('invoices.create', $invoice->po_id) }}"><i class="align-middle me-1" data-feather="plus-square"></i> Create Another Invoice</a>
					<a class="dropdown-item" href="{{ route('payments.create',$invoice->id) }}"><i class="align-middle me-1" data-feather="layout"></i> Pay this Invoice</a>
					<a class="dropdown-item" href="{{ route('pos.show',  $invoice->po_id) }}"><i class="align-middle me-1" data-feather="layout"></i> View Purchase Order</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item modal-boolean-advance text-danger"  href="{{ route('invoices.cancel', $invoice->id) }}"
						data-entity="" data-name="Invoice #{{ $invoice->id }}" data-status="Cancel"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel Payment">
						<i class="align-middle me-1" data-feather="x-circle"></i> Cancel Invoice</a>
				</div>
			</div>
	
		@endslot
	</x-tenant.page-header>

	

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Invoice Detail</h5>
					<h6 class="card-subtitle text-muted">Invoice Detail Information.</h6>
				</div>
				<div class="card-body">
					<div class="row mb-3">
						<div class="col-sm-3 text-end">
							<span class="h6 text-secondary">PO #:</span>
						</div>
						<div class="col-sm-9">
							{{ "#". $invoice->po_id. " - ". $invoice->po->summary }}
						</div>
					</div>
					<x-tenant.show.my-text		value="{{ $invoice->supplier->name }}" label="Supplier"/>
					<x-tenant.show.my-text		value="{{ $invoice->invoice_no }}" label="Invoice Num"/>
					<x-tenant.show.my-amount-currency	value="{{ $invoice->amount }}" currency="{{ $invoice->currency }}" label="Invoice Amount"/>
					<x-tenant.show.my-date		value="{{ $invoice->invoice_date }}" label="Invoice Date"/>
					<x-tenant.show.my-text		value="{{ $invoice->summary }}" label="Narration"/>
					<x-tenant.show.my-number	value="{{ $invoice->sub_total }}"/>
					<x-tenant.show.my-number	value="{{ $invoice->tax }}"/>
					<x-tenant.show.my-number	value="{{ $invoice->gst }}"/>			
					<x-tenant.show.my-text		value="{{ $invoice->poc->name }}" label="PoC Name"/>
					<x-tenant.show.my-amount-currency	value="{{ $invoice->paid_amount }}" currency="{{ $invoice->currency }}" label="Paid Amount"/>
					<x-tenant.show.my-badge		value="{{ $invoice->status }}" label="Status"/>
					<x-tenant.show.my-badge		value="{{ $invoice->payment_status }}" label="Payment Status"/>
					<x-tenant.show.my-text		value="{{ $invoice->notes }}"/>
					<div class="row mb-3">
						<div class="col-sm-3 text-end">
							<span class="h6 text-secondary">Attachments:</span>
						</div>
						<div class="col-sm-9">
							<x-tenant.attachment.all entity="PR" aid="{{ $invoice->id }}"/>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->

	<x-tenant.widgets.po.payments :id="$invoice->id" />

	@include('tenant.includes.modal-boolean-advance')
@endsection

