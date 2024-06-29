@extends('layouts.tenant.app')
@section('title','Edit Status')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('statuses.index') }}">Statues</a></li>
	<li class="breadcrumb-item active">{{ $status->name }}</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Status
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Status"/>
			<x-tenant.buttons.header.create object="Status"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('statuses.update',$status->code) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

			<div class="row">
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Status Detail</h5>
							<h6 class="card-subtitle text-muted">Edit Status Details.</h6>
						</div>
						<div class="card-body">


							<div class="mb-3">
								<label class="form-label">Code</label>
								<input type="text" class="form-control @error('code') is-invalid @enderror"
									code="code" id="code" placeholder="Raw Route Name"
									value="{{ old('code', $status->code ) }}"
									required/>
								@error('code')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<div class="mb-3">
								<label class="form-label">Name</label>
								<input type="text" class="form-control @error('name') is-invalid @enderror"
									name="name" id="name" placeholder="Raw Route Name"
									value="{{ old('name', $status->name ) }}"
									required/>
								@error('name')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>



							<div class="mb-3">
								<label class="form-label">Badge</label>
								<input type="text" class="form-control @error('badge') is-invalid @enderror"
									name="badge" id="badge" placeholder="Route Name"
									value="{{ old('badge', $status->badge ) }}"
									required/>
								@error('badge')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<div class="mb-3">
								<label class="form-label">Node Name</label>
								<input type="text" class="form-control @error('node_name') is-invalid @enderror"
									name="node_name" id="node_name" placeholder="Node Name"
									value="{{ old('node_name', $status->node_name ) }}"
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

