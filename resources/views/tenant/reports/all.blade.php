@extends('layouts.app')
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
			<x-tenant.buttons.header.create object="Report"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="Report"/>
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
								<th>Name</th>
								<th>Summary</th>
								<th>Run Count</th>
								<th>Access</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>Enable</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							

							<tr>
								<td>1</td>
								<td colspan="6">Parameter Testing 1</td>
								<td>run</td>
								<td class="table-action">
									<a class="btn btn-primary text-white" href="{{ route('reports.edit','1004') }}">Run</a>
								</td>
							</tr>
							<tr>
								<td>2</td>
								<td colspan="6">Create PDF</td>
								<td>run</td>
								<td class="table-action">
									<a class="btn btn-primary text-white" href="{{ route('reports.createPDF') }}">Create PDF</a>
								</td>
							</tr>
							<tr>
								<td>3</td>
								<td colspan="6">Template PR</td>
								<td>run</td>
								<td class="table-action">
									<a class="btn btn-primary text-white" href="{{ route('reports.templatepr') }}">Template PR</a>
								</td>
							</tr>
							<tr>
								<td>4</td>
								<td colspan="6">Template PO</td>
								<td>run</td>
								<td class="table-action">
									<a class="btn btn-primary text-white" href="{{ route('reports.templatepo') }}">Template PO</a>
								</td>
							</tr>

							@foreach ($reports as $report)
							<tr>
								<td>{{ $reports->firstItem() + $loop->index }}</td>
								<td><a class="text-info" href="{{ route('reports.show',$report->id) }}">{{ $report->name }} [r{{ $report->id }}] </a></td>
								<td>{{ $report->summary }}</td>
								<td>{{ $report->run_count }}</td>
								<td>{{ $report->access }}</td>
								<td><x-tenant.list.my-boolean :value="$report->start_date"/></td>
								<td><x-tenant.list.my-boolean :value="$report->end_date"/></td>
								<td><x-tenant.list.my-boolean :value="$report->enable"/></td>
								<td class="table-action">
									<x-tenant.list.actions object="Report" :id="$report->id"/>
									<a href="{{ route('reports.destroy', $report->id) }}" class="me-2 sw2-advance" 
										data-entity="Report" data-name="{{ $report->name }}" data-status="{{ ($report->enable ? 'Disable' : 'Enable') }}"
										data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($report->enable ? 'Disable' : 'Enable') }}">
										<i class="align-middle text-muted" data-feather="{{ ($report->enable ? 'bell-off' : 'bell') }}"></i>
									</a>
									<a href="{{ route('reports.parameter',$report->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Run">
										<i class="align-middle" data-feather="printer"></i>
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

