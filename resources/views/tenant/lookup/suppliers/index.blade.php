@extends('layouts.tenant.app')
@section('title','Supplier Master')
@section('breadcrumb')
	<li class="breadcrumb-item active">Supplier Master</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
		Suppliers
		@endslot
		@slot('buttons')
			@can('create', App\Models\Tenant\Lookup\Supplier::class)
				<x-tenant.buttons.header.create object="Supplier"/>
			@endcan
			@can('spends', App\Models\Tenant\Lookup\Supplier::class)
				<a href="{{ route('suppliers.spends') }}" class="btn btn-primary float-end me-2"><i data-lucide="pie-chart"></i> Supplier Spends</a>
			@endcan
		@endslot
	</x-tenant.page-header>


	<x-tenant.dashboards.supplier-counts/>

	<div class="card">
		<div class="card-header">
			<x-tenant.card.header-search-export-bar object="Supplier"/>
			<h5 class="card-title">
				@if (request('term'))
					Search result for: <strong class="text-danger">{{ request('term') }}</strong>
				@else
					Supplier Lists
				@endif
			</h5>
			<h6 class="card-subtitle text-muted">List of Suppliers and their contact person.</h6>
		</div>
		<div class="card-body">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Contact Person</th>
						<th>Cell</th>
						<th>Enable</th>
						<th>View</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($suppliers as $supplier)
					<tr>
						<td>{{ $suppliers->firstItem() + $loop->index }}</td>
						<td><a href="{{ route('suppliers.show',$supplier->id) }}"><strong>{{ $supplier->name }}</strong></a></td>
						<td>{{ $supplier->contact_person }}</td>
						<td>{{ $supplier->cell }}</td>
						<td><x-tenant.list.my-boolean :value="$supplier->enable"/></td>
						<td class="table-action">
							<a href="{{ route('suppliers.show',$supplier->id) }}" class="btn btn-light"
								data-bs-toggle="tooltip" data-bs-placement="top" title="View">View
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row pt-3">
				{{ $suppliers->links() }}
			</div>
			<!-- end pagination -->

		</div>
		<!-- end card-body -->
	</div>
	<!-- end card -->

@endsection

