@extends('layouts.app')
@section('title','Supplier')
@section('breadcrumb','Create Supplier')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Supplier
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.save/>
			<x-tenant.buttons.header.lists object="Supplier"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('suppliers.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header">
					<h5 class="card-title">Supplier Info</h5>
					</div>
					<div class="card-body">
						<x-tenant.create.name/>
						<x-tenant.create.contact-person/>
						<x-tenant.create.cell/>
						<x-tenant.widgets.submit/>
					</div>
				</div>
			</div>
			<!-- end col-6 -->
			<div class="col-6">
				<div class="card">
					<div class="card-header">
					<h5 class="card-title">Warehouse Info</h5>
					</div>
					<div class="card-body">
						<x-tenant.create.address1/>
						<x-tenant.create.address2/>
						<div class="row">
							<x-tenant.create.city/>
							<x-tenant.create.state/>
							<x-tenant.create.zip/>
						</div>
						<x-tenant.create.country/>
						<x-tenant.widgets.submit/>
					</div>
				</div>
			</div>
			<!-- end col-6 -->
		</div>
		<!-- end row -->

	</form>
	<!-- /.form end -->

@endsection