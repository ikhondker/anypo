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

				<div class="dropdown me-2 d-inline-block position-relative">
					<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
						<i class="align-middle mt-n1" data-feather="folder"></i> Actions
					</a>
					<div class="dropdown-menu dropdown-menu-end">
						<a class="dropdown-item" href="{{ route('invoices.edit', $pol->id) }}"><i class="align-middle me-1" data-feather="user"></i> Edit</a>
						<a class="dropdown-item" href="{{ route('receipts.create',$pol->id) }}"><i class="align-middle me-1" data-feather="user"></i> Create Receipts</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item modal-boolean-advance"  href="{{ route('invoices.cancel', $pol->id) }}"
							data-entity="" data-name="Invoice #{{ $pol->id }}" data-status="Cancel"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel Payment">
							<i class="align-middle me-1" data-feather="copy"></i> Cancel pol</a>
					</div>
				</div>

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

