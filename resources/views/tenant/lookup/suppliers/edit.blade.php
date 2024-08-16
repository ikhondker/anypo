@extends('layouts.tenant.app')
@section('title','Edit Supplier')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('suppliers.index') }}" class="text-muted">Suppliers</a></li>
	<li class="breadcrumb-item"><a href="{{ route('suppliers.show',$supplier->id) }}" class="text-muted">{{ $supplier->name }}</a></li>
	<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Supplier
		@endslot
		@slot('buttons')
			<x-tenant.actions.lookup.supplier-actions id="{{ $supplier->id }}"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('suppliers.update',$supplier->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('suppliers.create') }}" class="btn btn-sm btn-light"><i class="fas fa-plus"></i> Create</a>
					<a href="{{ route('suppliers.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
				</div>
				<h5 class="card-title">Edit Supplier</h5>
				<h6 class="card-subtitle text-muted">Edit Suppliers Information.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>

						<x-tenant.edit.name value="{{ $supplier->name }}"/>
						<x-tenant.edit.contact-person value="{{ $supplier->contact_person }}"/>
						<x-tenant.edit.cell value="{{ $supplier->cell }}"/>
						<x-tenant.edit.email value="{{ $supplier->email }}"/>
						<x-tenant.edit.website value="{{ $supplier->website }}"/>
						<x-tenant.edit.address1 value="{{ $supplier->address1 }}"/>
						<x-tenant.edit.address2 value="{{ $supplier->address2 }}"/>
						<x-tenant.edit.city-state-zip city="{{ $supplier->city }}" state="{{ $supplier->state }}" zip="{{ $supplier->zip }}"/>
						<x-tenant.edit.country :value="$supplier->country"/>
                        <x-tenant.edit.save/>
					</tbody>
				</table>
			</div>
		</div>


	</form>
	<!-- /.form end -->

@endsection

