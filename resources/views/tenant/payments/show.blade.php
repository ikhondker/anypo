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
					<a class="dropdown-item" href="{{ route('payments.edit', $payment->id) }}"><i class="align-middle me-1" data-feather="user"></i> Edit</a>
					<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="user"></i> Duplicate</a>
					
					<div class="dropdown-divider"></div>
					<a class="dropdown-item modal-boolean-advance"  href="{{ route('payments.cancel', $payment->id) }}"
						data-entity="" data-name="PO #{{ $payment->id }}" data-status="Cancel"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel Payment">
						<i class="align-middle me-1" data-feather="copy"></i> Cancel Payment</a>
				</div>
			</div>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Payment Info</h5>
				</div>
				<div class="card-body">
					<x-tenant.show.my-date		value="{{ $payment->pay_date }}"/>
					<x-tenant.show.my-badge		value="{{ $payment->id }}" label="Pay ID#"/>
					<x-tenant.show.my-text		value="{{ $payment->invoice->invoice_no }}" label="Invoice #"/>	
					<x-tenant.show.my-text		value="{{ $payment->bank_account->ac_name }}" label="Bank Ac"/>
					<x-tenant.show.my-number	value="{{ $payment->amount }}"/>
					<x-tenant.show.my-text		value="{{ $payment->currency }}" label="Currency"/>
					<x-tenant.show.my-text		value="{{ $payment->cheque_no }}" label="Ref/Cheque No"/>
					<x-tenant.show.my-text		value="{{ $payment->payee->name }}" label="Payee"/>
					<x-tenant.show.my-badge		value="{{ $payment->status }}" label="Status"/>
					<x-tenant.show.my-text		value="{{ $payment->notes }}"/>
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
					<x-tenant.show.my-date-time value="{{$payment->created_at }}" label="Created At"/>
					<x-tenant.show.my-date-time value="{{$payment->updated_at }}" label="Updated At"/>
				</div>
			</div>
		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->

	@include('tenant.includes.modal-boolean-advance')
@endsection

