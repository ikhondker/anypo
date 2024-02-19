@extends('layouts.app')
@section('title','Additional Information for Requisition')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Additional Information for Requisition
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Pr"/>
			<x-tenant.buttons.header.create object="Pr"/>
			
				<div class="dropdown me-2 d-inline-block position-relative">
					<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
						<i class="align-middle mt-n1" data-feather="folder"></i> Actions
					</a>
					<div class="dropdown-menu dropdown-menu-end">
						<a class="dropdown-item" href="{{ route('projects.edit', $pr->id) }}"><i class="align-middle me-1" data-feather="user"></i> Edit</a>
						<a class="dropdown-item" href="{{ route('projects.budget', $pr->id) }}"><i class="align-middle me-1" data-feather="user"></i> Budget Usage</a>
						
						<div class="dropdown-divider"></div>
						<a class="dropdown-item text-danger" href="{{ route('projects.detach', $pr->id) }}"><i class="align-middle me-1" data-feather="user"></i> Delete Attachment</a>
						<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="user"></i> Action</a>
						<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="user"></i> Action</a>
					</div>
				</div>
		@endslot
	</x-tenant.page-header>

	<x-tenant.info.por-info id="{{ $pr->id }}"/>

	


	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Additional Information PR# {{ $pr->id }}</h5>
					<h6 class="card-subtitle text-muted">Additional information of a Purchase Requisitions</h6>
				</div>
				<div class="card-body">
					<x-tenant.show.my-amount-currency	value="{{ $pr->sub_total }}" currency="{{ $pr->currency }}" label="Subtotal"/>
					<x-tenant.show.my-amount-currency	value="{{ $pr->tax }}" currency="{{ $pr->currency }}" label="Tax"/>
					<x-tenant.show.my-amount-currency	value="{{ $pr->gst }}" currency="{{ $pr->currency }}" label="GST"/>
					<x-tenant.show.my-amount-currency	value="{{ $pr->amount }}" currency="{{ $pr->currency }}" label="PR Amount" />
					<x-tenant.show.my-date		value="{{ $pr->submission_date  }}" label="Submission Date"/>
					<x-tenant.show.my-date		value="{{ $pr->auth_date  }}" label="Auth Date"/>
					<x-tenant.show.my-text		value="{{ $pr->hierarchy->name }}" label="Hierarchy Name"/>
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
					<x-tenant.show.my-text		value="{{ $pr->fc_currency }}" label="Functional Currency"/>
					<x-tenant.show.my-amount	value="{{ $pr->fc_exchange_rate }}" label="Exchange Rate"/>
					<x-tenant.show.my-amount	value="{{ $pr->fc_sub_total }}" label="Subtotal"/>
					<x-tenant.show.my-amount	value="{{ $pr->fc_tax }}" label="Tax"/>
					<x-tenant.show.my-amount	value="{{ $pr->fc_gst }}" label="GST"/>
					<x-tenant.show.my-amount	value="{{ $pr->fc_amount }}" label="PR Amount"/>
				</div>
			</div>

			
			
		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->
@endsection

