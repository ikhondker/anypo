@extends('layouts.app')
@section('title','View Payment')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('pos.show',$payment->invoice->po_id) }}">PO #{{ $payment->invoice->po_id }}</a></li>
	<li class="breadcrumb-item"><a href="{{ route('pos.invoice', $payment->invoice->po_id) }}">PO Invoices</a></li>
	<li class="breadcrumb-item"><a href="{{ route('invoices.show', $payment->invoice->id) }}">Invoice #{{ $payment->invoice->invoice_no }}</a></li>
	<li class="breadcrumb-item active">Payment #{{ $payment->id }}</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Payment
		@endslot
		@slot('buttons')

			<x-tenant.buttons.header.lists object="Payment"/>
			<x-tenant.buttons.header.lists object="Po" label="Purchase Order"/>
			<x-tenant.actions.payment-actions id="{{ $payment->id }}"/>
		@endslot
	</x-tenant.page-header>

	<x-tenant.info.payment-info id="{{ $payment->id }}"/>

	<x-tenant.accounting.for-po id="{{ $po->id }}"/>

	
@endsection

