@extends('layouts.app')
@section('title','Edit Interface Item')
@section('breadcrumb','Edit InterfaceItem')

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

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Edit Interface Item Data</h5>
							<h6 class="card-subtitle text-muted">Edit Item Interface Detail.</h6>
						</div>
						<div class="card-body">

							<x-tenant.edit.id-read-only :value="$uploadItem->id"/>
							

							<div class="mb-3">
								<label class="form-label">item_code</label>
								<input type="text" class="form-control @error('item_code') is-invalid @enderror"
									name="item_code" id="item_code" placeholder="XXXXX"
									style="text-transform: uppercase"
									value="{{ old('item_code', $uploadItem->item_code ) }}"
									required/>
								@error('item_code')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<div class="mb-3">
								<label class="form-label">Item</label>
								<input type="text" class="form-control @error('item_name') is-invalid @enderror"
									name="item_name" id="item_name" placeholder="Category"
									value="{{ old('item_name', $uploadItem->item_name ) }}"
									required/>
								@error('item_name')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>


							<div class="mb-3">
								<label class="form-label">Category</label>
								<input type="text" class="form-control @error('category_name') is-invalid @enderror"
									name="category_name" id="category_name" placeholder="Category"
									value="{{ old('category_name', $uploadItem->category_name ) }}"
									required/>
								@error('category_name')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>
							
							<div class="mb-3">
								<label class="form-label">OEM</label>
								<input type="text" class="form-control @error('oem_name') is-invalid @enderror"
									name="oem_name" id="oem_name" placeholder="OEM"
									value="{{ old('oem_name', $uploadItem->oem_name ) }}"
									required/>
								@error('oem_name')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<div class="mb-3">
								<label class="form-label">UOM</label>
								<input type="text" class="form-control @error('uom_name') is-invalid @enderror"
									name="uom_name" id="uom_name" placeholder="UOM"
									value="{{ old('uom_name', $uploadItem->uom_name ) }}"
									required/>
								@error('uom_name')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<div class="mb-3">
								<label class="form-label">GL Type</label>
								<input type="text" class="form-control @error('gl_type_name') is-invalid @enderror"
									name="gl_type_name" id="gl_type_name" placeholder="UOM"
									value="{{ old('gl_type_name', $uploadItem->gl_type_name ) }}"
									required/> {{ $uploadItem->price }}
								@error('gl_type_name')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<x-tenant.edit.price :value="$uploadItem->price"/>
							<x-tenant.buttons.show.save/>
						</div>
					</div>
				</div>
				<!-- end col-6 -->
			
			</div>


	</form>
	<!-- /.form end -->
@endsection

