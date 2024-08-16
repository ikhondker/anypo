@extends('layouts.tenant.app')
@section('title','Uom')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('uoms.index') }}" class="text-muted">UoM's</a></li>
	<li class="breadcrumb-item active">Create</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Uom
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Uom"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('uoms.store') }}" method="POST" enctype="multipart/form-data">
		@csrf


		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('uoms.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
				</div>
				<h5 class="card-title">Create UoM</h5>
						<h6 class="card-subtitle text-muted">Create Unit of Measure (UoM) and conversion factor.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>

						<tr>
							<th>UoM Class</th>
							<td>
								<select class="form-control" name="uom_class_id" required>
									<option value=""><< UoM Class >> </option>
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
							<th>Conversion Factor</th>
							<td>
								<input type="number" class="form-control @error('conversion') is-invalid @enderror"
								name="conversion" id="conversion" placeholder="99,99,999.99"
								step='0.01' min="1" value="{{ old('conversion', '1.00' ) }}"
								required/>
							@error('conversion')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
							</td>
						</tr>

						<x-tenant.create.name/>

                        <x-tenant.create.save/>

					</tbody>
				</table>
			</div>
		</div>

	</form>
	<!-- /.form end -->

@endsection
