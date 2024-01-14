@extends('layouts.app')
@section('title','View Purchase Requisition')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Purchase Requisition
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Pr"/>
			<x-tenant.buttons.header.create object="Pr"/>
			<x-tenant.buttons.header.edit object="Pr" :id="$pr->id"/>
			<a href="{{ route('prls.createline', $pr->id) }}" class="btn btn-primary float-end me-2"><i data-feather="plus"></i> Add Line</a>
			<a href="{{ route('prs.copy', $pr->id) }}" class="btn btn-primary float-end me-2 modal-boolean-advance"
				data-entity="" data-name="PR#{{ $pr->id }}" data-status="Duplicate"
				data-bs-toggle="tooltip" data-bs-placement="top" title="Duplicate Requisition">
				<i data-feather="printer"></i> Duplicate</a>
			<a href="{{ route('prs.copy', $pr->id) }}" class="btn btn-primary float-end me-2 modal-boolean-advance"
				data-entity="" data-name="PR#{{ $pr->id }}" data-status="Duplicate"
				data-bs-toggle="tooltip" data-bs-placement="top" title="Covert to PO">
				<i data-feather="printer"></i> Covert to PO*</a>
			<a href="{{ route('prs.submit', $pr->id) }}" class="btn btn-primary float-end me-2"><i data-feather="credit-card"></i> Payment</a>
			<a href="{{ route('reports.pr', $pr->id) }}" class="btn btn-primary float-end me-2"><i data-feather="printer"></i> Print</a>
			<a href="{{ route('prs.submit', $pr->id) }}" class="btn btn-primary float-end me-2 modal-boolean-advance"
				data-entity="" data-name="PR#{{ $pr->id }}" data-status="Submit"
				data-bs-toggle="tooltip" data-bs-placement="top" title="Submit Requisition">
				<i data-feather="external-link"></i> Submit</a>
		@endslot
	</x-tenant.page-header>
		

	@include('tenant.includes.view-pr-header')

	<!-- widget-pr-lines -->
	<x-tenant.widgets.pr-lines id="{{ $pr->id }}" :show="true"/>
		
	<!-- /.widget-pr-lines -->

	<!-- approval form, show only if pending to current auth user -->
	@if (\App\Helpers\Workflow::allowApprove($pr->wf_id))
		@include('tenant.includes.wfl-approve-reject')
	@endif 


	<!-- Approval History -->
	@if ($pr->wf_id <> 0)
		<x-tenant.widgets.approval-history id="{{ $pr->wf_id }}"/>
	@endif
	
	@include('tenant.includes.modal-boolean-advance')
	  
@endsection

