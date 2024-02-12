@extends('layouts.app')
@section('title','Uom')
@section('breadcrumb','Create Uom')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Uom
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.save/>
			<x-tenant.buttons.header.lists object="Uom"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('uoms.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Create UoM</h5>
						<h6 class="card-subtitle text-muted">Create Unit of Measure (UoM) and conversion factor.</h6>
					</div>
					<div class="card-body">
						<div class="mb-3">
							<label class="form-label">UoM Class</label>
							<select class="form-control" name="uom_class_id" required>
								<option value=""><< UoM Class >> </option>
								@foreach ($uomClasses as $uomClass)
									<option value="{{ $uomClass->id }}" {{ $uomClass->id == old('uom_class_id') ? 'selected' : '' }} >{{ $uomClass->name }} </option>
								@endforeach
							</select>
							@error('uom_class_id')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label class="form-label">UoM Name</label>
							<input type="text" class="form-control @error('name') is-invalid @enderror"
								name="name" id="name" placeholder="Uom Name"
								value="{{ old('name', '' ) }}"
								required/>
							@error('name')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label class="form-label">Conversion Factor</label>
							<input type="number" class="form-control @error('conversion') is-invalid @enderror"
								name="conversion" id="conversion" placeholder="99,99,999.99"
								step='0.01' min="1" value="{{ old('conversion', '1.00' ) }}"
								required/>
							@error('conversion')
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