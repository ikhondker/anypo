@extends('layouts.app')
@section('title','View Receipt')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Receipt
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Receipt"/>
			<x-tenant.buttons.header.create object="Receipt"/>
			<x-tenant.buttons.header.edit object="Receipt" :id="$receipt->id"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Receipt Info</h5>
				</div>
				<div class="card-body">
					<x-tenant.show.my-text		value="{{ $receipt->id }}"/>
					<x-tenant.show.my-date		value="{{ $receipt->receive_date }}"/>
					<x-tenant.show.my-text		value="{{ $receipt->warehouse->name }}" label="Warehouse"/>	
					<x-tenant.show.my-badge		value="{{ $receipt->pol->po_id }}" label="PO#"/>
					<x-tenant.show.my-badge		value="{{ $receipt->pol->line_num }}" label="Line#"/>
					<x-tenant.show.my-text		value="{{ $receipt->pol->summary }}" label="Item"/>	
					<x-tenant.show.my-number	value="{{ $receipt->pol->qty }}" label="Ord Qty" />	
					<x-tenant.show.my-number	value="{{ $receipt->qty }}" label="Rcv Qty" />
					<x-tenant.show.my-text		value="{{ $receipt->receiver->name }}" label="Receiver"/>	
					<x-tenant.show.my-badge		value="{{ $receipt->status }}" label="Status"/>
					<x-tenant.show.my-text		value="{{ $receipt->notes }}"/>
				</div>
			</div>
		</div>
		<!-- end col-6 -->
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Supporting Info</h5>
				</div>
				<div class="card-body">
					<x-tenant.show.my-date-time value="{{$receipt->created_at }}" label="Created At"/>
					<x-tenant.show.my-date-time value="{{$receipt->updated_at }}" label="Updated At"/>
				</div>
			</div>
		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->

@endsection

