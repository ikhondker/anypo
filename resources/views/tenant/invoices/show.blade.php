@extends('layouts.app')
@section('title','View Invoice')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Invoice
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Invoice"/>
			<x-tenant.buttons.header.create object="Invoice"/>
			<x-tenant.buttons.header.edit object="Invoice" :id="$invoice->id"/>
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

@endsection

