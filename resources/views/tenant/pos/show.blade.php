@extends('layouts.app')
@section('title','View Purchase Order')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('pos.index') }}">Purchase Orders</a></li>
	<li class="breadcrumb-item active">PO#{{ $po->id }}</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			Purchase Order #{{ $po->id }}
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Po" label="Purchase Order"/>
			<x-tenant.buttons.header.create object="Po" label="Purchase Order"/>
			
			{{-- <a href="{{ route('invoices.create', $po->id) }}" class="btn btn-primary float-end me-2"><i data-feather="plus"></i> Inv Create</a> --}}
			{{-- <x-tenant.buttons.header.edit object="Po" :id="$po->id"/> --}}
			{{-- <a href="{{ route('pols.createline', $po->id) }}" class="btn btn-primary float-end me-2"><i data-feather="plus"></i> Add Line</a> --}}
			{{-- <a href="{{ route('pos.copy', $po->id) }}" class="btn btn-primary float-end me-2 sweet-alert2-advance"
				data-entity="" data-name="PO#{{ $po->id }}" data-status="Duplicate"
				data-bs-toggle="tooltip" data-bs-placement="top" title="Duplicate Order">
				<i data-feather="printer"></i> Duplicate</a> --}}

			{{-- <a href="{{ route('payments.create-for-po', $po->id) }}" class="btn btn-primary float-end me-2"><i data-feather="credit-card"></i> Payment</a> --}}
			{{-- <a href="{{ route('reports.po', $po->id) }}" class="btn btn-primary float-end me-2"><i data-feather="printer"></i> Print</a> --}}
			@if ($po->auth_status == App\Enum\AuthStatusEnum::DRAFT->value)
				<a href="{{ route('pos.submit', $po->id) }}" class="btn btn-primary float-end me-2 sweet-alert2-advance"
					data-entity="" data-name="PO#{{ $po->id }}" data-status="Submit"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Submit">
					<i data-feather="external-link"></i> Submit</a>
			@endif	
				
			<x-tenant.actions.po-actions id="{{ $po->id }}"/>

		@endslot
	</x-tenant.page-header>
		
	<x-tenant.widgets.po.show-po-header id="{{ $po->id }}"/>

	<!-- widget-po-lines -->
	<x-tenant.widgets.pol.show-po-lines id="{{ $po->id }}">
		@include('tenant.includes.po.po-footer-show')
	</x-tenant.widgets.pol.show-po-lines>

	<!-- /.widget-po-lines -->

	<!-- approval form, show only if pending to current auth user -->
	@if (\App\Helpers\Workflow::allowApprove($po->wf_id))
		{{-- @include('tenant.includes.wfl-approve-reject') --}}
		<x-tenant.widgets.wfl.get-approval wfid="{{ $po->wf_id }}" />
	@endif 

	@include('tenant.includes.js.sweet-alert2-advance')
	  
@endsection

