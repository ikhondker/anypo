@extends('layouts.tenant.app')
@section('title','Project Spend Summary')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('projects.index') }}" class="text-muted">Projects</a></li>
	<li class="breadcrumb-item active">Project Spends</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Project Spend Summary
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create model="Project"/>
			<x-tenant.buttons.header.lists model="Project"/>
		@endslot
	</x-tenant.page-header>

	<x-tenant.dashboards.project-counts/>

	<div class="row">
		<x-tenant.charts.spends-by-project-bar/>
		<x-tenant.charts.spends-by-project-count-bar/>
	</div>

	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<x-tenant.card.header-search-export-bar model="Project"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-info">{{ request('term') }}</strong>
						@else
							Project Spends
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
								<th class="text-end">Budget</th>
								<th class="text-end">PR</th>
								<th class="text-end">Available (PR)</th>
								<th class="text-end">PO</th>
								<th class="text-end">Available (PO)</th>
								<th class="text-end">GRS</th>
								<th class="text-end">Invoice</th>
								<th class="text-end">Payment</th>
								<th>Closed?</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($projects as $project)
							<tr>
								<td>{{ $projects->firstItem() + $loop->index }}</td>
								<td><a href="{{ route('projects.po',$project->id) }}"><strong>{{ $project->code }}</strong></a></td>
								<td class="text-end"><x-tenant.list.my-number :value="$project->amount"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$project->amount_pr_booked + $project->amount_pr"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$project->amount - $project->amount_pr_booked - $project->amount_pr "/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$project->amount_po_booked + $project->amount_po"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$project->amount - $project->amount_po_booked - $project->amount_po"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$project->amount_grs"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$project->amount_invoice"/></td>
								<td class="text-end"><x-tenant.list.my-number :value="$project->amount_payment"/></td>
								<td><x-tenant.list.my-closed :value="$project->closed"/></td>
								<td>
									<a href="{{ route('projects.show',$project->id) }}" class="btn btn-light"
										data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i data-lucide="eye"></i> View
									</a>
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

