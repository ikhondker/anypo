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
		{{-- <x-tenant.info.pol-info polId="{{ $pol->id }}"/> --}}
	@endif

	<!-- form start -->
	<form id="myform" action="{{ route('receipts.store') }}" method="POST" enctype="multipart/form-data">
		@csrf


		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Create Receipt</h5>
						<h6 class="card-subtitle text-muted">Receipt Detail Information.</h6>
					</div>
					<div class="card-body">
						<table class="table table-sm my-2">
							<tbody>
								@if(empty($pol))
									<tr>
										<th>PO Line #</th>
										<td>
											<select class="form-control select2" data-toggle="select2" name="pol_id" id="pol_id" required>
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
									<th>&nbsp;</th>
									<td>
										<div class="row">
											<div class="col-md-4">
												UoM
												<input type="text" class="form-control"
												name="dsp_pol_uom_name" id="dsp_pol_uom_name" value="{{ empty($pol) ? old('dsp_pol_uom_name') : $pol->uom->name }}"
												readonly/>
											</div>
											<div class="col-md-4">
											Ordered Qty :
												<input type="text" class="form-control"
												style="text-align: right;"
												name="dsp_pol_qty" id="dsp_pol_qty" value="{{ empty($pol) ? old('dsp_pol_qty') : number_format($pol->qty,2) }}"
												readonly/>
											</div>
											<div class="col-md-4">
												Received Qty
												<input type="text" class="form-control"
												style="text-align: right;"
												name="dsp_pol_received_qty" id="dsp_pol_received_qty" value="{{ empty($pol) ? old('dsp_pol_received_qty') : number_format($pol->received_qty,2) }}"
												readonly/>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<th>Receive Qty :</th>
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
												<option value="{{ $warehouse->id }}" {{ $warehouse->id == old('warehouse_id') ? 'selected' : '' }} >{{ $warehouse->name }}</option>
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
			</div>
			<!-- end col-6 -->
			<div class="col-6">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Purchase Order Detail</h5>
						<h6 class="card-subtitle text-muted">Purchase Order Detail Information.</h6>
					</div>
					<div class="card-body">
						<table class="table table-sm my-2">
							<tbody>
								<tr>
									<th>Supplier :</th>
									<td>
										<input type="text" class="form-control"
										name="dsp_supplier" id="dsp_supplier" value="{{ empty($pol) ? old('dsp_supplier') : $po->supplier->name }}"
										readonly/>
									</td>
								</tr>
								<tr>
									<th>PO :</th>
									<td>
										<input type="text" class="form-control"
										name="dsp_po_summary" id="dsp_po_summary" value="{{ empty($pol) ? old('dsp_po_summary') : 'PO#'.$pol->po_id .' : '. $pol->po->summary }}"
										readonly/>
									</td>
								</tr>
								<tr>
									<th>PO Date & Amount :</th>
									<td>
										<div class="row">
											<div class="col-md-5">
												<input type="text" class="form-control"
												name="dsp_po_date" id="dsp_po_date" value="{{ empty($pol) ? old('dsp_po_date') :strtoupper(date('d-M-y', strtotime($po->po_date))) }}"
												readonly/>
											</div>
											<div class="col-md-4">
												<input type="text" class="form-control"
													style="text-align: right;"
												name="dsp_po_amount" id="dsp_po_amount" value="{{ empty($pol) ? old('dsp_po_amount') : number_format($po->amount,2) }}"
												readonly/>
											</div>
											<div class="col-md-3">
												<input type="text" class="form-control"
												name="dsp_po_currency" id="dsp_po_currency" value="{{ empty($pol) ? old('dsp_po_currency') : $po->currency }}"
												readonly/>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<th>Department :</th>
									<td>
										<input type="text" class="form-control"
										name="dsp_dept_name" id="dsp_dept_name" value="{{ empty($pol) ? old('dsp_dept_name') : $po->dept->name }}"
										readonly/>
									</td>
								</tr>
								<tr>
									<th>Project :</th>
									<td>
										<input type="text" class="form-control"
										name="dsp_project_name" id="dsp_project_name" value="{{ empty($pol) ? old('dsp_project_name') : $po->project->name }}"
										readonly/>
									</td>
								</tr>
								<tr>
									<th>Buyer Name :</th>
									<td>
										<input type="text" class="form-control"
										name="dsp_buyer_name" id="dsp_buyer_name" value="{{ empty($pol) ? old('dsp_buyer_name') : $po->buyer->name }}"
										readonly/>
									</td>
								</tr>

								@if(empty($pol))

								@else
									<input type="text" name="pol_id" id="pol_id" class="form-control" placeholder="ID" value="{{ old('pol_id', $pol->id ) }}" hidden>
								@endif
							</tbody>
						</table>

					</div>
				</div>
			</div>
			<!-- end col-6 -->
		</div>
		<!-- end row -->

	</form>
	<!-- /.form end -->
	@if(!empty($pol))
		{{-- <x-tenant.widgets.pol.pol-receipts :id="$pol->id" /> --}}
	@endif


	<script type="module">
		$(document).ready(function () {
			$('#pol_id').change(function() {
				//alert($('option:selected').text());
				let id = $(this).val();
				let url = '{{ route("pols.get-pol", ":id") }}';
				url = url.replace(':id', id);
				$.ajax({
					url: url,
					type: 'get',
					dataType: 'json',
					// delay: 250,
					success: function(response) {
						if (response != null) {
							$('#dsp_supplier').val(response.supplier_name);
							$('#dsp_po_summary').val(response.po_summary);
							$('#dsp_po_date').val(response.po_date);
							$('#dsp_po_amount').val(response.po_amount);
							$('#dsp_po_currency').val(response.po_currency);

							$('#dsp_pol_qty').val(response.pol_qty);
							$('#dsp_pol_received_qty').val(response.pol_received_qty);
							$('#dsp_pol_uom_name').val(response.pol_uom_name);

							$('#dsp_dept_name').val(response.dept_name);
							$('#dsp_project_name').val(response.project_name);
							$('#dsp_buyer_name').val(response.buyer_name);
						}
					}
				});

			});

		});
	</script>


	@include('tenant.includes.js.select2')

@endsection
