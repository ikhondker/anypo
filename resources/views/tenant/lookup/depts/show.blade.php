@extends('layouts.tenant.app')
@section('title','View Dept')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('depts.index') }}" class="text-muted">Departments</a></li>
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
				<a class="btn btn-sm btn-light" href="{{ route('depts.edit', $dept->id ) }}"><i class="fas fa-edit"></i> Edit</a>
				<a class="btn btn-sm btn-light" href="{{ route('depts.index') }}" ><i class="fas fa-list"></i> View all</a>
			</div>

			<h5 class="card-title">Department Detail</h5>
			<h6 class="card-subtitle text-muted">Department details with Requisition and Purchase Order Approval Hierarchy.</h6>
		</div>
		<div class="card-body">
			<table class="table table-sm my-2">
				<tbody>
					<x-tenant.show.my-text		value="{{ $dept->name }}"/>
					<tr>
						<th>PR Hierarchy :</th>
						<td><a href="{{ route('hierarchies.show',$dept->pr_hierarchy_id) }}"><strong>{{ $dept->prHierarchy->name }}</strong></a></td>
					</tr>
					<tr>
						<th>PO Hierarchy :</th>
						<td><a href="{{ route('hierarchies.show',$dept->po_hierarchy_id) }}"><strong>{{ $dept->poHierarchy->name }}</strong></a></td>
					</tr>
					<x-tenant.show.my-boolean	value="{{ $dept->enable }}"/>
					<x-tenant.show.my-created-at value="{{ $dept->updated_at }}"/>
					<x-tenant.show.my-updated-at value="{{ $dept->created_at }}"/>
				</tbody>
			</table>
		</div>
	</div>

@endsection

