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
							<x-tenant.edit.name :value="$uploadItem->name"/>

							<div class="mb-3">
								<label class="form-label">CODE</label>
								<input type="text" class="form-control @error('code') is-invalid @enderror"
									name="code" id="code" placeholder="XXXXX"
									value="{{ old('code', $uploadItem->code ) }}"
									required/>
								@error('code')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<div class="mb-3">
								<label class="form-label">Category</label>
								<input type="text" class="form-control @error('category') is-invalid @enderror"
									name="category" id="category" placeholder="Category"
									value="{{ old('category', $uploadItem->category ) }}"
									required/>
								@error('category')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>
							<div class="mb-3">
								<label class="form-label">UOM</label>
								<input type="text" class="form-control @error('uom') is-invalid @enderror"
									name="uom" id="uom" placeholder="UOM"
									value="{{ old('uom', $uploadItem->uom ) }}"
									required/>
								@error('uom')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>
							<div class="mb-3">
								<label class="form-label">OEM</label>
								<input type="text" class="form-control @error('oem') is-invalid @enderror"
									name="oem" id="oem" placeholder="OEM"
									value="{{ old('oem', $uploadItem->oem ) }}"
									required/>
								@error('oem')
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

