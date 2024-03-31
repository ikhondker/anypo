@extends('layouts.app')
@section('title','Edit Supplier')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('suppliers.index') }}">Suppliers</a></li>
	<li class="breadcrumb-item"><a href="{{ route('suppliers.show',$supplier->id) }}">{{ $supplier->name }}</a></li>
	<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Supplier
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Supplier"/>
			<x-tenant.buttons.header.create object="Supplier"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('suppliers.update',$supplier->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Edit Supplier</h5>
						<h6 class="card-subtitle text-muted">Edit Suppliers Information.</h6>
					</div>
					<div class="card-body">
						
						<x-tenant.edit.name :value="$supplier->name"/>
						<x-tenant.edit.contact-person value="{{ $supplier->contact_person }}"/>
						<x-tenant.edit.cell :value="$supplier->cell"/>
							<x-tenant.edit.address1 :value="$supplier->address1"/>
								<x-tenant.edit.address2 :value="$supplier->address2"/>
								<div class="row">
									<x-tenant.edit.city :value="$supplier->city"/>
									<x-tenant.edit.state value="{{ $supplier->state }}"/>
									<x-tenant.edit.zip :value="$supplier->zip"/>
								</div>
								<x-tenant.edit.country :value="$supplier->country"/>

						<x-tenant.buttons.show.save/>
					</div>
				</div>
			</div>
			<!-- end col-6 -->
		</div>


	</form>
	<!-- /.form end -->
@endsection

