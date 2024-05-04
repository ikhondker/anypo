@extends('layouts.app')
@section('title','My Purchase Requisitions')
@section('breadcrumb')
	<li class="breadcrumb-item active">My Requisitions</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			My Purchase Requisitions
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="Pr" label="Requisition"/>
			<x-tenant.actions.pr-actions-index/>
			
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
							Requisition Lists
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
									<a href="{{ route('prs.show',$pr->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
										<i class="align-middle" data-feather="eye"></i></a>

									<a href="{{ route('reports.pr',$pr->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Print">
											<i class="align-middle" data-feather="printer"></i></a>

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

	 @include('shared.includes.js.sw2-advance')

@endsection

