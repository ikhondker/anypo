@extends('layouts.tenant.app')
@section('title','Create Item')
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

		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('items.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i>  View all</a>
				</div>
				<h5 class="card-title">Create and Item</h5>
				<h6 class="card-subtitle text-muted">Create and Item.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>

						<tr>
							<th>Code</th>
							<td>
								<input type="text" class="form-control @error('code') is-invalid @enderror"
								name="code" id="code" placeholder="XXXX" maxlength="25"
								style="text-transform: uppercase"
								value="{{ old('code', '' ) }}"
								required/>
							@error('code')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
							</td>
						</tr>
					

						<x-tenant.create.name/>

						<x-tenant.create.price-fc/>

						<tr>
							<th>Category</th>
							<td>
								<select class="form-control" name="category_id" required>
									<option value=""><< Category >> </option>
									@foreach ($categories as $category)
										<option value="{{ $category->id }}" {{ $category->id == old('category_id') ? 'selected' : '' }} >{{ $category->name }} </option>
									@endforeach
								</select>
								@error('category_id')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</td>
						</tr>
					

						<tr>
							<th>UoM Class</th>
							<td>
								<select class="form-control" name="uom_class_id" id="uom_class_id" required>
									<option value=""><< UoM Class>> </option>
									@foreach ($uomClasses as $uomClass)
										<option value="{{ $uomClass->id }}" {{ $uomClass->id == old('uom_class_id') ? 'selected' : '' }} >{{ $uomClass->name }} </option>
									@endforeach
								</select>
								@error('uom_class_id')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</td>
						</tr>
					
						<tr>
							<th>UoM</th>
							<td>
								<select class="form-control" name="uom_id" id="uom_id" required>
									<option value=""><< UoM >> </option>
									@foreach ($uoms as $uom)
										<option value="{{ $uom->id }}" {{ $uom->id == old('uom_id') ? 'selected' : '' }} >{{ $uom->name }} </option>
									@endforeach
								</select>
								@error('uom_id')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</td>
						</tr>

						

						<tr>
							<th>OEM</th>
							<td>
								<select class="form-control" name="oem_id" required>
									<option value=""><< OEM >> </option>
									@foreach ($oems as $oem)
										<option value="{{ $oem->id }}" {{ $oem->id == old('oem_id') ? 'selected' : '' }} >{{ $oem->name }} </option>
									@endforeach
								</select>
								@error('oem_id')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</td>
						</tr>
						

						<tr>
							<th>GL Type</th>
							<td>
								<select class="form-control" name="gl_type" required>
									<option value=""><< GL Type >> </option>
									@foreach ($gl_types as $gl_type)
										<option value="{{ $gl_type->gl_type }}" {{ $gl_type->gl_type == old('gl_type') ? 'selected' : '' }} >{{ $gl_type->name }} </option>
									@endforeach
								</select>
								@error('gl_type')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</td>
						</tr>
						

						<tr>
							<th>Expense GL Code</th>
							<td>
								<input type="text" class="form-control @error('ac_expense') is-invalid @enderror"
								name="ac_expense" id="ac_expense" placeholder="A600001" maxlength="25"
								style="text-transform: uppercase"
								value="{{ old('ac_expense', 'A600001' ) }}"
								required/>
							@error('ac_expense')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
							</td>
						</tr>
						

						<x-tenant.create.notes/>
						<x-tenant.buttons.show.save/>


					</tbody>
				</table>
			</div>
		</div>


		
	</form>
	<!-- /.form end -->

	<script type="module">
		$(document).ready(function () {
			$('#uom_class_id').change(function() {
				//console.log("Item changed Hello world !");
				let id = $(this).val();
				let url2 = '{{ route("uoms.get-uoms-by-class", ":id") }}';
				//url2 = url2.replace(':id', '1001');
				url2 = url2.replace(':id', id);
				$("#uom_id").html('');
				$.ajax({
					url: url2,
					type: 'get',
					dataType: 'json',
					success: function (res) {
						// $('#uom_id').html('<option value="">-- Select UoM --</option>');
						$.each(res.uoms, function (key, value) {
							$("#uom_id").append('<option value="' + value
								.id + '">' + value.name + '</option>');
						});
					}
				});
			});
		});
	</script>


@endsection

