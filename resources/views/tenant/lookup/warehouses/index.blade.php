@extends('layouts.tenant.app')
@section('title','Warehouse Lists')
@section('breadcrumb')
	<li class="breadcrumb-item active">Warehouse</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Warehouse
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create model="Warehouse"/>
		@endslot
	</x-tenant.page-header>


	<div class="card">
		<div class="card-header">
			<x-tenant.card.header-search-export-bar model="Warehouse"/>
			<h5 class="card-title">
				@if (request('term'))
					Search result for: <strong class="text-danger">{{ request('term') }}</strong>
				@else
					Warehouses Lists
				@endif
			</h5>
			<h6 class="card-subtitle text-muted">List Warehouses and their contact person</h6>
		</div>
		<div class="card-body">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Contact Person</th>
						<th>Cell</th>
						<th>Enable?</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($warehouses as $warehouse)
					<tr>
						<td>{{ $warehouses->firstItem() + $loop->index }}</td>
						<td><a href="{{ route('warehouses.show',$warehouse->id) }}"><strong>{{ $warehouse->name }}</strong></a></td>
						<td>{{ $warehouse->contact_person }}</td>
						<td>{{ $warehouse->cell }}</td>
						<td><x-tenant.list.my-boolean :value="$warehouse->enable"/></td>
						<td>
							<a href="{{ route('warehouses.show',$warehouse->id) }}" class="btn btn-light"
								data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i data-lucide="eye"></i> View
							</a>

						</td>
					</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row pt-3">
				{{ $warehouses->links() }}
			</div>
			<!-- end pagination -->

		</div>
		<!-- end card-body -->
	</div>
	<!-- end card -->


@endsection

