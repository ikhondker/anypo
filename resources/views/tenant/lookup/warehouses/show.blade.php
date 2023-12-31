@extends('layouts.app')
@section('title','View Warehouse')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Warehouse
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Warehouse"/>
			<x-tenant.buttons.header.create object="Warehouse"/>
			<x-tenant.buttons.header.edit object="Warehouse" :id="$warehouse->id"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Warehouse Info</h5>
				</div>
				<div class="card-body">
					<x-tenant.show.my-text     value="{{ $warehouse->name }}"/>
					<x-tenant.show.my-email    value="{{ $warehouse->contact_person }}" label="Contact Person"/>    
					<x-tenant.show.my-text     value="{{ $warehouse->cell }}" label="Cell"/>
					<x-tenant.show.my-badge    value="{{ $warehouse->id }}"/>
					<x-tenant.show.my-boolean  value="{{ $warehouse->enable }}"/>
				</div>
			</div>
		</div>
		<!-- end col-6 -->
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Supporting Info</h5>
				</div>
				<div class="card-body">
					<x-tenant.show.my-text value="{{ $warehouse->address1 }}" label="Address1"/>
					<x-tenant.show.my-text value="{{ $warehouse->address2 }}" label="Address1"/>
					<x-tenant.show.my-text value="{{ $warehouse->city.', '.$warehouse->state.', '.$warehouse->zip  }}" label="City"/>    
					<x-tenant.show.my-text value="{{ $warehouse->relCountry->name }}" label="Country"/>
				</div>
			</div>
		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->


@endsection

