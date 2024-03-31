@extends('layouts.app')
@section('title','Attachments')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('receipts.index') }}">Receipts TODO</a></li>
	<li class="breadcrumb-item"><a href="{{ route('receipts.index') }}">TODO POL</a></li>
	<li class="breadcrumb-item active">Attachments</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			Attachments Invoice #{{ $invoice->id }}
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Invoice" label="Requisition"/>
			{{-- <x-tenant.buttons.header.create object="Invoice" label="Requisition"/> --}}
			<x-tenant.actions.invoice-actions id="{{ $invoice->id }}" show="true"/>
		@endslot
	</x-tenant.page-header>
	
	<x-tenant.info.invoice-info id="{{ $invoice->id }}"/>

	<x-tenant.attachment.list-all-by-article entity="{{ EntityEnum::INVOICE->value }}" aid="{{ $invoice->id }}"/>
				
	@include('tenant.includes.js.sweet-alert2-advance')

@endsection

