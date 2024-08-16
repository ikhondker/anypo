@extends('layouts.tenant.app')
@section('title','Edit Wf')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('wfs.index') }}" class="text-muted">Workflows</a></li>
	<li class="breadcrumb-item"><a href="{{ route('wfs.show',$wf->id) }}" class="text-muted">{{ $wf->id }}</a></li>
	<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Wf
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Wf"/>
			<x-tenant.buttons.header.create object="Wf"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('wfs.update',$wf->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

			<div class="row">
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Wf Info</h5>
						</div>
						<div class="card-body">

							<div class="mb-3">
								<label class="form-label">ID</label>
								<input type="text" name="id" id="id" class="form-control" placeholder="ID" value="{{ old('id', $wf->id ) }}" readonly>
							</div>

							<div class="mb-3">
								<label class="form-label">Wf Name</label>
								<input type="text" class="form-control @error('name') is-invalid @enderror"
									name="name" id="name" placeholder="Wf Name"
									value="{{ old('name', $wf->name ) }}"
									/>
								@error('name')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<x-tenant.edit.save/>

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

