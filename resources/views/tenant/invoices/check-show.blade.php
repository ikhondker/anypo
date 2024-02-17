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
					<a class="dropdown-item" href="{{ route('invoices.edit', $invoice->id) }}"><i class="align-middle me-1" data-feather="user"></i> Edit</a>
					<a class="dropdown-item modal-boolean-advance"  href="{{ route('invoices.post', $invoice->id) }}"
						data-entity="" data-name="Invoice #{{ $invoice->id }}" data-status="Post"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Post Invoice">
						<i class="align-middle me-1" data-feather="copy"></i> Post Invoice *</a>
					<a class="dropdown-item" href="{{ route('payments.create',$invoice->id) }}"><i class="align-middle me-1" data-feather="user"></i> Make Payment</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item modal-boolean-advance"  href="{{ route('invoices.cancel', $invoice->id) }}"
						data-entity="" data-name="Invoice #{{ $invoice->id }}" data-status="Cancel"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel Payment">
						<i class="align-middle me-1" data-feather="copy"></i> Cancel Invoice *</a>
				</div>
			</div>
	
		@endslot
	</x-tenant.page-header>

	<x-tenant.info.invoice-info id="{{ $invoice->id }}"/>

	<x-tenant.widgets.po.payments :id="$invoice->id" />

	@include('tenant.includes.modal-boolean-advance')
@endsection

