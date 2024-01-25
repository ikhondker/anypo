@extends('layouts.app')
@section('title','View Payment')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Payment
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Payment"/>
			<x-tenant.buttons.header.create object="Payment"/>
			<x-tenant.buttons.header.edit object="Payment" :id="$payment->id"/>
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
					<x-tenant.show.my-badge		value="{{ $payment->po_id }}" label="PO#"/>
					<x-tenant.show.my-text		value="{{ $payment->bank_account->ac_name }}"/>
					<x-tenant.show.my-number	value="{{ $payment->amount }}"/>
					<x-tenant.show.my-text		value="{{ $payment->currency }}"/>
					<x-tenant.show.my-text		value="{{ $payment->cheque_no }}" label="Ref/Cheque No"/>
					<x-tenant.show.my-text		value="{{ $payment->payee->name }}" label="Ref/Cheque No"/>
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

@endsection

