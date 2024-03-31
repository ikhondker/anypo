@extends('layouts.app')
@section('title','Supplier')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('suppliers.index') }}">Suppliers</a></li>
	<li class="breadcrumb-item active">Create</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Supplier
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Supplier"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('suppliers.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
					<h5 class="card-title">Create Supplier</h5>
					<h6 class="card-subtitle text-muted">Create New Suppliers.</h6>
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
			<!-- end col-6 -->
		</div>
		<!-- end row -->

	</form>
	<!-- /.form end -->

@endsection