@extends('layouts.tenant.app')
@section('title','Accountings')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('pos.show',$invoice->po_id) }}" class="text-muted">PO#{{ $invoice->po_id }}</a></li>
	<li class="breadcrumb-item"><a href="{{ route('pos.invoices', $invoice->po_id) }}" class="text-muted">Invoices</a></li>
	<li class="breadcrumb-item"><a href="{{ route('invoices.show', $invoice->id) }}" class="text-muted">{{ $invoice->invoice_no }}</a></li>
	<li class="breadcrumb-item active">Accountings</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Accountings for Invoice #{{ $invoice->invoice_no }}
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Invoice" label="Requisition"/>
			{{-- <x-tenant.buttons.header.create object="Invoice" label="Requisition"/> --}}
			<x-tenant.actions.invoice-actions id="{{ $invoice->id }}" show="true"/>
		@endslot
	</x-tenant.page-header>

	<x-tenant.info.invoice-info id="{{ $invoice->id }}"/>

	<x-tenant.ael.ael-for-invoice id="{{ $invoice->id }}"/>

@endsection

