@extends('layouts.tenant.app')
@section('title','Menu')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('menus.index') }}" class="text-muted">Menus</a></li>
	<li class="breadcrumb-item active">Create Menu</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Menu
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Menu"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		
		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('menus.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
				</div>
				<h5 class="card-title">Create Menu</h5>
				<h6 class="card-subtitle text-muted">Create new Menu.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<tr>
							<th>Raw Route Name</th>
							<td>
								<input type="text" class="form-control @error('raw_route_name') is-invalid @enderror"
								name="raw_route_name" id="raw_route_name" placeholder="Raw Route Name"
								value="{{ old('raw_route_name', '' ) }}"
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
								value="{{ old('route_name', '' ) }}"
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
								value="{{ old('node_name', '' ) }}"
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