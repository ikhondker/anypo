@extends('layouts.app')
@section('title','View Purchase Order Lines')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('pos.index') }}">Purchase Orders</a></li>
	<li class="breadcrumb-item"><a href="{{ route('pos.show',$pol->po_id) }}">PO #{{ $pol->po_id }}</a></li>
	<li class="breadcrumb-item active">Line #{{ $pol->line_num }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Purchase Order Lines
		@endslot
		@slot('buttons')

		<x-tenant.buttons.header.lists object="Po" label="Purchase Order"/>
		<x-tenant.actions.pol-actions id="{{ $pol->id }}"/>
			
		@endslot
	</x-tenant.page-header>


	<x-tenant.info.po-info id="{{ $pol->po_id }}"/>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Purchase Order Lines</h5>
					<h6 class="card-subtitle text-muted">Details of Purchase Order Lines.</h6>
				</div>
				<div class="card-body">
					<x-tenant.show.my-text		value="{{ $pol->line_num }}" label="Line #"/>
					<x-tenant.show.my-text		value="{{ $pol->item->name }}" label="Item"/>
					<x-tenant.show.my-text		value="{{ $pol->uom->name }}" label="UoM"/>
					<x-tenant.show.my-amount	value="{{  $pol->qty}}" label="Qty"/>
					<x-tenant.show.my-amount	value="{{  $pol->price}}" label="price"/>
					<x-tenant.show.my-amount	value="{{  $pol->amount}}" label="Qty"/>
					<x-tenant.show.my-amount	value="{{  $pol->received_qty}}" label="Received"/>
					<x-tenant.show.my-created-at value="{{ $pol->updated_at }}"/>
					<x-tenant.show.my-updated-at value="{{ $pol->created_at }}"/>
	
				</div>
			</div>
		</div>
		
		<!-- end col-6 -->
	</div>
	<!-- end row -->


	<x-tenant.widgets.pol.pol-receipts :id="$pol->id" />

@endsection

