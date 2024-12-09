@extends('layouts.tenant.app')
@section('title','Edit Uom')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('uoms.index') }}" class="text-muted">UoM's</a></li>
	<li class="breadcrumb-item">{{ $uom->name }}</li>
	<li class="breadcrumb-item active">Edit</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Uom
		@endslot
		@slot('buttons')
			<x-tenant.actions.lookup.uom-actions uomId="{{ $uom->id }}"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('uoms.update',$uom->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('uoms.create') }}" class="btn btn-sm btn-light"><i data-lucide="plus"></i> Create</a>
					{{-- <a href="{{ route('uoms.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a> --}}
				</div>
				<h5 class="card-title">Edit UoM</h5>
				<h6 class="card-subtitle text-muted">Edit Unit of Measure (UOM).</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>

						<tr>
							<th>UOM Class <x-tenant.info info="Note: You wont be able to change the UoM Class."/></th>
							<td>
								<input type="text" name="uom_class" id="id"
								class="form-control" placeholder="ID"
								value="{{ old('uom_class_id', $uom->uom_class->name ) }}" readonly>
							</td>
						</tr>
						<x-tenant.edit.name :value="$uom->name"/>
						<tr>
							<th>Conversion :</th>
							<td>
								<input type="number" class="form-control @error('conversion') is-invalid @enderror"
								name="conversion" id="conversion" placeholder="1.0000"
								value="{{ old('conversion', $uom->conversion ) }}"
								step='0.01' min="1" required/>
							@error('conversion')
								<div class="small text-danger">{{ $message }}</div>
							@enderror
							</td>
						</tr>
						<x-tenant.edit.save/>
					</tbody>
				</table>
			</div>
		</div>
	</form>
	<!-- /.form end -->

	<x-tenant.widgets.back-to-list model="Uom"/>

@endsection

