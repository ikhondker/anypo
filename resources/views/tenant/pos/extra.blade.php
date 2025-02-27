@extends('layouts.tenant.app')
@section('title','Additional Information for Purchase Orders')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('pos.index') }}" class="text-muted">Purchase Orders</a></li>
	<li class="breadcrumb-item"><a href="{{ route('pos.show',$po->id) }}" class="text-muted">PO#{{ $po->id }}</a></li>
	<li class="breadcrumb-item active">Additional Information</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Additional Information for Purchase Order
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists model="Po" label="Purchase Order"/>
			<x-tenant.buttons.header.create model="Po" label="Purchase Order"/>
			<x-tenant.actions.po-actions poId="{{ $po->id }}" show="true"/>
		@endslot
	</x-tenant.page-header>

	<x-tenant.info.po-info poId="{{ $po->id }}"/>


	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Additional Information PO # {{ $po->id }}</h5>
					<h6 class="card-subtitle text-muted">Additional information of a Purchase Order</h6>
				</div>
				<div class="card-body">
					<table class="table table-sm my-2">
						<tbody>
							<x-tenant.show.my-amount-currency	value="{{ $po->sub_total }}" currency="{{ $po->currency }}" label="Subtotal"/>
								<x-tenant.show.my-amount-currency	value="{{ $po->tax }}" currency="{{ $po->currency }}" label="Tax"/>
								<x-tenant.show.my-amount-currency	value="{{ $po->gst }}" currency="{{ $po->currency }}" label="GST"/>
								<x-tenant.show.my-amount-currency	value="{{ $po->amount }}" currency="{{ $po->currency }}" label="PR Amount" />
								<x-tenant.show.my-date		value="{{ $po->submission_date }}" label="Submission Date"/>
								<x-tenant.show.my-date		value="{{ $po->auth_date }}" label="Auth Date"/>
								<x-tenant.show.my-text		value="{{ $po->hierarchy->name }}" label="Hierarchy Name"/>
						</tbody>
					</table>


				</div>
			</div>

		</div>
		<!-- end col-6 -->
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Currency Conversion Information</h5>
					<h6 class="card-subtitle text-muted">Purchase Order Amounts in Functional Currency.</h6>
				</div>
				<div class="card-body">
					<table class="table table-sm my-2">
						<tbody>
							<x-tenant.show.my-text		value="{{ $po->fc_currency }}" label="Functional Currency"/>
								<x-tenant.show.my-amount	value="{{ $po->fc_exchange_rate }}" label="Exchange Rate"/>
								<x-tenant.show.my-amount	value="{{ $po->fc_sub_total }}" label="Subtotal"/>
								<x-tenant.show.my-amount	value="{{ $po->fc_tax }}" label="Tax"/>
								<x-tenant.show.my-amount	value="{{ $po->fc_gst }}" label="GST"/>
								<x-tenant.show.my-amount	value="{{ $po->fc_amount }}" label="PR Amount"/>
						</tbody>
					</table>


				</div>
			</div>



		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->
@endsection

