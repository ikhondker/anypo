@extends('layouts.tenant.app')
@section('title','Oem')
@section('breadcrumb')
	<li class="breadcrumb-item active">OEMs</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			OEM
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="Oem"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">

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
					<h6 class="card-subtitle text-muted">List of OEM's</h6>
				</div>

				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Enable</th>
								<th>Actions</th>
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
									<a href="{{ route('oems.destroy',$oem->id) }}" class="me-2 sw2-advance"
										data-entity="OEM" data-name="{{ $oem->name }}" data-status="{{ ($oem->enable ? 'Disable' : 'Enable') }}"
										data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($oem->enable ? 'Disable' : 'Enable') }}">
										<i class="align-middle text-muted" data-lucide="{{ ($oem->enable ? 'bell-off' : 'bell') }}"></i>
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

	 

@endsection

