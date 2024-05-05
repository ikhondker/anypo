@extends('layouts.app')
@section('title','Item')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('items.index') }}">Items</a></li>
	<li class="breadcrumb-item active">Create</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Item
		@endslot
		@slot('buttons')
		<x-tenant.buttons.header.save/>
			<x-tenant.buttons.header.lists object="Item"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Create and Item</h5>
						<h6 class="card-subtitle text-muted">Create and Item.</h6>
					</div>
					<div class="card-body">
						<div class="mb-3 col-md-6">
							<label for="code" class="form-label">Code</label>
							<input type="text" class="form-control @error('code') is-invalid @enderror"
								name="code" id="code" placeholder="XXXX" maxlength="25"
								style="text-transform: uppercase"
								value="{{ old('code', '' ) }}"
								required/>
							@error('code')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>
						
						<x-tenant.create.name/>
						
						<x-tenant.create.price-fc/>


						<div class="mb-3">
							<label class="form-label">Category</label>
							<select class="form-control" name="category_id" required>
								<option value=""><< Category >> </option>
								@foreach ($categories as $category)
									<option value="{{ $category->id }}" {{ $category->id == old('category_id') ? 'selected' : '' }} >{{ $category->name }} </option>
								@endforeach
							</select>
							@error('category_id')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label class="form-label">UoM Class</label>
							<select class="form-control" name="uom_class_id" required>
								<option value=""><< UoM Class>> </option>
								@foreach ($uomClasses as $uomClass)
									<option value="{{ $uomClass->id }}" {{ $uomClass->id == old('uom_class_id') ? 'selected' : '' }} >{{ $uomClass->name }} </option>
								@endforeach
							</select>
							@error('uom_class_id')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label class="form-label">UoM</label>
							<select class="form-control" name="uom_id" required>
								<option value=""><< UoM >> </option>
								@foreach ($uoms as $uom)
									<option value="{{ $uom->id }}" {{ $uom->id == old('uom_id') ? 'selected' : '' }} >{{ $uom->name }} </option>
								@endforeach
							</select>
							@error('uom_id')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label class="form-label">OEM</label>
							<select class="form-control" name="oem_id" required>
								<option value=""><< OEM >> </option>
								@foreach ($oems as $oem)
									<option value="{{ $oem->id }}" {{ $oem->id == old('oem_id') ? 'selected' : '' }} >{{ $oem->name }} </option>
								@endforeach
							</select>
							@error('oem_id')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label class="form-label">GL Type</label>
							<select class="form-control" name="gl_type" required>
								<option value=""><< GL Type >> </option>
								@foreach ($gl_types as $gl_type)
									<option value="{{ $gl_type->gl_type }}" {{ $gl_type->gl_type == old('gl_type') ? 'selected' : '' }} >{{ $gl_type->name }} </option>
								@endforeach
							</select>
							@error('gl_type')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3 col-md-6">
							<label for="ac_expense" class="form-label">Expense GL Code</label>
							<input type="text" class="form-control @error('ac_expense') is-invalid @enderror"
								name="ac_expense" id="ac_expense" placeholder="A600001" maxlength="25"
								style="text-transform: uppercase"
								value="{{ old('ac_expense', 'A600001' ) }}"
								required/>
							@error('ac_expense')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>


						<x-tenant.create.notes/>
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