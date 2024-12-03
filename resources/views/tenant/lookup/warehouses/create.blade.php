@extends('layouts.tenant.app')
@section('title','Warehouse')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('warehouses.index') }}" class="text-muted">Warehouses</a></li>
	<li class="breadcrumb-item active">Create</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Warehouse
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists model="Warehouse"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('warehouses.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('warehouses.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
				</div>
				<h5 class="card-title">Create new Warehouse</h5>
				<h6 class="card-subtitle text-muted">Create new Warehouse detail and contact person</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<x-tenant.create.name/>
						<x-tenant.create.contact-person/>
						<x-tenant.create.cell/>
						<x-tenant.create.address1/>
						<x-tenant.create.address2/>
						<x-tenant.create.city-state-zip/>
						<x-tenant.create.country/>
						<x-tenant.create.save/>
					</tbody>
				</table>
			</div>
		</div>

	</form>
	<!-- /.form end -->

@endsection
