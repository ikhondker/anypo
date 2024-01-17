@extends('layouts.app')
@section('title','Purchase Orders')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Purchase Orders
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="Po"/>
		@endslot
	</x-tenant.page-header>

	{{-- <x-tenant.widgets.pr-counts/> --}}

	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="Po"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Purchase Order Lists
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout header-with-simple-search.</h6>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>PR#</th>
								<th>Summary</th>
								<th>Date</th>
								<th>Requestor</th>
								<th>Dept</th>
								<th>Currency</th>
								<th class="text-end">Amount</th>
								<th>Approval</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($pos as $po)
							<tr>
								<td>{{ $po->id }}</td>
								<td><a class="text-info" href="{{ route('pos.show',$po->id) }}">{{ $po->summary }}</a></td>
								<td><x-tenant.list.my-date :value="$po->po_date"/></td>
								<td>{{ $po->requestor->name }}</td>
								<td>{{ $po->relDept->name }}</td>
								<td>{{ $po->currency }}</td>
								<td class="text-end"><x-tenant.list.my-number :value="$po->amount"/></td>
								<td><x-tenant.list.my-badge :value="$po->auth_status"/></td>
								<td><x-tenant.list.my-badge :value="$po->status"/></td>
								<td class="table-action">
									<x-tenant.list.actions object="Po" :id="$po->id"/>
									<a href="{{ route('payments.create-for-po',$po->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Payment">
										<i class="align-middle" data-feather="dollar-sign"></i></a>
									<a href="{{ route('pos.destroy', $po->id) }}" class="me-2 modal-boolean-advance"
										data-entity="Po" data-name="{{ $po->id }}" data-status="Delete"
										data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
										<i class="align-middle text-muted" data-feather="trash-2"></i>
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

	 @include('tenant.includes.modal-boolean-advance')

@endsection

