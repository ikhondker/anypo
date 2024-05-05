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
							<a class="text-info" href="{{ route('pos.show',$payment->invoice->po_id) }}">
								{{ "#". $payment->invoice->po_id. " - ". $payment->invoice->po->summary }}
							</a>
						</div>
					</div>
					<x-tenant.show.my-text		value="{{ $payment->invoice->supplier->name }}" label="Supplier"/>
					
					<div class="row mb-3">
						<div class="col-sm-3 text-end">
							<span class="h6 text-secondary">Invoice #:</span>
						</div>
						<div class="col-sm-9">
							<a class="text-info" href="{{ route('invoices.show',$payment->invoice_id) }}">
								{{ $payment->invoice->invoice_no }}
							</a>
						</div>
					</div>
					<x-tenant.show.my-amount-currency	value="{{ $payment->invoice->amount }}" currency="{{ $payment->currency }}" label="Invoice Amount"/>
					<x-tenant.show.my-date		value="{{ $payment->pay_date }}"/>
					<x-tenant.show.my-text		value="{{ $payment->bank_account->ac_name }}" label="Bank Ac"/>
					<x-tenant.show.my-text		value="{{ $payment->cheque_no }}" label="Ref/Cheque#"/>
					<x-tenant.show.my-amount-currency	value="{{ $payment->amount }}" currency="{{ $payment->currency }}" label="Payment Amount"/>
					<x-tenant.show.my-text		value="{{ $payment->payee->name }}" label="Payee"/>
					<x-tenant.show.my-badge		value="{{ $payment->status }}" label="Status"/>
					<x-tenant.show.my-text-area		value="{{ $payment->notes }}" label="Notes"/>
					<div class="row mb-3">
						<div class="col-sm-3 text-end">
							<span class="h6 text-secondary">Attachments:</span>
						</div>
						<div class="col-sm-9">
							<x-tenant.attachment.all entity="PAYMENT" aid="{{ $payment->id }}"/>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->

	
@endsection

