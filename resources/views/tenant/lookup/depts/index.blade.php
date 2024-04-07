@extends('layouts.app')
@section('title','Dept')

@section('breadcrumb')
	<li class="breadcrumb-item active">Department</li>
@endsection

@section('content')

	{{-- <nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="dashboard-default.html">Home</a></li>
			<li class="breadcrumb-item"><a href="#">Library</a></li>
			<li class="breadcrumb-item active">Data</li>
		</ol>
	</nav> --}}

	<x-tenant.page-header>
		@slot('title')
			Department Lists
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="Dept"/>
		@endslot
	</x-tenant.page-header>


	<div class="row">
		<div class="col-12">
		

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="Dept"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Department Lists
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">List of departments with Requisition and Purchase Order Approval Hierarchy</h6>
				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>PR Hierarchy</th>
								<th>PO Hierarchy</th>
								<th>Enable?</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($depts as $dept)
							<tr>
								<td>{{ $depts->firstItem() + $loop->index }}</td>
								<td><a class="text-info" href="{{ route('depts.show',$dept->id) }}">{{ $dept->name }}</a></td>
								<td><a class="text-info" href="{{ route('hierarchies.show',$dept->pr_hierarchy_id) }}">{{ $dept->prHierarchy->name }}</a></td>
								<td><a class="text-info" href="{{ route('hierarchies.show',$dept->po_hierarchy_id) }}">{{ $dept->poHierarchy->name }}</a></td>
								<td><x-tenant.list.my-boolean :value="$dept->enable"/></td>
								<td class="table-action">
									<x-tenant.list.actions object="Dept" :id="$dept->id"/>
									<a href="{{ route('depts.destroy', $dept->id) }}" class="me-2 sw2-advance" 
										data-entity="Dept" data-name="{{ $dept->name }}" data-status="{{ ($dept->enable ? 'Disable' : 'Enable') }}"
										data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($dept->enable ? 'Disable' : 'Enable') }}">
										<i class="align-middle text-muted" data-feather="{{ ($dept->enable ? 'bell-off' : 'bell') }}"></i>
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					<div class="row pt-3">
						{{ $depts->links() }}
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

