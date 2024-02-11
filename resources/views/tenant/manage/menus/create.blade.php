@extends('layouts.app')
@section('title','Menu')
@section('breadcrumb','Create Menu')

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

		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header">
					<h5 class="card-title">Menu Info</h5>
					</div>
					<div class="card-body">


						<div class="mb-3">
							<label class="form-label">Raw Route Name</label>
							<input type="text" class="form-control @error('raw_route_name') is-invalid @enderror"
								name="raw_route_name" id="raw_route_name" placeholder="Raw Route Name"
								value="{{ old('raw_route_name', '' ) }}"
								required/>
							@error('raw_route_name')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label class="form-label">Route Name</label>
							<input type="text" class="form-control @error('route_name') is-invalid @enderror"
								name="route_name" id="route_name" placeholder="Route Name"
								value="{{ old('route_name', '' ) }}"
								required/>
							@error('route_name')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label class="form-label">Node Name</label>
							<input type="text" class="form-control @error('node_name') is-invalid @enderror"
								name="node_name" id="node_name" placeholder="Node Name"
								value="{{ old('node_name', '' ) }}"
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

			</div>
			<!-- end col-6 -->
		</div>
		<!-- end row -->

	</form>
	<!-- /.form end -->

@endsection