@extends('layouts.tenant.app')
@section('title','menu')
@section('breadcrumb')
	<li class="breadcrumb-item active">Menus</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			Menu
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create object="menu"/>
		@endslot
	</x-tenant.page-header>

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
						<th class="text-end">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($menus as $menu)
					<tr>
						<td>{{ $menu->id }}</td>
						<td><a href="{{ route('menus.show',$menu->id) }}"><strong>{{ $menu->raw_route_name }}</strong></a></td>
						<td>{{ $menu->route_name }}</td>
						<td>{{ $menu->node_name }}</td>
						<td><x-tenant.list.my-boolean :value="$menu->enable"/></td>
						<td>
							<a href="{{ route('menus.show',$menu->id) }}" class="btn btn-light"
								data-bs-toggle="tooltip" data-bs-placement="top" title="View">View
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

@endsection

