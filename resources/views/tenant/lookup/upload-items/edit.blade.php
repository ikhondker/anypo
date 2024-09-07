@extends('layouts.tenant.app')
@section('title','Edit Interface Item')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('upload-items.index') }}" class="text-muted">Interface Items</a></li>
	<li class="breadcrumb-item"><a href="{{ route('upload-items.show',$uploadItem->id) }}" class="text-muted">{{ $uploadItem->item_code }}</a></li>
	<li class="breadcrumb-item active">Edit</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Interface Item
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="UploadItem"/>
		@endslot
	</x-tenant.page-header>
	<!-- form start -->
	<form id="myform" action="{{ route('upload-items.update',$uploadItem->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('upload-items.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
				</div>
				<h5 class="card-title">Edit Interface Item Data</h5>
				<h6 class="card-subtitle text-muted">Edit Item Interface Detail.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<x-tenant.edit.id-read-only :value="$uploadItem->id"/>
						<tr>
							<th>Item Code :</th>
							<td>
								<input type="text" class="form-control @error('item_code') is-invalid @enderror"
									name="item_code" id="item_code" placeholder="XXXXX"
									style="text-transform: uppercase"
									value="{{ old('item_code', $uploadItem->item_code ) }}"
									required/>
								@error('item_code')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</td>
						</tr>
						<x-tenant.edit.name value="{{ $uploadItem->item_name }}"/>
						<tr>
							<th>Category :</th>
							<td>
								<input type="text" class="form-control @error('category_name') is-invalid @enderror"
								name="category_name" id="category_name" placeholder="Category"
								value="{{ old('category_name', $uploadItem->category_name ) }}"
								required/>
							@error('category_name')
								<div class="small text-danger">{{ $message }}</div>
							@enderror
							</td>
						</tr>

						<tr>
							<th>OEM :</th>
							<td>
								<input type="text" class="form-control @error('oem_name') is-invalid @enderror"
									name="oem_name" id="oem_name" placeholder="OEM"
									value="{{ old('oem_name', $uploadItem->oem_name ) }}"
									required/>
								@error('oem_name')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</td>
						</tr>

						<tr>
							<th>UoM :</th>
							<td>
								<input type="text" class="form-control @error('uom_name') is-invalid @enderror"
									name="uom_name" id="uom_name" placeholder="UOM"
									value="{{ old('uom_name', $uploadItem->uom_name ) }}"
									required/>
								@error('uom_name')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</td>
						</tr>
						<tr>
							<th>GL Type :</th>
							<td>
								<input type="text" class="form-control @error('gl_type_name') is-invalid @enderror"
									name="gl_type_name" id="gl_type_name" placeholder="UOM"
									value="{{ old('gl_type_name', $uploadItem->gl_type_name ) }}"
									required/>
								@error('gl_type_name')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</td>
						</tr>

						<tr>
							<th>Expense GL Code :</th>
							<td>
								<input type="text" class="form-control @error('ac_expense') is-invalid @enderror"
									name="ac_expense" id="ac_expense" placeholder="A600001" maxlength="255"
									style="text-transform: uppercase"
									value="{{ old('ac_expense', $uploadItem->ac_expense ) }}"
									required/>
								@error('ac_expense')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</td>
						</tr>
						<x-tenant.edit.price value="{{ $uploadItem->price }}"/>
							<x-tenant.edit.save/>
					</tbody>
				</table>
			</div>
		</div>




	</form>
	<!-- /.form end -->
@endsection

