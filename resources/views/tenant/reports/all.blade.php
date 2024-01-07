@extends('layouts.app')
@section('title','Reports')

@section('content')

	<x-tenant.page-header>
		@slot('title')
		Reports
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="Report"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-8">

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="Report"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Department Lists
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout header-with-simple-search.</h6>
				</div>
				
				<div class="card-body">
					<table class="table"> 
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Title</th>
								<th>Access</th>
								<th>Start Date</th>
								<th>End Date</th>
								<th>Enable</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($reports as $report)
							<tr>
								<td>{{ $report->id }}</td>
								<td><a class="text-info" href="{{ route('reports.show',$report->id) }}">{{ $report->name }}</a></td>
								<td>{{ $report->title }}</td>
								<td>{{ $report->access }}</td>
								<td><x-tenant.list.my-boolean :value="$report->start_date"/></td>
								<td><x-tenant.list.my-boolean :value="$report->end_date"/></td>
								<td><x-tenant.list.my-boolean :value="$report->enable"/></td>
								<td class="table-action">
									<x-tenant.list.actions object="Report" :id="$report->id"/>
									<a href="{{ route('reports.destroy', $report->id) }}" class="me-2 modal-boolean-advance" 
										data-entity="Report" data-name="{{ $report->name }}" data-status="{{ ($report->enable ? 'Disable' : 'Enable') }}"
										data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($report->enable ? 'Disable' : 'Enable') }}">
										<i class="align-middle text-muted" data-feather="{{ ($report->enable ? 'bell-off' : 'bell') }}"></i>
									</a>
									<a wire:ignore href="{{ route('reports.edit',$report->id)  }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
										<i class="align-middle" data-feather="layout"></i>
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

	@include('tenant.includes.modal-boolean-advance')
	
@endsection

