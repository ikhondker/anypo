@extends('layouts.app')
@section('title','View Receipt')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Receipt
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Receipt"/>
			<div class="dropdown me-2 d-inline-block position-relative">
				<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
					<i class="align-middle mt-n1" data-feather="folder"></i> Actions
				</a>
				<div class="dropdown-menu dropdown-menu-end">
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="{{ route('receipts.create',  $receipt->pol->id) }}"><i class="align-middle me-1" data-feather="layout"></i> Create Another Receipt</a>
					<a class="dropdown-item" href="{{ route('pos.show',  $receipt->pol->po_id) }}"><i class="align-middle me-1" data-feather="layout"></i> View Purchase Order</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item modal-boolean-advance text-danger"  href="{{ route('receipts.cancel', $receipt->id) }}"
						data-entity="" data-name="GRN #{{ $receipt->id }}" data-status="Cancel"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel Receipt">
						<i class="align-middle me-1" data-feather="x-circle"></i> Cancel Receipt</a>
				</div>
			</div>
		@endslot
	</x-tenant.page-header>


	{{-- <x-tenant.info.pol-info id="{{ $receipt->pol_id }}"/> --}}

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Goods Receipt Information</h5>
					<h6 class="card-subtitle text-muted">List of Goods Receipts.11</h6>
				</div>
				<div class="card-body">
					<div class="row mb-3">
						<div class="col-sm-3 text-end">
							<span class="h6 text-secondary">PO #:</span>
						</div>
						<div class="col-sm-9">
							{{ "#". $receipt->pol->po_id. " - ". $receipt->pol->po->summary }}
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-sm-3 text-end">
							<span class="h6 text-secondary">Line #:</span>
						</div>
						<div class="col-sm-9">
							{{ "#". $receipt->pol->line_num. " - ". $receipt->pol->summary }}
						</div>
					</div>
					<x-tenant.show.my-number	value="{{ $receipt->pol->qty }}" label="Ord Qty" />	
					<x-tenant.show.my-badge		value="{{ $receipt->id }}" label="GRN#"/>
					<x-tenant.show.my-date		value="{{ $receipt->receive_date }}"/>
					<x-tenant.show.my-number	value="{{ $receipt->qty }}" label="Rcv Qty" />
					<x-tenant.show.my-text		value="{{ $receipt->warehouse->name }}" label="Warehouse"/>	
					<x-tenant.show.my-text		value="{{ $receipt->receiver->name }}" label="Receiver"/>	
					<x-tenant.show.my-badge		value="{{ $receipt->status }}" label="Status"/>
					<x-tenant.show.my-text		value="{{ $receipt->notes }}" label="Notes"/>
					<div class="row mb-3">
						<div class="col-sm-3 text-end">
							<span class="h6 text-secondary">Attachments:</span>
						</div>
						<div class="col-sm-9">
							<x-tenant.attachment.all entity="RECEIPT" aid="{{ $receipt->id }}"/>
						</div>
					</div>
		
				</div>
			</div>
		</div>
	</div>
	<!-- end row -->

	@include('tenant.includes.modal-boolean-advance')
@endsection

