@extends('layouts.app')
@section('title','View Invoice')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Invoice
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Invoice"/>
			<x-tenant.buttons.header.lists object="Po" label="Purchase Order"/>
			<x-tenant.actions.invoice-actions id="{{ $invoice->id }}"/>
	
	
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
							<x-tenant.attachment.all entity="INVOICE" aid="{{ $invoice->id }}"/>
						</div>
					</div>
					@if ($invoice->status <> App\Enum\InvoiceStatusEnum::POSTED->value)
						<x-tenant.buttons.show.edit object="Invoice" :id="$invoice->id"/>
					@endif
					
				</div>
			</div>
		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->

	<x-tenant.widgets.po.payments :id="$invoice->id" />

	@include('tenant.includes.modal-boolean-advance')
@endsection

