@extends('layouts.app')
@section('title','Warehouse')
@section('breadcrumb','Create Warehouse')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Warehouse
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Warehouse"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('warehouses.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Create new Warehouse</h5>
						<h6 class="card-subtitle text-muted">Create new Warehouse detail and contact person</h6>
					</div>
					<div class="card-body">
						<x-tenant.create.name/>
						<x-tenant.create.contact-person/>
						<x-tenant.create.cell/>
						<x-tenant.create.address1/>
						<x-tenant.create.address2/>
						<div class="row">
							<x-tenant.create.city/>
							<x-tenant.create.state/>
							<x-tenant.create.zip/>
						</div>
						<x-tenant.create.country/>
						<x-tenant.buttons.show.save/>
					</div>
				</div>
			</div>
			<!-- end col-6 -->
		</div>
		<!-- end row -->

	</form>
	<!-- /.form end -->

@endsection