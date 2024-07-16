@extends('layouts.tenant.app')
@section('title','Edit Warehouse')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('warehouses.index') }}">Warehouses</a></li>
	<li class="breadcrumb-item"><a href="{{ route('warehouses.show',$warehouse->id) }}">{{ $warehouse->name }}</a></li>
	<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Warehouse
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Warehouse"/>
			<x-tenant.actions.lookup.warehouse-actions id="{{ $warehouse->id }}"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('warehouses.update',$warehouse->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')


		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('warehouses.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i>  View all</a>
				</div>
				<h5 class="card-title">Edit Warehouse</h5>
							<h6 class="card-subtitle text-muted">Edit Warehouse detail and contact person</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<x-tenant.edit.name value="{{ $warehouse->name }}"/>
                        <x-tenant.edit.contact-person value="{{ $warehouse->contact_person }}"/>
                        <x-tenant.edit.cell value=" {{ $warehouse->cell }}"/>
                        <x-tenant.edit.address1 value="{{ $warehouse->address1 }}"/>
                        <x-tenant.edit.address2 value="{{ $warehouse->address2 }}"/>
                        <x-tenant.edit.city-state-zip city="{{ $warehouse->city }}" state="{{ $warehouse->state }}" zip="{{ $warehouse->zip }}"/>
                        <x-tenant.edit.country :value="$warehouse->country"/>
                        <x-tenant.buttons.show.save/>
					</tbody>
				</table>
			</div>
		</div>




	</form>
	<!-- /.form end -->

@endsection

