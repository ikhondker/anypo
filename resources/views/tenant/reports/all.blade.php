@extends('layouts.tenant.app')
@section('title','Reports')

@section('breadcrumb')
	<li class="breadcrumb-item active">Reports</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Reports List (SYSTEM)
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create model="Report"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<x-tenant.card.header-search-export-bar model="Report"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Reports List (SYSTEM)
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">Lists of available reports and brief description.</h6>
				</div>

				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>ID</th>
								<th>Entity</th>
								<th>Code</th>
								<th>Name</th>
								<th>Summary</th>
								<th>Run Count</th>
								<th>Access</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>Enable?</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>


							@foreach ($reports as $report)
							<tr>
								<td>{{ $reports->firstItem() + $loop->index }}</td>
								<td>{{ $report->entity }}</td>
								<td>{{ $report->code }}</td>
								<td>{{ $report->name }}</td>
								<td>{{ $report->summary }}</td>
								<td>{{ $report->run_count }}</td>
								<td>{{ $report->access }}</td>
								<td><x-tenant.list.my-boolean :value="$report->start_date"/></td>
								<td><x-tenant.list.my-boolean :value="$report->end_date"/></td>
								<td><x-tenant.list.my-boolean :value="$report->enable"/></td>
								<td class="table-action">
									<a href="{{ route('reports.show',$report->code) }}" class="btn btn-light"
										data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i data-lucide="eye"></i> View
									</a>
									<a href="{{ route('reports.edit',$report->code) }}" class="text-muted" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
										<i class="align-middle" data-lucide="edit"></i></a>
									<a href="{{ route('reports.destroy', $report->code) }}" class="me-2 sw2-advance"
										data-entity="Report" data-name="{{ $report->name }}" data-status="{{ ($report->enable ? 'Disable' : 'Enable') }}"
										data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($report->enable ? 'Disable' : 'Enable') }}">
										<i class="align-middle text-muted" data-lucide="{{ ($report->enable ? 'bell-off' : 'bell') }}"></i>
									</a>
									<a href="{{ route('reports.parameter',$report->code) }}" class="btn btn-light"
										data-bs-toggle="tooltip" data-bs-placement="top" title="View"> <i data-lucide="printer"></i> Run Report
									</a>
								</td>
							</tr>
							@endforeach

						</tbody>
					</table>

					<div class="row pt-3">

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

