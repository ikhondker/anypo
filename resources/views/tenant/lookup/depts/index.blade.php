@extends('layouts.tenant.app')
@section('title','Dept')

@section('breadcrumb')
	<li class="breadcrumb-item active">Departments</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Department Lists
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create model="Dept"/>
		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">
			<x-tenant.card.header-search-export-bar model="Dept"/>
			<h5 class="card-title">
				@if (request('term'))
					Search result for: <strong class="text-info">{{ request('term') }}</strong>
				@else
					Department Lists
				@endif
			</h5>
			<h6 class="card-subtitle text-muted">List of departments with Requisition and Purchase Order Approval Hierarchy</h6>
		</div>
		<div class="card-body">
			<table class="table w-100">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>PR Hierarchy</th>
						<th>PO Hierarchy</th>
						<th>Enable?</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($depts as $dept)
					<tr>
						<td>{{ $depts->firstItem() + $loop->index }}</td>
						<td><a href="{{ route('depts.show',$dept->id) }}"><strong>{{ $dept->name }}</strong></a></td>
						<td><a href="{{ route('hierarchies.show',$dept->pr_hierarchy_id) }}"><strong>{{ $dept->prHierarchy->name }}</strong></a></td>
						<td><a href="{{ route('hierarchies.show',$dept->po_hierarchy_id) }}"><strong>{{ $dept->poHierarchy->name }}</strong></a></td>
						<td><x-tenant.list.my-boolean :value="$dept->enable"/></td>
						<td>
							<a href="{{ route('depts.show',$dept->id) }}" class="btn btn-light"
								data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i data-lucide="eye"></i> View
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row pt-3">
				{{ $depts->links() }}
			</div>
			<!-- end pagination -->

		</div>
		<!-- end card-body -->
	</div>
	<!-- end card -->

@endsection

