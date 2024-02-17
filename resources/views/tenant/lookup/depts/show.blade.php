@extends('layouts.app')
@section('title','View Dept')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Dept
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Dept"/>
			<x-tenant.buttons.header.create object="Dept"/>
			<x-tenant.buttons.header.edit object="Dept" :id="$dept->id"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Department Detail</h5>
					<h6 class="card-subtitle text-muted">Department details with Requisition and Purchase Order Approval Hierarchy
						.</h6>
				</div>
				<div class="card-body">
					<x-tenant.show.my-text		value="{{ $dept->name }}"/>
					<x-tenant.show.my-text		value="{{ $dept->prHierarchy->name }}" label="PR Hierarchy"/>
					<x-tenant.show.my-text		value="{{ $dept->poHierarchy->name }}" label="PO Hierarchy"/>
					<x-tenant.show.my-boolean	value="{{ $dept->enable }}"/>
					<x-tenant.show.my-created-at value="{{ $dept->updated_at }}"/>
					<x-tenant.show.my-updated-at value="{{ $dept->created_at }}"/>
					<x-tenant.buttons.show.edit object="Dept" :id="$dept->id"/>
				</div>
			</div>
		</div>
		<!-- end col-6 -->
		<div class="col-6">
			
		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->
@endsection

