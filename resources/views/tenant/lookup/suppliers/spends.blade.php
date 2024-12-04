@extends('layouts.tenant.app')
@section('title','Supplier Spends')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('suppliers.index') }}" class="text-muted">Suppliers</a></li>
	<li class="breadcrumb-item active">Supplier Spends</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Supplier Spends
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists model="Supplier"/>
			<x-tenant.buttons.header.create model="Supplier"/>
		@endslot
	</x-tenant.page-header>


	<x-tenant.dashboards.supplier-counts/>


	<div class="row">
		<x-tenant.charts.spends-by-supplier-bar/>
		<x-tenant.charts.spends-by-supplier-count-bar/>
	</div>

	<div class="card">
		<div class="card-header">
			<x-tenant.card.header-search-export-bar model="Supplier"/>
			<h5 class="card-title">
				@if (request('term'))
					Search result for: <strong class="text-danger">{{ request('term') }}</strong>
				@else
					Supplier Spends
				@endif
			</h5>
			<h6 class="card-subtitle text-muted">List of suppliers and budget usages.</h6>
		</div>
		<div class="card-body">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th class="text-end">PR</th>
						<th class="text-end">PO</th>
						<th class="text-end">GRS</th>
						<th class="text-end">Invoice</th>
						<th class="text-end">Payment</th>
						<th>Active?</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($suppliers as $supplier)
					<tr>
						<td>{{ $suppliers->firstItem() + $loop->index }}</td>
						<td><a href="{{ route('suppliers.po',$supplier->id) }}"><strong>{{ $supplier->name }}</strong></a></td>
						<td class="text-end"><x-tenant.list.my-number :value="$supplier->amount_pr_booked + $supplier->amount_pr"/></td>
						<td class="text-end"><x-tenant.list.my-number :value="$supplier->amount_po_booked + $supplier->amount_po"/></td>
						<td class="text-end"><x-tenant.list.my-number :value="$supplier->amount_grs"/></td>
						<td class="text-end"><x-tenant.list.my-number :value="$supplier->amount_invoice"/></td>
						<td class="text-end"><x-tenant.list.my-number :value="$supplier->amount_payment"/></td>
						<td><x-tenant.list.my-boolean :value="$supplier->enable"/></td>
						<td>
							<a href="{{ route('suppliers.show',$supplier->id) }}" class="btn btn-light"
								data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i data-lucide="eye"></i> View
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

