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
 			@can('create', App\Models\Tenant\Lookup\Supplier::class)
				<x-tenant.buttons.header.create model="Supplier"/>
			@endcan
			<x-tenant.actions.lookup.supplier-actions supplierId="{{ $supplier->id }}"/>
		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				@can('update', $supplier)
					<a class="btn btn-sm btn-light" href="{{ route('suppliers.edit', $supplier->id ) }}"><i data-lucide="edit"></i> Edit</a>
				@endcan
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

					<tr>
						<th>Attachments :</th>
						<td>
							<x-tenant.attachment.all entity="{{ EntityEnum::SUPPLIER->value }}" articleId="{{ $supplier->id }}"/>
						</td>
					</tr>
					<tr>
						<th>&nbsp;</th>
						<td>
							@can('update', $supplier)
								<x-tenant.attachment.add entity="{{ EntityEnum::SUPPLIER->value }}" articleId="{{ $supplier->id }}"/>
							@endcan
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<x-tenant.widgets.back-to-list model="Supplier"/>

@endsection

