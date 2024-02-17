@extends('layouts.app')
@section('title','View Receipt')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Receipt
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Receipt"/>
			
			<x-tenant.buttons.header.edit object="Receipt" :id="$receipt->id"/>

				<div class="dropdown me-2 d-inline-block position-relative">
					<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
						<i class="align-middle mt-n1" data-feather="folder"></i> Actions
					</a>
					<div class="dropdown-menu dropdown-menu-end">
						<div class="dropdown-divider"></div>
						<a class="dropdown-item modal-boolean-advance"  href="{{ route('receipts.cancel', $receipt->id) }}"
							data-entity="" data-name="GRN #{{ $receipt->id }}" data-status="Cancel"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel Receipt">
							<i class="align-middle me-1" data-feather="copy"></i> Cancel Receipt</a>
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
					<h6 class="card-subtitle text-muted">List of Goods Receipts.</h6>
				</div>
				<div class="card-body">
					<x-tenant.show.my-text		value="{{ $receipt->id }}" label="GRN#"/>
					<x-tenant.show.my-date		value="{{ $receipt->receive_date }}"/>
					<x-tenant.show.my-text		value="{{ $receipt->warehouse->name }}" label="Warehouse"/>	
					{{-- <x-tenant.show.my-badge		value="{{ $receipt->pol->po_id }}" label="PO#"/> --}}
					<x-tenant.show.my-badge		value="{{ $receipt->pol->line_num }}" label="Line#"/>
					<x-tenant.show.my-text		value="{{ $receipt->pol->summary }}" label="Item"/>	
					<x-tenant.show.my-number	value="{{ $receipt->pol->qty }}" label="Ord Qty" />	
					<x-tenant.show.my-number	value="{{ $receipt->qty }}" label="Rcv Qty" />
					<x-tenant.show.my-text		value="{{ $receipt->receiver->name }}" label="Receiver"/>	
					<x-tenant.show.my-badge		value="{{ $receipt->status }}" label="Status"/>
					<x-tenant.show.my-text		value="{{ $receipt->notes }}"/>
					<x-tenant.show.my-created-at value="{{ $receipt->updated_at }}"/>
					<x-tenant.show.my-updated-at value="{{ $receipt->created_at }}"/>
						
		
				</div>
			</div>
		</div>
	</div>
	<!-- end row -->

	@include('tenant.includes.modal-boolean-advance')
@endsection

