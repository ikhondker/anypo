@extends('layouts.tenant.app')
@section('title','Hierarchy')
@section('breadcrumb')
	<li class="breadcrumb-item active">Approval Hierarchies</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Hierarchy
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="Hierarchy"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<x-tenant.card.header-search-export-bar object="Hierarchy"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Hierarchy Lists
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">List of approval hierarchies.</h6>

				</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Date Created</th>
								<th>Enable</th>
								<th>View</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($hierarchies as $hierarchy)
							<tr>
								<td>{{ $hierarchies->firstItem() + $loop->index }}</td>
								<td><a href="{{ route('hierarchies.show',$hierarchy->id) }}"><strong>{{ $hierarchy->name }}</strong></a></td>
								<td><x-tenant.list.my-date-time :value="$hierarchy->created_at"/></td>
								<td><x-tenant.list.my-boolean :value="$hierarchy->enable"/></td>
								<td class="table-action">
									<a href="{{ route('hierarchies.show',$hierarchy->id) }}" class="btn btn-light"
										data-bs-toggle="tooltip" data-bs-placement="top" title="View">View
									</a>

								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					<div class="row pt-3">
						{{ $hierarchies->links() }}
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

