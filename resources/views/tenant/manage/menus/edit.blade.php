@extends('layouts.tenant.app')
@section('title','Edit Menu')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('menus.index') }}">Menus</a></li>
	<li class="breadcrumb-item active">{{ $menu->name }}</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Menu
		@endslot
		@slot('buttons')
			<x-tenant.actions.manage.menu-actions id="{{ $menu->id }}"/>
			<x-tenant.buttons.header.lists object="Menu"/>
			<x-tenant.buttons.header.create object="Menu"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('menus.update',$menu->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('menus.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i>  View all</a>
				</div>
				<h5 class="card-title">Edit Menu</h5>
							<h6 class="card-subtitle text-muted">Edit Menu Details.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<tr>
							<th>ID</th>
							<td>
								<input type="text" name="id" id="id" class="form-control" placeholder="ID" value="{{ old('id', $menu->id ) }}" readonly>
							</td>
						</tr>
						<tr>
							<th>Raw Route Name</th>
							<td>
								<input type="text" class="form-control @error('raw_route_name') is-invalid @enderror"
								name="raw_route_name" id="raw_route_name" placeholder="Raw Route Name"
								value="{{ old('raw_route_name', $menu->raw_route_name ) }}"
								required/>
							@error('raw_route_name')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
							</td>
						</tr>
						<tr>
							<th>Route Name</th>
							<td>
								<input type="text" class="form-control @error('route_name') is-invalid @enderror"
								name="route_name" id="route_name" placeholder="Route Name"
								value="{{ old('route_name', $menu->route_name ) }}"
								required/>
							@error('route_name')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
							</td>
						</tr>
						<tr>
							<th>Node Name</th>
							<td>
								<input type="text" class="form-control @error('node_name') is-invalid @enderror"
								name="node_name" id="node_name" placeholder="Node Name"
								value="{{ old('node_name', $menu->node_name ) }}"
								/>
							@error('node_name')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
							</td>
						</tr>
						<x-tenant.buttons.show.save/>
					</tbody>
				</table>
			</div>
		</div>


	</form>
	<!-- /.form end -->
@endsection

