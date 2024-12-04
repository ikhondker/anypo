@extends('layouts.tenant.app')
@section('title','View Supplier')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('suppliers.index') }}" class="text-muted">Suppliers</a></li>
	<li class="breadcrumb-item active">{{ $supplier->name }}</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Supplier
		@endslot
		@slot('buttons')
			<x-tenant.actions.lookup.supplier-actions supplierId="{{ $supplier->id }}"/>
		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				@can('update', $supplier)
					<a class="btn btn-sm btn-light" href="{{ route('suppliers.edit', $supplier->id ) }}"><i data-lucide="edit"></i> Edit</a>
				@endcan
				<a class="btn btn-sm btn-light" href="{{ route('suppliers.index') }}" ><i class="fas fa-list"></i> View all</a>
			</div>
			<h5 class="card-title">Supplier Detail</h5>
					<h6 class="card-subtitle text-muted">Supplier detail Information.</h6>
		</div>
		<div class="card-body">
			<table class="table table-sm my-2">
				<tbody>
					<x-tenant.show.my-text		value="{{ $supplier->name }}"/>
					<x-tenant.show.my-text		value="{{ $supplier->contact_person }}" label="Contact Person"/>
					<x-tenant.show.my-text		value="{{ $supplier->cell }}" label="Cell"/>
					<x-tenant.show.my-email		value="{{ $supplier->email }}"/>
					<x-tenant.show.my-url		value="{{ $supplier->website }}"/>

					<x-tenant.show.my-text value="{{ $supplier->address1 }}" label="Address1"/>
					<x-tenant.show.my-text value="{{ $supplier->address2 }}" label="Address2"/>
					<x-tenant.show.my-text value="{{ $supplier->city.', '.$supplier->state.', '.$supplier->zip }}" label="City"/>
					<x-tenant.show.my-text value="{{ $supplier->relCountry->name }}" label="Country"/>
					<x-tenant.show.my-boolean	value="{{ $supplier->enable }}"/>
					<x-tenant.show.my-date-time value="{{ $supplier->created_at }}" label="Created At" />
				</tbody>
			</table>
		</div>
	</div>

@endsection

