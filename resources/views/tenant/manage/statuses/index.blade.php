@extends('layouts.app')
@section('title','status')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			status
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="status"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-8">

			<div class="card">

				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="Menu" :export="false"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Menu Lists
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout header-with-simple-search.</h6>
				</div>

				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>ID</th>
								<th>Entity</th>
								<th>Code</th>
								<th>Name</th>
								<th>Badge</th>
								<th>Enable</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($statuses as $status)
							<tr>
								<td>1</td>
								<td>{{ $status->entity }}</td>
								<td>{{ $status->code }}</td>
								<td>{{ $status->name }}</td>
								<td>{{ $status->badge }}</td>
								<td><x-tenant.list.my-boolean :value="$status->enable"/></td>
								<td class="table-action">
									<x-tenant.list.actions object="status" :id="$status->code" :enable="false" :show="false"/>
										<a href="{{ route('statuses.destroy',$status->code) }}" class="me-2 modal-boolean-advance"
											data-entity="Menu" data-name="{{ $status->name }}" data-status="{{ ($status->enable ? 'Disable' : 'Enable') }}"
											data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($status->enable ? 'Disable' : 'Enable') }}">
											<i class="align-middle {{ ($status->enable ? 'text-muted' : 'text-success') }}" data-feather="{{ ($status->enable ? 'bell-off' : 'bell') }}"></i>
										</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					<div class="row pt-3">
						{{ $statuses->links() }}
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

