@extends('layouts.app')
@section('title','menu')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Menu
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="menu"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-8">

			<div class="card">

				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="Menu" :export="true"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Menu Lists
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">List of Menus.</h6>
				</div>

				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>ID</th>
								<th>Raw Route Name</th>
								<th>Route Name</th>
								<th>Node Name</th>
								<th>Enable</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($menus as $menu)
							<tr>
								<td>{{ $menu->id }}</td>
								<td>{{ $menu->raw_route_name }}</td>
								<td>{{ $menu->route_name }}</td>
								<td>{{ $menu->node_name }}</td>
								<td><x-tenant.list.my-boolean :value="$menu->enable"/></td>
								<td class="table-action">
									<x-tenant.list.actions object="menu" :id="$menu->id" :enable="false" :show="false"/>
									<a href="{{ route('menus.destroy',$menu->id) }}" class="me-2 sw2-advance"
										data-entity="Menu" data-name="{{ $menu->name }}" data-status="{{ ($menu->enable ? 'Disable' : 'Enable') }}"
										data-bs-toggle="tooltip" data-bs-placement="top" title="{{ ($menu->enable ? 'Disable' : 'Enable') }}">
										<i class="align-middle {{ ($menu->enable ? 'text-muted' : 'text-success') }}" data-feather="{{ ($menu->enable ? 'bell-off' : 'bell') }}"></i>
									</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					<div class="row pt-3">
						{{ $menus->links() }}
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

