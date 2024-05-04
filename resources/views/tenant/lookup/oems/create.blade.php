@extends('layouts.app')
@section('title','Oem')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('oems.index') }}">OEMs</a></li>
	<li class="breadcrumb-item active">Create</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create OEM
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.save/>
			<x-tenant.buttons.header.lists object="Oem"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('oems.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Create OEM</h5>
						<h6 class="card-subtitle text-muted">Create a new OEM</h6>
					</div>
					<div class="card-body">


						<div class="mb-3">
							<label class="form-label">Oem Name</label>
							<input type="text" class="form-control @error('name') is-invalid @enderror"
								name="name" id="name" placeholder="Oem Name"
								value="{{ old('name', '' ) }}"
								required/>
							@error('name')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<x-tenant.buttons.show.save/>
					</div>
				</div>
			</div>
		
		</div>
		<!-- end row -->

	</form>
	<!-- /.form end -->

@endsection