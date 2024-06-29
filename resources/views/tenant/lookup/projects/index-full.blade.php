@extends('layouts.tenant.app')
@section('title','Project')

@section('breadcrumb')
	<li class="breadcrumb-item active">Projects</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Project
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="Project"/>
		@endslot
	</x-tenant.page-header>

	<x-tenant.dashboards.project-counts/>

	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="Project"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Project Lists
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">List of projects and budget usages.</h6>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Code</th>
								<th>PM</th>
								<th>Start-End</th>

								<th class="text-end">Budget</th>
								<th class="text-end">PR</th>
								<th class="text-end">Available (PR)</th>
								<th class="text-end">PO</th>
								<th class="text-end">Available (PO)</th>
								<th class="text-end">GRS</th>
								<th class="text-end">Invoice</th>
								<th class="text-end">Payment</th>

								<th>Closed</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($projects as $project)
							<tr>
								<td>{{ $projects->firstItem() + $loop->index }}</td>
								<td><a class="text-info" href="{{ route('projects.show',$project->id) }}">{{ $project->code }}</a></td>
								<td>{{ $project->pm->name }}</td>
								<td><x-tenant.list.my-date :value="$project->start_date"/> - <x-tenant.list.my-date :value="$project->end_date"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$project->amount"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$project->amount_pr_booked + $project->amount_pr"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$project->amount - $project->amount_pr_booked - $project->amount_pr "/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$project->amount_po_booked + $project->amount_po"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$project->amount - $project->amount_po_booked - $project->amount_po"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$project->amount_grs"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$project->amount_invoice"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$project->amount_payment"/></td>
								<td><x-tenant.list.my-closed :value="$project->closed"/></td>
								<td class="table-action">
									<a href="{{ route('projects.show',$project->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
										<i class="align-middle" data-feather="eye"></i></a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					<div class="row pt-3">
						{{ $projects->links() }}
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

