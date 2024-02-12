@extends('layouts.app')
@section('title','Edit Warehouse')
@section('breadcrumb','Edit Warehouse')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Warehouse
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Warehouse"/>
			<x-tenant.buttons.header.create object="Warehouse"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('warehouses.update',$warehouse->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Edit Warehouse</h5>
							<h6 class="card-subtitle text-muted">Edit Warehouse detail and contact person</h6>
						</div>
						<div class="card-body">
							<x-tenant.edit.name :value="$warehouse->name"/>
							<x-tenant.edit.contact-person value="{{ $warehouse->contact_person }}"/>
							<x-tenant.edit.cell value=" {{ $warehouse->cell }}"/>
							<x-tenant.edit.address1 :value="$warehouse->address1"/>
							<x-tenant.edit.address2 :value="$warehouse->address2"/>
							<div class="row">
								<x-tenant.edit.city :value="$warehouse->city"/>
								<x-tenant.edit.state value="{{ $warehouse->state }}"/>
								<x-tenant.edit.zip :value="$warehouse->zip"/>
							</div>
							<x-tenant.edit.country :value="$warehouse->country"/>
							<x-tenant.buttons.show.save/>
						</div>
					</div>
				</div>
				<!-- end col-6 -->

			</div>


	</form>
	<!-- /.form end -->
@endsection

