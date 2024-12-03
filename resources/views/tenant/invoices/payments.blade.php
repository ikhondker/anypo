@extends('layouts.tenant.app')
@section('title','Payments')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('pos.show',$invoice->po_id) }}" class="text-muted">PO#{{ $invoice->po_id }}</a></li>
	<li class="breadcrumb-item"><a href="{{ route('pos.invoices', $invoice->po_id) }}" class="text-muted">PO Invoices</a></li>
	<li class="breadcrumb-item"><a href="{{ route('invoices.show', $invoice->id) }}" class="text-muted">{{ $invoice->invoice_no }}</a></li>
	<li class="breadcrumb-item active">Payments</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Payments of Invoice #{{ $invoice->invoice_no }}
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists model="Invoice" label="Invoice"/>
			<x-tenant.actions.invoice-actions invoiceId="{{ $invoice->id }}" show="true"/>
		@endslot
	</x-tenant.page-header>

	<x-tenant.info.invoice-info invoiceId="{{ $invoice->id }}"/>

	<x-tenant.widgets.invoice.payments :invoiceId="$invoice->id" />

@endsection

