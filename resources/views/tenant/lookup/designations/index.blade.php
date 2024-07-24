@extends('layouts.tenant.app')
@section('title','Designations')
@section('breadcrumb')
	<li class="breadcrumb-item active">Designations</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Designation
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="Designation"/>
		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">
			<x-tenant.cards.header-search-export-bar object="Designation"/>
			<h5 class="card-title">
				@if (request('term'))
					Search result for: <strong class="text-danger">{{ request('term') }}</strong>
				@else
					Designation Lists
				@endif
			</h5>
			<h6 class="card-subtitle text-muted">List of designations</h6>
		</div>
		<div class="card-body">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Enable</th>
						<th>View</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($designations as $designation)
					<tr>
						<td>{{ $designations->firstItem() + $loop->index }}</td>
						<td><a href="{{ route('designations.show',$designation->id) }}"><strong>{{ $designation->name }}</strong></a>
						<td><x-tenant.list.my-boolean :value="$designation->enable"/></td>
						<td>
							<a href="{{ route('designations.show',$designation->id) }}" class="btn btn-light"
								data-bs-toggle="tooltip" data-bs-placement="top" title="View">View
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row pt-3">
				{{ $designations->links() }}
			</div>
			<!-- end pagination -->

		</div>
		<!-- end card-body -->
	</div>
	<!-- end card -->

@endsection

