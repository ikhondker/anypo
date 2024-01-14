@extends('layouts.app')
@section('title','View Purchase Order')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Purchase Order
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Po"/>
			<x-tenant.buttons.header.create object="Po"/>
			<x-tenant.buttons.header.edit object="Po" :id="$po->id"/>
			<a href="{{ route('pols.createline', $po->id) }}" class="btn btn-primary float-end me-2"><i data-feather="plus"></i> Add Line</a>
			<a href="{{ route('pos.copy', $po->id) }}" class="btn btn-primary float-end me-2 modal-boolean-advance"
				data-entity="" data-name="PR#{{ $po->id }}" data-status="Duplicate"
				data-bs-toggle="tooltip" data-bs-placement="top" title="Duplicate Order">
				<i data-feather="printer"></i> Duplicate</a>
			<a href="{{ route('pos.submit', $po->id) }}" class="btn btn-primary float-end me-2"><i data-feather="credit-card"></i> Payment</a>
			<a href="{{ route('reports.po', $po->id) }}" class="btn btn-primary float-end me-2"><i data-feather="printer"></i> Print</a>
			<a href="{{ route('pos.submit', $po->id) }}" class="btn btn-primary float-end me-2 modal-boolean-advance"
				data-entity="" data-name="PR#{{ $po->id }}" data-status="Submit"
				data-bs-toggle="tooltip" data-bs-placement="top" title="Submit Order">
				<i data-feather="external-link"></i> Submit</a>
		@endslot
	</x-tenant.page-header>
		

	@include('tenant.includes.view-po-header')

	<!-- widget-po-lines -->
	<x-tenant.widgets.po-lines po_id="{{ $po->id }}" :show="true"/>
		
	<!-- /.widget-po-lines -->

	<!-- approval form, show only if pending to current auth user -->
	@if (\App\Helpers\Workflow::allowApprove($po->wf_id))
		@include('tenant.includes.wfl-approve-reject')
	@endif 


	<!-- Approval History -->
	@if ($po->wf_id <> 0)
		<x-tenant.widgets.approval-history id="{{ $po->wf_id }}"/>
	@endif
	
	@include('tenant.includes.modal-boolean-advance')
	  
@endsection

