@extends('layouts.app')
@section('title','Oem')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Oem
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="Oem"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-8">

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="Oem"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							OEM Lists
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout header-with-simple-search.</h6>
				</div>

				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Enable</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($oems as $oem)
							<tr>
								<td>{{ $oems->firstItem() + $loop->index }}</td>
								<td>{{ $oem->name }}</td>
								<td><x-tenant.list.my-boolean :value="$oem->enable"/></td>
								<td class="table-action">
									<x-tenant.list.actions object="Oem" :id="$oem->id" :show="false"/>
									<a href="{{ route('oems.destroy',$oem->id) }}" class="me-2 modal-boolean-advance"
										data-entity="Oem" data-name="{{ $oem->name }}" data-status="{{ ($oem->enable ? 'Disable' : 'Enable') }}"
										data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($oem->enable ? 'Disable' : 'Enable') }}">
										<i class="align-middle text-muted" data-feather="{{ ($oem->enable ? 'bell-off' : 'bell') }}"></i>
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					<div class="row pt-3">
						{{ $oems->links() }}
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

