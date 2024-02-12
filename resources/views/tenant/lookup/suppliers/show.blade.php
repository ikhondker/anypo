@extends('layouts.app')
@section('title','View Supplier')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Supplier
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Supplier"/>
			<x-tenant.buttons.header.create object="Supplier"/>
			<x-tenant.buttons.header.edit object="Supplier" :id="$supplier->id"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Supplier Detail</h5>
					<h6 class="card-subtitle text-muted">Supplier detail information.</h6>
				</div>
				<div class="card-body">
					<x-tenant.show.my-text		value="{{ $supplier->name }}"/>
					<x-tenant.show.my-text		value="{{ $supplier->contact_person }}" label="Contact Person"/>
					<x-tenant.show.my-text		value="{{ $supplier->cell }}" label="Cell"/>
					<x-tenant.show.my-email		value="{{ $supplier->email }}"/>
					<x-tenant.show.my-url		value="{{ $supplier->website }}"/>

					<x-tenant.show.my-text value="{{ $supplier->address1 }}" label="Address1"/>
					<x-tenant.show.my-text value="{{ $supplier->address2 }}" label="Address2"/>
					<x-tenant.show.my-text value="{{ $supplier->city.', '.$supplier->state.', '.$supplier->zip  }}" label="City"/>
					<x-tenant.show.my-text value="{{ $supplier->relCountry->name }}" label="Country"/>
					<x-tenant.show.my-boolean	value="{{ $supplier->enable }}"/>
					<x-tenant.buttons.show.edit object="Supplier" :id="$supplier->id"/>
				</div>
			</div>
		</div>
		<!-- end col-6 -->
	
	</div>
	<!-- end row -->


@endsection

