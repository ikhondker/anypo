@extends('layouts.tenant.app')
@section('title','Purchase Orders')
@section('breadcrumb')
	<li class="breadcrumb-item active">Purchase Orders</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			Purchase Orders
		@endslot
		@slot('buttons')
            {{Route::current()->getName()}}
			<x-tenant.buttons.header.create object="Po" label="Purchase Order"/>
			<x-tenant.actions.po-actions-index/>
		@endslot
	</x-tenant.page-header>

	<x-tenant.dashboards.po-counts/>

	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="Po"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							My Purchase Order Lists
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">List of Purchase Orders.</h6>
				</div>
				<div class="card-body">

					<table class="table">
						<thead>
							<tr>
								<th>PO#</th>
								<th>Summary</th>
								<th>Date</th>
								<th>Dept</th>
								<th>Currency</th>
								<th class="text-end">PO Amount</th>
								<th class="text-end">GRS Amount</th>
								<th class="text-end">Invoice Amount</th>
								<th class="text-end">Paid Amount</th>
								<th>Approval</th>
								<th>Status</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($pos as $po)
							<tr>
								<td>{{ $po->id }}</td>
								<td><a class="text-info" href="{{ route('pos.show',$po->id) }}">{{ $po->summary }}</a></td>
								<td><x-tenant.list.my-date :value="$po->po_date"/></td>
								<td>{{ $po->dept->name }}</td>
								<td>{{ $po->currency }}</td>
								<td class="text-end"><x-tenant.list.my-number :value="$po->amount"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$po->amount_grs"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$po->amount_invoice"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$po->amount_paid"/></td>

								<td><span class="badge {{ $po->auth_status_badge->badge }}">{{ $po->auth_status_badge->name}}</span></td>
								<td><span class="badge {{ $po->status_badge->badge }}">{{ $po->status_badge->name}}</span></td>
								<td class="table-action">
									<a href="{{ route('pos.show',$po->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
										<i class="align-middle" data-lucide="eye"></i></a>

									<a href="{{ route('reports.po',$po->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Print">
											<i class="align-middle" data-lucide="printer"></i></a>

									<a href="{{ route('pos.invoice',$po->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Invoices">
										<i class="align-middle" data-lucide="layout"></i></a>
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					<div class="row pt-3">
						{{ $pos->links() }}
					</div>
					<!-- end pagination -->

				</div>
				<!-- end card-body -->
			</div>
			<!-- end card -->

		</div>
		 <!-- end col -->
	</div>
	 <!-- end row -->



@endsection

