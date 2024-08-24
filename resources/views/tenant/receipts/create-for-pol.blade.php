@extends('layouts.tenant.app')
@section('title','Create Receipt')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('pos.index') }}" class="text-muted">Purchase Orders</a></li>
	<li class="breadcrumb-item"><a href="{{ route('pos.show',$pol->po_id) }}" class="text-muted">PO #{{ $pol->po_id }}</a></li>
	{{-- <li class="breadcrumb-item"><a href="{{ route('pos.show',$pol->po_id) }}">PO #{{ $pol->po_id }}</a></li> --}}
	<li class="breadcrumb-item active">Line #{{ $pol->line_num }}</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Receipt for a Purchase Order Line
		@endslot
		@slot('buttons')

			<x-tenant.buttons.header.lists object="Receipt"/>
			<x-tenant.buttons.header.lists object="Po" label="Purchase Order"/>
			<x-tenant.actions.pol-actions polId="{{ $pol->id }}"/>

		@endslot
	</x-tenant.page-header>

	<x-tenant.info.pol-info polId="{{ $pol->id }}"/>

	<!-- form start -->
	<form id="myform" action="{{ route('receipts.store') }}" method="POST" enctype="multipart/form-data">
		@csrf
		<input type="text" name="pol_id" id="pol_id" class="form-control" placeholder="ID" value="{{ old('pol_id', $pol->id ) }}" hidden>

		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Create Receipt</h5>
			</div>
			<div class="card-body">

				<table class="table table-sm my-2">
					<tbody>

						<tr>
							<th>Item</th>
							<td>
								<input type="text" class="form-control @error('pol_summary') is-invalid @enderror"
								name="pol_summary" id="pol_summary" placeholder=""
								value="{{ old('pol_summary', $pol->item_description ) }}"
								readonly/>
							@error('pol_summary')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
							</td>
						</tr>


						<tr>
							<th>Qty ({{ $pol->uom->name }})</th>
							<td>
								<input type="number" class="form-control @error('qty') is-invalid @enderror"
								name="qty" id="qty" placeholder="99,999.99"
								value="{{ old('qty', '1.00' ) }}"
								step='0.01' min="1" required/>
							@error('qty')
								<div class="text-danger text-xs">{{ $message }}</div>
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
									<div class="text-danger text-xs">{{ $message }}</div>
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

	<x-tenant.widgets.pol.pol-receipts :id="$pol->id" />

@endsection
