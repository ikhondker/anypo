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
			{{-- <x-tenant.buttons.header.edit object="Pr" :id="$pr->id"/> --}}
			{{-- <a href="{{ route('prls.createline', $pr->id) }}" class="btn btn-primary float-end me-2"><i data-feather="plus"></i> Add Line</a> --}}
			{{-- <a href="{{ route('prs.copy', $pr->id) }}" class="btn btn-primary float-end me-2 modal-boolean-advance"
				data-entity="" data-name="PR#{{ $pr->id }}" data-status="Duplicate"
				data-bs-toggle="tooltip" data-bs-placement="top" title="Duplicate Requisition">
				<i data-feather="printer"></i> Duplicate</a> --}}
			{{-- <a href="{{ route('prs.convert', $pr->id) }}" class="btn btn-primary float-end me-2 modal-boolean-advance"
				data-entity="" data-name="PR#{{ $pr->id }}" data-status="Covert to PO"
				data-bs-toggle="tooltip" data-bs-placement="top" title="Covert to PO">
				<i data-feather="printer"></i> Covert to PO*</a> --}}
			{{-- <a href="{{ route('prs.submit', $pr->id) }}" class="btn btn-primary float-end me-2"><i data-feather="credit-card"></i> Payment</a> --}}
			<a href="{{ route('reports.pr', $pr->id) }}" class="btn btn-primary float-end me-2"><i data-feather="printer"></i> Print</a>
			@if ($pr->auth_status == App\Enum\AuthStatusEnum::DRAFT->value)
				<a href="{{ route('prs.submit', $pr->id) }}" class="btn btn-primary float-end me-2 modal-boolean-advance"
					data-entity="" data-name="PR#{{ $pr->id }}" data-status="Submit"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Submit Requisition">
					<i data-feather="external-link"></i> Submit</a>
			@endif

			<div class="dropdown me-2 d-inline-block position-relative">
				<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
					<i class="align-middle mt-n1" data-feather="folder"></i> Actions
				</a>
				<div class="dropdown-menu dropdown-menu-end">
					<a class="dropdown-item" href="{{ route('reports.pr', $pr->id) }}"><i class="align-middle me-1" data-feather="user"></i> Print Requisition</a>
					<a class="dropdown-item" href="{{ route('prs.history', $pr->id) }}"><i class="align-middle me-1" data-feather="user"></i> View Approval History</a>
					<a class="dropdown-item" href="{{ route('prs.edit', $pr->id) }}"><i class="align-middle me-1" data-feather="user"></i> Edit Requisition</a>
					<a class="dropdown-item" href="{{ route('prls.createline', $pr->id) }}"><i class="align-middle me-1" data-feather="user"></i> Add Requisition Line</a>
					<a class="dropdown-item modal-boolean-advance"  href="{{ route('prs.copy', $pr->id) }}"
						data-entity="" data-name="PO#{{ $pr->id }}" data-status="Duplicate"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Duplicate PR">
						<i class="align-middle me-1" data-feather="copy"></i> Copy Requisition</a>
					<a class="dropdown-item modal-boolean-advance"  href="{{ route('prs.convert', $pr->id) }}"
						data-entity="" data-name="PR#{{ $pr->id }}" data-status="Covert to PO"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Covert to PO">
						<i class="align-middle me-1" data-feather="copy"></i> Covert to PO</a>
					
						<div class="dropdown-divider"></div>

					<a class="dropdown-item text-danger" href="{{ route('prs.detach',$pr->id) }}"><i class="align-middle me-1" data-feather="user"></i> Delete Attachment</a>

					<a class="dropdown-item modal-boolean-advance text-danger"  href="{{ route('wfs.wf-reset-pr', $pr->id) }}"
						data-entity="" data-name="PR#{{ $pr->id }}" data-status="Reset"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Reset PR"> 
						<i class="align-middle me-1" data-feather="copy"></i> Reset Workflow**</a>

					<a class="dropdown-item modal-boolean-advance text-danger"  href="{{ route('prs.cancel', $pr->id) }}"
						data-entity="" data-name="PR#{{ $pr->id }}" data-status="Cancel"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel Requisition">
						<i class="align-middle me-1" data-feather="copy"></i> Cancel Requisition</a>

					<a class="dropdown-item modal-boolean-advance text-danger"  href="{{ route('prs.destroy', $pr->id) }}"
						data-entity="" data-name="PR#{{ $pr->id }}" data-status="Delete"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Requisition">
						<i class="align-middle me-1" data-feather="copy"></i> Delete Requisition*</a>
	
				</div>
			</div>

		@endslot
	</x-tenant.page-header>
		

	@include('tenant.includes.pr.view-pr-header')

	<!-- widget-pr-lines -->
	<x-tenant.widgets.pr.lines id="{{ $pr->id }}" :show="true"/>
		
	<!-- /.widget-pr-lines -->

	<!-- approval form, show only if pending to current auth user -->
	@if (\App\Helpers\Workflow::allowApprove($pr->wf_id))
		@include('tenant.includes.wfl-approve-reject')
	@endif 


	
	@include('tenant.includes.modal-boolean-advance')
	  
@endsection

