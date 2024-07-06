@extends('layouts.tenant.app')
@section('title','View Warehouse')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('warehouses.index') }}">Warehouses</a></li>
	<li class="breadcrumb-item active">{{ $warehouse->name }}</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Warehouse
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Warehouse"/>
			<x-tenant.actions.warehouse-actions id="{{ $warehouse->id }}"/>
		@endslot
	</x-tenant.page-header>


	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				<a href="{{ route('warehouses.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i>  View all</a>
				@if (auth()->user()->isSystem())
					<a class="btn btn-sm btn-danger text-white" href="{{ route('warehouses.edit', $warehouse->id) }}"><i class="fas fa-edit"></i> Edit</a>
				 @endif
			</div>
			<h5 class="card-title">Warehouse detail</h5>
			<h6 class="card-subtitle text-muted">Warehouse detail information.</h6>
		</div>
		<div class="card-body">
			<table class="table table-sm my-2">
				<tbody>
					<x-tenant.show.my-text		value="{{ $warehouse->name }}"/>
						<x-tenant.show.my-email		value="{{ $warehouse->contact_person }}" label="Contact Person"/>
						<x-tenant.show.my-text		value="{{ $warehouse->cell }}" label="Cell"/>
						<x-tenant.show.my-boolean	value="{{ $warehouse->enable }}"/>
						<x-tenant.show.my-text 		value="{{ $warehouse->address1 }}" label="Address1"/>
						<x-tenant.show.my-text 		value="{{ $warehouse->address2 }}" label="Address1"/>
						<x-tenant.show.my-text 		value="{{ $warehouse->city.', '.$warehouse->state.', '.$warehouse->zip }}" label="City"/>
						<x-tenant.show.my-text 		value="{{ $warehouse->relCountry->name }}" label="Country"/>
				</tbody>
			</table>
		</div>
	</div>




@endsection

