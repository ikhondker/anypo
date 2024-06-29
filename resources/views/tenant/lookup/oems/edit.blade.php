@extends('layouts.tenant.app')
@section('title','Edit Oem')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('oems.index') }}">OEMs</a></li>
	<li class="breadcrumb-item"><a href="{{ route('oems.show',$oem->id) }}">{{ $oem->name }}</a></li>
	<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit OEM
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Oem"/>
			<x-tenant.buttons.header.create object="Oem"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('oems.update',$oem->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Edit OEM</h5>
							<h6 class="card-subtitle text-muted">Edit an OEM</h6>
						</div>
						<div class="card-body">
							<div class="mb-3">
								<label class="form-label">Oem Name</label>
								<input type="text" class="form-control @error('name') is-invalid @enderror"
									name="name" id="name" placeholder="Oem Name"
									value="{{ old('name', $oem->name ) }}"
									/>
								@error('name')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<x-tenant.buttons.show.save/>

						</div>
					</div>
				</div>
				<!-- end col-6 -->
			</div>


	</form>
	<!-- /.form end -->
@endsection

