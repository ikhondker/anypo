@extends('layouts.app')
@section('title','View Purchase Order')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Purchase Order #{{ $po->id }}
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Po"/>
			<x-tenant.buttons.header.create object="Po"/>
			{{-- <a href="{{ route('invoices.create', $po->id) }}" class="btn btn-primary float-end me-2"><i data-feather="plus"></i> Inv Create</a> --}}
			{{-- <x-tenant.buttons.header.edit object="Po" :id="$po->id"/> --}}
			{{-- <a href="{{ route('pols.createline', $po->id) }}" class="btn btn-primary float-end me-2"><i data-feather="plus"></i> Add Line</a> --}}
			{{-- <a href="{{ route('pos.copy', $po->id) }}" class="btn btn-primary float-end me-2 modal-boolean-advance"
				data-entity="" data-name="PO#{{ $po->id }}" data-status="Duplicate"
				data-bs-toggle="tooltip" data-bs-placement="top" title="Duplicate Order">
				<i data-feather="printer"></i> Duplicate</a> --}}

			{{-- <a href="{{ route('payments.create-for-po', $po->id) }}" class="btn btn-primary float-end me-2"><i data-feather="credit-card"></i> Payment</a> --}}
			<a href="{{ route('reports.po', $po->id) }}" class="btn btn-primary float-end me-2"><i data-feather="printer"></i> Print</a>
			<a href="{{ route('pos.submit', $po->id) }}" class="btn btn-primary float-end me-2 modal-boolean-advance"
				data-entity="" data-name="PO#{{ $po->id }}" data-status="Submit"
				data-bs-toggle="tooltip" data-bs-placement="top" title="Submit">
				<i data-feather="external-link"></i> Submit</a>
				
				<div class="dropdown me-2 d-inline-block position-relative">
					<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
						<i class="align-middle mt-n1" data-feather="folder"></i> Actions
			  		</a>
					<div class="dropdown-menu dropdown-menu-end">
						<a class="dropdown-item" href="{{ route('pos.edit', $po->id) }}"><i class="align-middle me-1" data-feather="user"></i> Edit</a>
						<a class="dropdown-item" href="{{ route('pols.createline', $po->id) }}"><i class="align-middle me-1" data-feather="user"></i> Add Line</a>
						<a class="dropdown-item" href="{{ route('reports.po', $po->id) }}"><i class="align-middle me-1" data-feather="user"></i> Print PO</a>
						<a class="dropdown-item modal-boolean-advance"  href="{{ route('pos.copy', $po->id) }}"
							data-entity="" data-name="PO#{{ $po->id }}" data-status="Duplicate"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Duplicate Order">
							<i class="align-middle me-1" data-feather="copy"></i> Duplicate</a>
						<a class="dropdown-item" href="{{ route('pos.detach',$po->id) }}"><i class="align-middle me-1" data-feather="user"></i> Delete Attachments</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="user"></i> View Receipt</a>
						<a class="dropdown-item" href="{{ route('invoices.create', $po->id) }}"><i class="align-middle me-1" data-feather="user"></i> View/Create Invoice</a>
						{{-- <a class="dropdown-item" href="{{ route('payments.create-for-po', $po->id) }}"><i class="align-middle me-1" data-feather="user"></i> View Payments</a> --}}
						<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="user"></i> Run PO Detail Report*</a>
						<div class="dropdown-divider"></div>

						<a class="dropdown-item modal-boolean-advance text-danger"  href="{{ route('wfs.wf-reset-po', $po->id) }}"
							data-entity="" data-name="PO #{{ $po->id }}" data-status="Reset"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Reset PO"> 
							<i class="align-middle me-1" data-feather="copy"></i> Reset Workflow**</a>

						<a class="dropdown-item modal-boolean-advance text-danger"  href="{{ route('pos.show', $po->id) }}"
							data-entity="" data-name="PO #{{ $po->id }}" data-status="Force Close"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Force Close">
							<i class="align-middle me-1" data-feather="copy"></i> Force Close PO *</a>
	
						<a class="dropdown-item modal-boolean-advance text-danger"  href="{{ route('pos.cancel', $po->id) }}"
							data-entity="" data-name="PO #{{ $po->id }}" data-status="Cancel"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel PO">
							<i class="align-middle me-1" data-feather="copy"></i> Cancel PO</a>

					</div>
				</div>


		@endslot
	</x-tenant.page-header>
		

	@include('tenant.includes.po.view-po-header')

	<!-- widget-po-lines -->
	<x-tenant.widgets.po.lines :id="$po->id" :show="true"/>
		
	<!-- /.widget-po-lines -->

	<!-- approval form, show only if pending to current auth user -->
	@if (\App\Helpers\Workflow::allowApprove($po->wf_id))
		@include('tenant.includes.wfl-approve-reject')
	@endif 


	<!-- Approval History -->
	@if ($po->wf_id <> 0)
		<x-tenant.wf.approval-history id="{{ $po->wf_id }}"/>
	@endif
	



	@include('tenant.includes.modal-boolean-advance')
	  
@endsection

