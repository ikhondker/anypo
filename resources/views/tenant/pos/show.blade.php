@extends('layouts.app')
@section('title','View Purchase Order')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Purchase Order #{{ $po->id }}
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
			@if ($po->auth_status == App\Enum\AuthStatusEnum::DRAFT->value)
				<a href="{{ route('pos.submit', $po->id) }}" class="btn btn-primary float-end me-2 modal-boolean-advance"
					data-entity="" data-name="PO#{{ $po->id }}" data-status="Submit"
					data-bs-toggle="tooltip" data-bs-placement="top" title="Submit">
					<i data-feather="external-link"></i> Submit</a>
				@endif	
				
				<div class="dropdown me-2 d-inline-block position-relative">
					<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
						<i class="align-middle mt-n1" data-feather="folder"></i> Actions
			  		</a>
					<div class="dropdown-menu dropdown-menu-end">

					<a class="dropdown-item" href="{{ route('reports.po', $po->id) }}"><i class="align-middle me-1" data-feather="printer"></i> Print Purchase Order</a>
					<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="user"></i> Run PO Detail Report*</a>
					<a class="dropdown-item" href="{{ route('pos.history', $po->id) }}"><i class="align-middle me-1" data-feather="layout"></i> View Approval History</a>
					<a class="dropdown-item" href="{{ route('pos.edit', $po->id) }}"><i class="align-middle me-1" data-feather="edit"></i> Edit Purchase Order</a>
					<a class="dropdown-item" href="{{ route('pols.createline', $po->id) }}"><i class="align-middle me-1" data-feather="plus-square"></i> Add Purchase Order Line</a>
					<a class="dropdown-item" href="{{ route('pos.invoice', $po->id) }}"><i class="align-middle me-1" data-feather="layout"></i> View Invoices</a>
					<a class="dropdown-item" href="{{ route('invoices.create', $po->id) }}"><i class="align-middle me-1" data-feather="plus-square"></i> Create Invoice</a>

					<a class="dropdown-item modal-boolean-advance"  href="{{ route('pos.copy', $po->id) }}"
						data-entity="" data-name="PO#{{ $po->id }}" data-status="Duplicate"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Duplicate PO">
						<i class="align-middle me-1" data-feather="copy"></i> Copy Purchase Order</a>
					
					<div class="dropdown-divider"></div>

					<a class="dropdown-item modal-boolean-advance text-danger"  href="{{ route('pos.close', $po->id) }}"
						data-entity="" data-name="PO #{{ $po->id }}" data-status="Force Close"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Force Close">
						<i class="align-middle me-1" data-feather="x"></i> Force Close PO *</a>

					<a class="dropdown-item text-danger" href="{{ route('pos.detach',$po->id) }}"><i class="align-middle me-1" data-feather="trash-2"></i> Delete Attachment</a>

					<a class="dropdown-item modal-boolean-advance text-danger"  href="{{ route('wfs.wf-reset-po', $po->id) }}"
						data-entity="" data-name="PO #{{ $po->id }}" data-status="Reset"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Reset PO"> 
						<i class="align-middle me-1" data-feather="refresh-cw"></i> Reset Workflow**</a>

					<a class="dropdown-item modal-boolean-advance text-danger"  href="{{ route('pos.cancel', $po->id) }}"
						data-entity="" data-name="PO #{{ $po->id }}" data-status="Cancel"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel Purchase Order">
						<i class="align-middle me-1" data-feather="x-circle"></i> Cancel Purchase Order</a>

					<a class="dropdown-item modal-boolean-advance text-danger"  href="{{ route('pos.destroy', $po->id) }}"
						data-entity="" data-name="PR#{{ $po->id }}" data-status="Delete"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Delete Purchase Order">
						<i class="align-middle me-1" data-feather="trash-2"></i> Delete Purchase Order*</a>
				


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

	@include('tenant.includes.modal-boolean-advance')
	  
@endsection

