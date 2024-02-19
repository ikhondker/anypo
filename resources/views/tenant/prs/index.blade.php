@extends('layouts.app')
@section('title','Purchase Requisitions')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Purchase Requisitions
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="Pr"/>
		@endslot
	</x-tenant.page-header>

	<x-tenant.dashboards.pr-counts/>

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
					<h6 class="card-subtitle text-muted">List of Purchase Requisitions.</h6>
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
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($prs as $pr)
							<tr>
								<td>{{ $pr->id }}</td>
								<td><a class="text-info" href="{{ route('prs.show',$pr->id) }}">{{ $pr->summary }}</a></td>
								<td><x-tenant.list.my-date :value="$pr->pr_date"/></td>
								<td>{{ $pr->requestor->name }}</td>
								<td>{{ $pr->dept->name }}</td>
								<td>{{ $pr->currency }}</td>
								<td class="text-end"><x-tenant.list.my-number :value="$pr->amount"/></td>
								<td><span class="badge {{ $pr->auth_status_badge->badge }}">{{ $pr->auth_status_badge->name}}</span></td>
								<td><span class="badge {{ $pr->status_badge->badge }}">{{ $pr->status_badge->name}}</span></td>
								<td class="table-action">
									<x-tenant.list.actions object="Pr" :id="$pr->id"/>
									<a href="{{ route('reports.pr',$pr->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Print">
											<i class="align-middle" data-feather="printer"></i></a>

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

