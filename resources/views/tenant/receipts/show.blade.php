@extends('layouts.app')
@section('title','View Receipt')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('receipts.index') }}">Receipts TODO</a></li>
	<li class="breadcrumb-item"><a href="{{ route('receipts.index') }}">TODO POL</a></li>
	<li class="breadcrumb-item active">Receipt</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Receipt
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Receipt"/>
			<x-tenant.buttons.header.lists object="Po" label="Purchase Order"/>
			<x-tenant.actions.receipt-actions id="{{ $receipt->id }}"/>
				
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

	@include('tenant.includes.js.sweet-alert2-advance')
@endsection

