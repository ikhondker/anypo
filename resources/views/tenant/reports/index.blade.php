@extends('layouts.app')
@section('title','Reports')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Reports
		@endslot
		@slot('buttons')
			{{-- <x-tenant.buttons.header.create object="Reports"/> --}}
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Reports Lists</h5>
					<h6 class="card-subtitle text-muted">Lists of available reports and brief description.</h6>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Description</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							
							@foreach ($reports as $report)
								<tr>
									<td>{{ $reports->firstItem() + $loop->index }}</td>
									<td>{{ $report->name }}</td>
									<td>{{ $report->summary }}</td>
									<td class="table-action">
										<a class="btn btn-primary text-white" href="{{ route('reports.parameter',$report->id) }}"><i data-feather="printer"></i> Run Report</a>
									</td>
								</tr>
							@endforeach
							
						</tbody>
					</table>

					<div class="row pt-3">
							{{ $reports->links() }}
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

