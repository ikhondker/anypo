@extends('layouts.app')
@section('title','Hierarchy')

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
		<div class="col-8">

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="Hierarchy"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Hierarchy Lists
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
								<th>Date Created</th>
								<th>Enable</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($hierarchies as $hierarchy)
							<tr>
								<td>{{ $hierarchy->id }}</td>
								<td><a class="text-info" href="{{ route('hierarchies.show',$hierarchy->id) }}">{{ $hierarchy->name }}</a></td>
								<td><x-tenant.list.my-date-time :value="$hierarchy->created_at"/></td>
								<td><x-tenant.list.my-boolean :value="$hierarchy->enable"/></td>
								<td class="table-action">
									<x-tenant.list.actions object="Hierarchy" :id="$hierarchy->id"/>
									<a href="{{ route('hierarchies.destroy',$hierarchy->id) }}" class="me-2 modal-boolean-advance" 
										data-entity="Hierarchy" data-name="{{ $hierarchy->name }}" data-status="{{ ($hierarchy->enable ? 'Disable' : 'Enable') }}"
										data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($hierarchy->enable ? 'Disable' : 'Enable') }}">
										<i class="align-middle text-muted" data-feather="{{ ($hierarchy->enable ? 'bell-off' : 'bell') }}"></i>
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

	 @include('tenant.includes.modal-boolean-advance')    

@endsection

