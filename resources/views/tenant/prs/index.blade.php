@extends('layouts.app')
@section('title','Pr')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Pr
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="Pr"/>
		@endslot
	</x-tenant.page-header>

	<x-tenant.widgets.pr-counts/>

	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="Pr"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Requisition  Lists
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
							@foreach ($prs as $pr)
							<tr>
								<td>{{ $pr->id }}</td>
								<td><a class="text-info" href="{{ route('prs.show',$pr->id) }}">{{ $pr->summary }}</a></td>
								<td><x-tenant.list.my-date :value="$pr->pr_date"/></td>
								<td>{{ $pr->relRequestor->name }}</td>
								<td>{{ $pr->relDept->name }}</td>
								<td>{{ $pr->currency }}</td>
								<td class="text-end"><x-tenant.list.my-number :value="$pr->amount"/></td>
								<td><x-tenant.list.my-badge :value="$pr->auth_status"/></td>
								<td><x-tenant.list.my-badge :value="$pr->status"/></td>
								<td class="table-action">
									<x-tenant.list.actions object="Pr" :id="$pr->id"/>
									<a href="{{ route('prs.destroy', $pr->id) }}" class="me-2 modal-boolean-advance"
										data-entity="Pr" data-name="{{ $pr->id }}" data-status="Delete"
										data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
										<i class="align-middle text-muted" data-feather="trash-2"></i>
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					<div class="row pt-3">
						{{ $prs->links() }}
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

