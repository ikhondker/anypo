@extends('layouts.app')
@section('title','Edit Menu')
@section('breadcrumb','Edit Menu')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Menu
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Menu"/>
			<x-tenant.buttons.header.create object="Menu"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('menus.update',$menu->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

			<div class="row">
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Edit Menu</h5>
							<h6 class="card-subtitle text-muted">Edit Menu Details.</h6>
						</div>
						<div class="card-body">

							<div class="mb-3">
								<label class="form-label">ID</label>
								<input type="text" name="id" id="id" class="form-control" placeholder="ID" value="{{ old('id', $menu->id ) }}" readonly>
							</div>

							<div class="mb-3">
								<label class="form-label">Raw Route Name</label>
								<input type="text" class="form-control @error('raw_route_name') is-invalid @enderror"
									name="raw_route_name" id="raw_route_name" placeholder="Raw Route Name"
									value="{{ old('raw_route_name', $menu->raw_route_name ) }}"
									required/>
								@error('raw_route_name')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>



							<div class="mb-3">
								<label class="form-label">Route Name</label>
								<input type="text" class="form-control @error('route_name') is-invalid @enderror"
									name="route_name" id="route_name" placeholder="Route Name"
									value="{{ old('route_name', $menu->route_name ) }}"
									required/>
								@error('route_name')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<div class="mb-3">
								<label class="form-label">Node Name</label>
								<input type="text" class="form-control @error('node_name') is-invalid @enderror"
									name="node_name" id="node_name" placeholder="Node Name"
									value="{{ old('node_name', $menu->node_name ) }}"
									/>
								@error('node_name')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>


							<x-tenant.buttons.show.save/>

						</div>
					</div>
				</div>
				<!-- end col-6 -->

				<div class="col-6">
					<div class="card">

					</div>
				</div>
				<!-- end col-6 -->
			</div>


	</form>
	<!-- /.form end -->
@endsection

