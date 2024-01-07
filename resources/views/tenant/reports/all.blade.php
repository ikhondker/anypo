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
							@foreach ($reports as $reports)
							<tr>
								<td>{{ $reports->id }}</td>
								<td><a class="text-info" href="{{ route('reports.show',$reports->id) }}">{{ $reports->name }}</a></td>
								<td>{{ $reports->title }}</td>
								<td>{{ $reports->access }}</td>
								<td><x-tenant.list.my-boolean :value="$reports->start_date"/></td>
								<td><x-tenant.list.my-boolean :value="$reports->end_date"/></td>
								<td><x-tenant.list.my-boolean :value="$reports->enable"/></td>
								<td class="table-action">
									<x-tenant.list.actions object="Report" :id="$reports->id"/>
									<a href="{{ route('reports.destroy', $reports->id) }}" class="me-2 modal-boolean-advance" 
										data-entity="Report" data-name="{{ $reports->name }}" data-status="{{ ($reports->enable ? 'Disable' : 'Enable') }}"
										data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($reports->enable ? 'Disable' : 'Enable') }}">
										<i class="align-middle text-muted" data-feather="{{ ($reports->enable ? 'bell-off' : 'bell') }}"></i>
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

