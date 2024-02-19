@extends('layouts.app')
@section('title','Additional Information for Requisition')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Additional Information for Purchase Order
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Pr"/>
			<x-tenant.buttons.header.create object="Pr"/>
			
				<div class="dropdown me-2 d-inline-block position-relative">
					<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
						<i class="align-middle mt-n1" data-feather="folder"></i> Actions
					</a>
					<div class="dropdown-menu dropdown-menu-end">
						<a class="dropdown-item" href="{{ route('projects.edit', $po->id) }}"><i class="align-middle me-1" data-feather="user"></i> Edit</a>
						<a class="dropdown-item" href="{{ route('projects.budget', $po->id) }}"><i class="align-middle me-1" data-feather="user"></i> Budget Usage</a>
						
						<div class="dropdown-divider"></div>
						<a class="dropdown-item text-danger" href="{{ route('projects.detach', $po->id) }}"><i class="align-middle me-1" data-feather="user"></i> Delete Attachment</a>
						<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="user"></i> Action</a>
						<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="user"></i> Action</a>
					</div>
				</div>
		@endslot
	</x-tenant.page-header>

	<x-tenant.info.po-info id="{{ $po->id }}"/>

	


	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Additional Information PO # {{ $po->id }}</h5>
					<h6 class="card-subtitle text-muted">Additional information of a Purchase Order</h6>
				</div>
				<div class="card-body">
					<x-tenant.show.my-amount-currency	value="{{ $po->sub_total }}" currency="{{ $po->currency }}" label="Subtotal"/>
					<x-tenant.show.my-amount-currency	value="{{ $po->tax }}" currency="{{ $po->currency }}" label="Tax"/>
					<x-tenant.show.my-amount-currency	value="{{ $po->gst }}" currency="{{ $po->currency }}" label="GST"/>
					<x-tenant.show.my-amount-currency	value="{{ $po->amount }}" currency="{{ $po->currency }}" label="PR Amount" />
					<x-tenant.show.my-date		value="{{ $po->submission_date  }}" label="Submission Date"/>
					<x-tenant.show.my-date		value="{{ $po->auth_date  }}" label="Auth Date"/>
					<x-tenant.show.my-text		value="{{ $po->hierarchy->name }}" label="Hierarchy Name"/>
				</div>
			</div>

		</div>
		<!-- end col-6 -->
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Currency Conversion Information</h5>
					<h6 class="card-subtitle text-muted">Requisitions Amounts in Functional Currency.</h6>
				</div>
				<div class="card-body">
					<x-tenant.show.my-text		value="{{ $po->fc_currency }}" label="Functional Currency"/>
					<x-tenant.show.my-amount	value="{{ $po->fc_exchange_rate }}" label="Exchange Rate"/>
					<x-tenant.show.my-amount	value="{{ $po->fc_sub_total }}" label="Subtotal"/>
					<x-tenant.show.my-amount	value="{{ $po->fc_tax }}" label="Tax"/>
					<x-tenant.show.my-amount	value="{{ $po->fc_gst }}" label="GST"/>
					<x-tenant.show.my-amount	value="{{ $po->fc_amount }}" label="PR Amount"/>
				</div>
			</div>

			
			
		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->
@endsection

