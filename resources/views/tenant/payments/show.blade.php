@extends('layouts.app')
@section('title','View Payment')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Payment
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Payment"/>
			<x-tenant.buttons.header.edit object="Payment" :id="$payment->id"/>
			<div class="dropdown me-2 d-inline-block position-relative">
				<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
					<i class="align-middle mt-n1" data-feather="folder"></i> Actions
				</a>
				<div class="dropdown-menu dropdown-menu-end">
					<a class="dropdown-item" href="{{ route('payments.create',  $payment->invoice_id) }}"><i class="align-middle me-1" data-feather="plus-square"></i> Make Another Payment</a>
					<a class="dropdown-item" href="{{ route('invoices.show',$payment->invoice_id) }}"><i class="align-middle me-1" data-feather="layout"></i> View Invoice</a>
					<a class="dropdown-item" href="{{ route('pos.show',  $payment->invoice->po_id) }}"><i class="align-middle me-1" data-feather="layout"></i> View Purchase Order</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item modal-boolean-advance text-danger"  href="{{ route('payments.cancel', $payment->id) }}"
						data-entity="" data-name="PO #{{ $payment->id }}" data-status="Cancel"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel Payment">
						<i class="align-middle me-1" data-feather="x-circle"></i> Cancel Payment *</a>
				</div>
			</div>
		@endslot
	</x-tenant.page-header>

	{{-- <x-tenant.info.invoice-info id="{{ $payment->invoice_id }}"/> --}}

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Payment Information</h5>
					<h6 class="card-subtitle text-muted">Payment Information Details.</h6>
				</div>
				<div class="card-body">
					<div class="row mb-3">
						<div class="col-sm-3 text-end">
							<span class="h6 text-secondary">PO #:</span>
						</div>
						<div class="col-sm-9">
							{{ "#". $payment->invoice->po_id. " - ". $payment->invoice->po->summary }}
						</div>
					</div>
					<x-tenant.show.my-text		value="{{ $payment->invoice->supplier->name }}" label="Supplier"/>
					<x-tenant.show.my-date		value="{{ $payment->pay_date }}"/>
					<x-tenant.show.my-text		value="{{ $payment->bank_account->ac_name }}" label="Bank Ac"/>
					<x-tenant.show.my-text		value="{{ $payment->cheque_no }}" label="Ref/Cheque#"/>
					<x-tenant.show.my-amount-currency	value="{{ $payment->amount }}" currency="{{ $payment->currency }}" label="Payment Amount"/>
					<x-tenant.show.my-text		value="{{ $payment->invoice->invoice_no }}" label="Invoice #"/>	
					<x-tenant.show.my-text		value="{{ $payment->payee->name }}" label="Payee"/>
					<x-tenant.show.my-badge		value="{{ $payment->status }}" label="Status"/>
					<x-tenant.show.my-text		value="{{ $payment->notes }}" label="Notes"/>
					<div class="row mb-3">
						<div class="col-sm-3 text-end">
							<span class="h6 text-secondary">Attachments:</span>
						</div>
						<div class="col-sm-9">
							<x-tenant.attachment.all entity="PR" aid="{{ $payment->id }}"/>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->

	@include('tenant.includes.modal-boolean-advance')
@endsection

