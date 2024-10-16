@extends('layouts.tenant.app')
@section('title','Create Receipt')
@section('breadcrumb')
	@if(!empty($pol))
		<li class="breadcrumb-item"><a href="{{ route('pos.index') }}" class="text-muted">Purchase Orders</a></li>
		<li class="breadcrumb-item"><a href="{{ route('pos.show',$pol->po_id) }}" class="text-muted">PO #{{ $pol->po_id }}</a></li>
		{{-- <li class="breadcrumb-item"><a href="{{ route('pos.show',$pol->po_id) }}">PO #{{ $pol->po_id }}</a></li> --}}
		<li class="breadcrumb-item active">Line #{{ $pol->line_num }}</li>
	@endif
	<li class="breadcrumb-item active">Receipt</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Receipt for a Purchase Order Line
		@endslot
		@slot('buttons')

			<x-tenant.buttons.header.lists object="Receipt"/>
			@if(!empty($pol))
				<x-tenant.actions.pol-actions polId="{{ $pol->id }}"/>
			@endif

		@endslot
	</x-tenant.page-header>

	@if(!empty($pol))
		<x-tenant.info.pol-info polId="{{ $pol->id }}"/>
	@endif

	<!-- form start -->
	<form id="myform" action="{{ route('receipts.store') }}" method="POST" enctype="multipart/form-data">
		@csrf


		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Create Receipt</h5>
			</div>
			<div class="card-body">

				<table class="table table-sm my-2">
					<tbody>

						@if(empty($pol))
							<tr>
								<th>PO Line #</th>
								<td>
									<select class="form-control select2" data-toggle="select2" name="pol_id" required>
										<option value=""><< Open PO Lines >> </option>
										@foreach ($pols as $polN)
											<option value="{{ $polN->id }}" {{ $polN->id == old('pol_id') ? 'selected' : '' }} >PO#{{ $polN->po->id }} Line# {{ $polN->line_num }} - {{ $polN->item_description }}</option>
										@endforeach
									</select>
									@error('pol_id')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
								</td>
							</tr>
						@else
							<input type="text" name="pol_id" id="pol_id" class="form-control" placeholder="ID" value="{{ old('pol_id', $pol->id ) }}" hidden>
							<tr>
								<th>Item</th>
								<td>
									<input type="text" class="form-control @error('pol_summary') is-invalid @enderror"
									name="pol_summary" id="pol_summary" placeholder=""
									value="{{ old('pol_summary', $pol->item_description ) }}"
									readonly/>
								@error('pol_summary')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
								</td>
							</tr>
						@endif
						<tr>
							<th>Qty
								@if(!empty($pol))
									({{ $pol->uom->name }})
								@endif
							</th>
							<td>
								<input type="number" class="form-control @error('qty') is-invalid @enderror"
								name="qty" id="qty" placeholder="99,999.99"
								value="{{ old('qty', '1.00' ) }}"
								step='0.01' min="1" required/>
							@error('qty')
								<div class="small text-danger">{{ $message }}</div>
							@enderror
							</td>
						</tr>

						<tr>
							<th>Warehouse</th>
							<td>
								<select class="form-control" name="warehouse_id" required>
									<option value=""><< Warehouse >> </option>
									@foreach ($warehouses as $warehouse)
										<option value="{{ $warehouse->id }}" {{ $warehouse->id == old('warehouse_id') ? 'selected' : '' }} >{{ $warehouse->name }} </option>
									@endforeach
								</select>
								@error('warehouse_id')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</td>
						</tr>


						<x-tenant.create.notes/>

						<x-tenant.attachment.create/>

						<x-tenant.create.save/>
					</tbody>
				</table>

			</div>
		</div>


	</form>
	<!-- /.form end -->
	@if(!empty($pol))
		<x-tenant.widgets.pol.pol-receipts :id="$pol->id" />
	@endif

	@include('tenant.includes.js.select2')

@endsection
