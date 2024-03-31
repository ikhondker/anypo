@extends('layouts.app')
@section('title','Edit Uom')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('uoms.index') }}">UoM's</a></li>
	<li class="breadcrumb-item"><a href="{{ route('uoms.show',$uoms->id) }}">{{ $uoms->name }}</a></li>
	<li class="breadcrumb-item active">Edit</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Uom
		@endslot
		@slot('buttons')
			
			<x-tenant.buttons.header.lists object="Uom"/>
			<x-tenant.buttons.header.create object="Uom"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('uoms.update',$uom->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Edit UoM</h5>
							<h6 class="card-subtitle text-muted">Edit Unit of Measure (UOM).</h6>
						</div>
						<div class="card-body">
							<div class="mb-3">
								<label class="form-label">UOM Class</label> <x-tenant.info info="Note: You wont be able to change the UoM Class."/>
								<input type="text" name="uom_class" id="id" class="form-control" placeholder="ID" value="{{ old('uom_class_id', $uom->uom_class->name ) }}" readonly>
							</div>
							<div class="mb-3">
								<label class="form-label">Uom Name</label>
								<input type="text" class="form-control @error('name') is-invalid @enderror"
									name="name" id="name" placeholder="Uom Name"
									value="{{ old('name', $uom->name ) }}"
									/>
								@error('name')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<div class="mb-3">
								<label class="form-label">Conversion </label>
								<input type="number" class="form-control @error('conversion') is-invalid @enderror"
									name="conversion" id="conversion" placeholder="1.0000"
									value="{{ old('conversion', $uom->conversion ) }}"
									step='0.01' min="1" required/>
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
					<div class="card">

					</div>
				</div>
				<!-- end col-6 -->
			</div>


	</form>
	<!-- /.form end -->
@endsection

