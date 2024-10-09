@extends('layouts.tenant.app')
@section('title','Create Purchase Order')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('pos.index') }}" class="text-muted">Purchase Orders</a></li>
	<li class="breadcrumb-item active">Create</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Purchase Order
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Po" label="Purchase Order"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('pos.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Purchase Order Basic Information</h5>
						<h6 class="card-subtitle text-muted">Purchase Order Basic Information.</h6>
					</div>
					<div class="card-body">

						<table class="table table-sm my-2">
							<tbody>

								<tr>
									<th width="20%">PO Summary :</th>
									<td>
										<input type="text" class="form-control @error('summary') is-invalid @enderror"
										name="summary" id="summary" placeholder="PO summary"
										value="{{ old('summary', '' ) }}"
										required/>
									@error('summary')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
									</td>
								</tr>

								<tr>
									<th>PO Date :</th>
									<td>
										<div class="col-sm-9">
											<input type="text" class="form-control"
											name="dsp_date" id="dsp_date" value="{{ now() }}"
											readonly/>
									</td>
								</tr>


								@if ( auth()->user()->role->value == UserRoleEnum::USER->value || auth()->user()->role->value == UserRoleEnum::HOD->value )
									<input type="text" name="dept_id" id="dept_id" class="form-control" placeholder="ID" value="{{ auth()->user()->dept_id }}" hidden>
								@else
									<tr>
										<th>Dept Name :</th>
										<td>
												<select class="form-control select2" data-toggle="select2" name="dept_id" required>
												<option value=""><< Dept >> </option>
												@foreach ($depts as $dept)
													<option value="{{ $dept->id }}" {{ $dept->id == old('dept_id') ? 'selected' : '' }} >{{ $dept->name }} </option>
												@endforeach
											</select>
											@error('dept_id')
												<div class="small text-danger">{{ $message }}</div>
											@enderror

										</td>
									</tr>
								@endif
								<tr>
									<th>Supplier :</th>
									<td>
										<select class="form-control select2" data-toggle="select2" name="supplier_id" required>
											<option value=""><< Supplier >> </option>
											@foreach ($suppliers as $supplier)
												<option value="{{ $supplier->id }}" {{ $supplier->id == old('supplier_id') ? 'selected' : '' }} >{{ $supplier->name }} </option>
											@endforeach
										</select>
										@error('supplier_id')
											<div class="small text-danger">{{ $message }}</div>
										@enderror
									</td>
								</tr>

								<tr>
									<th>Project :</th>
									<td>
										<div class="col-sm-9">
											<select class="form-control select2" data-toggle="select2" name="project_id" required>
												<option value=""><< Project >> </option>
												@foreach ($projects as $project)
													<option value="{{ $project->id }}" {{ $project->id == old('project_id') ? 'selected' : '' }} >{{ $project->name }} </option>
												@endforeach
											</select>
											@error('project_id')
												<div class="small text-danger">{{ $message }}</div>
											@enderror
										</div>
									</td>
								</tr>

								<x-tenant.create.currency/>
							</tbody>
						</table>

					</div>
				</div>
			</div>
			<!-- end col-6 -->
			<div class="col-6">
				<div class="card">
					<div class="card-header">
						<div class="card-actions float-end">

						</div>
						<h5 class="card-title">Purchase Order Additional Info</h5>
						<h6 class="card-subtitle text-muted">Purchase Order Additional Information.</h6>
					</div>
					<div class="card-body">
						<table class="table table-sm my-2">
							<tbody>

								<tr>
									<th>Need By Date :</th>
									<td>
										<input type="date" class="form-control @error('need_by_date') is-invalid @enderror"
										name="need_by_date" id="need_by_date" placeholder=""
										value="{{ old('need_by_date', date('Y-m-d') ) }}"
										required/>
									@error('need_by_date')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
									</td>
								</tr>

								<tr>
									<th>Terms and Conditions :</th>
									<td>
										<textarea class="form-control" name="notes" placeholder="Enter ..." rows="4">{{ old('notes', 'Enter ...') }}</textarea>
										@error('notes')
											<div class="small text-danger">{{ $message }}</div>
										@enderror
										<div class="form-check form-switch">
											<input class="form-check-input mt-2" type="checkbox" id="tc" name="tc">
											<label class="form-check-label mt-1" for="tc">... include standard PO<a class="" data-bs-toggle="modal" data-bs-target="#exampleModal" href="#"> Terms and Conditions</a>.</label>
										</div>
									</td>
								</tr>
								<x-tenant.attachment.create />
								<tr>
									<th>Buyer :</th>
									<td>
										<input type="text" class="form-control"
										name="requestor" id="requestor"
										value="{{ auth()->user()->name }}"
										readonly/>
									</td>
								</tr>
							</tbody>
						</table>

					</div>
				</div>
			</div>
			<!-- end col-6 -->
		</div>
		<!-- end row -->

		{{-- ================================================================== --}}
		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<div class="dropdown position-relative">
						<div class="form-check form-switch">
							<input class="form-check-input m-1" type="checkbox" id="add_row" name="add_row" checked>
							<label class="form-check-label" for="add_row">... add another row</label>
						</div>
					</div>
				</div>
				<h5 class="card-title">Purchase Order Lines</h5>
				<h6 class="card-subtitle text-muted">List of Purchase Order Lines.</h6>
			</div>
			<table class="table table-striped table-sm">
				<thead>
					<tr>
						<th class="" style="width:1%">LN#</th>
						<th class="" style="width:15%" >Item</th>
						<th class="" style="width:25%">Description</th>
						<th class="" style="width:8%">UOM</th>
						<th class="text-end" style="width:6%">Qty</th>
						<th class="text-end" style="width:9%">Price</th>
						<th class="text-end" style="width:9%">Subtotal</th>
						<th class="text-end" style="width:9%">Tax</th>
						<th class="text-end" style="width:9%">GST</th>
						<th class="text-end" style="width:9%">Amount</th>
					</tr>
				</thead>

				<!-- pol lines -->
				<tbody>
					@include('tenant.includes.po.po-line-add')
					<!-- Table footer i.e. Totals -->
					<tr class="">
						<td colspan="9" class="text-end">
							<strong>TOTAL:</strong>
						</td>
						<td class="text-end">
							<input type="number" step='0.01' min="1" class="form-control @error('po_amount') is-invalid @enderror"
								style="text-align: right;"
								name="po_amount" id="po_amount" placeholder="1.00"
								value="{{ old('po_amount', isset($po->amount) ? number_format($po->amount,2) : "0.00") }}"
								required readonly>
							@error('po_amount')
									<div class="small text-danger">{{ $message }}</div>
							@enderror
						</td>
					</tr>
					<!-- End Table footer i.e. Totals -->
				</tbody>
				<!-- pol lines -->

			</table>
			<div class="card-footer">
				<div class="card-actions float-end">
					<a class="btn btn-secondary text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel" href="{{ route('pos.index') }}"><i data-lucide="x-circle"></i> Cancel</a>
					<button type="submit" id="submit" name="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Save"><i data-lucide="save"></i> Save</button>
				</div>
			</div>

		</div>

	</form>
	<!-- /.form end -->

	@include('tenant.includes.js.select2')

@endsection
