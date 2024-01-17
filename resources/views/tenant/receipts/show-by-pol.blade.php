@extends('layouts.app')
@section('title','Create Receipt')
@section('breadcrumb','Create Receipt')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Payments
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.save/>
			<x-tenant.buttons.header.lists object="Receipt"/>
		@endslot
	</x-tenant.page-header> 

	<!-- form start -->
	<form id="myform" action="{{ route('receipts.store') }}" method="POST" enctype="multipart/form-data">
		@csrf
		<input type="text" name="pol_id" id="pol_id" class="form-control" placeholder="ID" value="{{ old('pol_id', $pol->id ) }}" hidden>
		

		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Receipt Info</h5>
					</div>
					<div class="card-body">

						{{-- <div class="mb-3">
							<label class="form-label">Particulars</label>
							<input type="text" class="form-control @error('summary') is-invalid @enderror"
								name="summary" id="summary" placeholder="Summary"
								value="{{ old('summary', '' ) }}"
								required/>
							@error('summary')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div> --}}

						<div class="mb-3">
							<label class="form-label">Warehouse</label>
							<select class="form-control" name="warehouse_id" required>
								<option value=""><< Warehouse >> </option>
								@foreach ($warehouses as $warehouse)
									<option value="{{ $warehouse->id }}" {{ $warehouse->id == old('warehouse_id') ? 'selected' : '' }} >{{ $warehouse->name }} </option>
								@endforeach
							</select>
							@error('warehouse_id')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>


						<div class="mb-3">
							<label class="form-label">Qty</label>
							<input type="number" class="form-control @error('qty') is-invalid @enderror"
								name="qty" id="qty" placeholder="99,999.99"
								value="{{ old('qty', '1.00' ) }}"
								step='0.01' min="1" required/>
							@error('qty')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<x-tenant.create.notes/>

						<x-tenant.attachment.create/>

						<x-tenant.widgets.submit/>
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
	
	<x-tenant.widgets.po-line-receipts :id="$pol->id" />

@endsection