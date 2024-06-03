@extends('layouts.app')
@section('title','Attachments')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('pos.show',$invoice->po_id) }}">PO#{{ $invoice->po_id }}</a></li>
	<li class="breadcrumb-item"><a href="{{ route('pos.invoice', $invoice->po_id) }}">PO Invoices</a></li>
	<li class="breadcrumb-item"><a href="{{ route('invoices.show', $invoice->id) }}">{{ $invoice->invoice_no }}</a></li>
	<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Attachments Invoice #{{ $invoice->invoice_no }}
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Invoice" label="Invoice"/>
			<x-tenant.actions.invoice-actions id="{{ $invoice->id }}" show="true"/>
		@endslot
	</x-tenant.page-header>

	<x-tenant.info.invoice-info id="{{ $invoice->id }}"/>

	<x-tenant.attachment.list-all-by-article entity="{{ EntityEnum::INVOICE->value }}" aid="{{ $invoice->id }}"/>



@endsection

