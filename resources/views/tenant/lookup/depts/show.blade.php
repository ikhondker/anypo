@extends('layouts.tenant.app')
@section('title','View Dept')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('depts.index') }}">Departments</a></li>
	<li class="breadcrumb-item active">{{ $dept->name }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Dept
		@endslot
		@slot('buttons')
			<x-tenant.actions.lookup.dept-actions id="{{ $dept->id }}"/>
		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				<a href="{{ route('depts.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i>  View all</a>
			</div>
			<h5 class="card-title">Department Detail</h5>
			<h6 class="card-subtitle text-muted">Department details with Requisition and Purchase Order Approval Hierarchy.</h6>
		</div>
		<div class="card-body">
			<table class="table table-sm my-2">
				<tbody>
					<x-tenant.show.my-text		value="{{ $dept->name }}"/>
						<x-tenant.show.my-text		value="{{ $dept->prHierarchy->name }}" label="PR Hierarchy"/>
						<x-tenant.show.my-text		value="{{ $dept->poHierarchy->name }}" label="PO Hierarchy"/>
						<x-tenant.show.my-boolean	value="{{ $dept->enable }}"/>
						<x-tenant.show.my-created-at value="{{ $dept->updated_at }}"/>
						<x-tenant.show.my-updated-at value="{{ $dept->created_at }}"/>


				</tbody>
			</table>
		</div>
	</div>

@endsection

