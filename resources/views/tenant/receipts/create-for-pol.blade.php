@extends('layouts.app')
@section('title','Create Receipt')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('receipts.index') }}">Receipts TODO</a></li>
	<li class="breadcrumb-item"><a href="{{ route('receipts.index') }}">TODO POL</a></li>
	<li class="breadcrumb-item active">Create Receipt</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Receipt for a Purchase Order Line
		@endslot
		@slot('buttons')

			<x-tenant.buttons.header.lists object="Receipt"/>
			<x-tenant.buttons.header.lists object="Po" label="Purchase Order"/>
			<x-tenant.actions.pol-actions id="{{ $pol->id }}"/>

		@endslot
	</x-tenant.page-header> 

	<x-tenant.info.pol-info id="{{ $pol->id }}"/>
		
	<!-- form start -->
	<form id="myform" action="{{ route('receipts.store') }}" method="POST" enctype="multipart/form-data">
		@csrf
		<input type="text" name="pol_id" id="pol_id" class="form-control" placeholder="ID" value="{{ old('pol_id', $pol->id ) }}" hidden>
		
		<div class="row">
			<div class="col-12">
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
							<label class="form-label">Item</label>
							<input type="text" class="form-control @error('pol_summary') is-invalid @enderror"
								name="pol_summary" id="pol_summary" placeholder=""
								value="{{ old('pol_summary',  $pol->summary ) }}"
								readonly/>
							@error('pol_summary')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>


						<div class="mb-3">
							<label class="form-label">Qty ({{ $pol->uom->name  }})</label>
							<input type="number" class="form-control @error('qty') is-invalid @enderror"
								name="qty" id="qty" placeholder="99,999.99"
								value="{{ old('qty', '1.00' ) }}"
								step='0.01' min="1" required/>
							@error('qty')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label class="form-label">Warehouse </label>
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

						<x-tenant.create.notes/>

						<x-tenant.attachment.create/>

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
	
	<x-tenant.widgets.pol.pol-receipts :id="$pol->id" />

@endsection