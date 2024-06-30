@extends('layouts.tenant.app')
@section('title','status')
@section('breadcrumb')
	<li class="breadcrumb-item active">Statuses</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			Status Lists
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="status"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-8">

			<div class="card">

				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="Status" :export="true"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Status Lists
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">List of all Statuses.</h6>
				</div>

				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>ID</th>
								<th>Code</th>
								<th>Name</th>
								<th>Badge</th>
								<th>Enable</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($statuses as $status)
							<tr>
								<td>{{ $statuses->firstItem() + $loop->index}}</td>
								<td>{{ $status->code }}</td>
								<td>{{ $status->name }}</td>
								<td><span class="badge {{ $status->badge }}">{{ $status->badge }}</span></td>

								<td><x-tenant.list.my-boolean :value="$status->enable"/></td>
								<td class="table-action">
									<x-tenant.list.actions object="status" :id="$status->code" :enable="false" :show="false"/>
										<a href="{{ route('statuses.destroy',$status->code) }}" class="me-2 sw2-advance"
											data-entity="Status" data-name="{{ $status->name }}" data-status="{{ ($status->enable ? 'Disable' : 'Enable') }}"
											data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($status->enable ? 'Disable' : 'Enable') }}">
											<i class="align-middle {{ ($status->enable ? 'text-muted' : 'text-success') }}" data-lucide="{{ ($status->enable ? 'bell-off' : 'bell') }}"></i>
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

	 

@endsection

