@extends('layouts.app')
@section('title','View Purchase Order Lines')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Purchase Order Lines
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Pol"/>
			<x-tenant.buttons.header.create object="Pol"/>
			<x-tenant.buttons.header.edit object="Pol" :id="$pol->id"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Purchase Order Lines Info</h5>
				</div>
				<div class="card-body">
					<x-tenant.show.my-text		value="{{ $pol->line_num }}"/>
					<x-tenant.show.my-text		value="{{ $pol->item->name }}" label="Item"/>
					<x-tenant.show.my-text		value="{{ $pol->uom->name }}" label="UoM"/>
					<x-tenant.show.my-amount		value="{{  $pol->qty}}" label="Qty"/>
					<x-tenant.show.my-amount		value="{{  $pol->price}}" label="price"/>
					<x-tenant.show.my-amount		value="{{  $pol->amount}}" label="Qty"/>
					<x-tenant.show.my-amount		value="{{  $pol->received_qty}}" label="Received"/>
					<x-tenant.show.my-boolean	value="{{ $pol->enable }}"/>
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
					<x-tenant.show.my-date-time value="{{ $pol->created_at }}" label="Created At"/>
					<x-tenant.show.my-date-time value="{{ $pol->updated_at }}" label="Updated At"/>
				</div>
			</div>
		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->


	<x-tenant.widgets.po-line-receipts :id="$pol->id" />

@endsection

