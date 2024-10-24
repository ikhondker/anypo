@extends('layouts.tenant.app')
@section('title','Create Invoice')
@section('breadcrumb')
	@if(!empty($po))
		<li class="breadcrumb-item"><a href="{{ route('pos.show',$po->id) }}" class="text-muted">PO#{{ $po->id }}</a></li>
		<li class="breadcrumb-item"><a href="{{ route('pos.invoices', $po->id) }}" class="text-muted">PO Invoices</a></li>
	@endif

	<li class="breadcrumb-item active">Create</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Invoice
			@if(!empty($po))
				for PO #{{ $po->id }}
			@endif
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Po" label="Purchase Order"/>
			@if(!empty($po))
				<x-tenant.actions.po-actions poId="{{ $po->id }}" show="true"/>
			@endif
		@endslot
	</x-tenant.page-header>

	{{-- @include('tenant.includes.po.view-po-header') --}}
	{{-- <x-tenant.info.po-info poId="{{ $po->id }}"/> --}}
	{{-- <x-tenant.widgets.po.invoices :id="$po->id" /> --}}

	<!-- form start -->
	<form id="myform" action="{{ route('invoices.store') }}" method="POST" enctype="multipart/form-data">
		@csrf


		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header">
						<div class="card-actions float-end">
							@if(!empty($po))
								<a class="btn btn-sm btn-light" href="{{ route('pos.invoices', $po->id) }}" ><i class="fas fa-list"></i> View Invoices</a>
							@endif

						</div>
						<h5 class="card-title">Create Invoice For a Purchase Order</h5>
						<h6 class="card-subtitle text-muted">Create Invoice For a Purchase Order.</h6>
					</div>
					<div class="card-body">
						<table class="table table-sm my-2">
							<tbody>
								@if(empty($po))
									<tr>
										<th>PO #</th>
										<td>
											<select class="form-control select2" data-toggle="select2" name="po_id" id="po_id" required>
												<option value=""><< Select PO >> </option>
												@foreach ($pos as $poN)
													<option value="{{ $poN->id }}" {{ $poN->id == old('po_id') ? 'selected' : '' }} >{{ $poN->summary }} -PO#{{ $poN->id }} </option>
												@endforeach
											</select>
											@error('po_id')
												<div class="small text-danger">{{ $message }}</div>
											@enderror
										</td>
									</tr>
									<tr>
										<th>Supplier :</th>
										<td>
											<input type="text" class="form-control"
											name="dsp_supplier" id="dsp_supplier" value=""
											readonly/>
										</td>
									</tr>
								@else
									<input type="text" name="po_id" id="po_id" class="form-control" placeholder="ID" value="{{ old('po_id', $po->id ) }}" hidden>
									<tr>
										<th>PO # :</th>
										<td>
											<input type="text" class="form-control"
											name="dsp_po_id" id="dsp_po_id" value="{{ old('po_id', $po->id ) }}"
											readonly/>
										</td>
									</tr>
									<tr>
										<th>Supplier :</th>
										<td>
											<input type="text" class="form-control"
											name="dsp_supplier" id="dsp_supplier" value="{{ $po->supplier->name }}"
											readonly/>
										</td>
									</tr>
								@endif

								<tr>
									<th>Invoice No :</th>
									<td>
										<input type="text" class="form-control @error('invoice_no') is-invalid @enderror"
										name="invoice_no" id="invoice_no" placeholder="XXXXX"
										style="text-transform: uppercase"
										value="{{ old('invoice_no', '' ) }}"
										required/>
									@error('invoice_no')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
									</td>
								</tr>
								<tr>
									<th>Invoice Date :</th>
									<td>
										<input type="date" class="form-control @error('invoice_date') is-invalid @enderror"
										name="invoice_date" id="invoice_date" placeholder=""
										value="{{ old('invoice_date', date('Y-m-d') ) }}"
										required/>
									@error('invoice_date')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
									</td>
								</tr>
								<tr>
									<th>Particulars :</th>
									<td>
										<input type="text" class="form-control @error('summary') is-invalid @enderror"
										name="summary" id="summary" placeholder="Summary"
										value="{{ old('summary', '' ) }}"
										required/>
									@error('summary')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
									</td>
								</tr>
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
							@if(!empty($po))
								<a class="btn btn-sm btn-light" href="{{ route('pos.invoices', $po->id) }}" ><i class="fas fa-list"></i> View Invoices</a>
							@endif
						</div>
						<h5 class="card-title">Create Invoice For a Purchase Order</h5>
						<h6 class="card-subtitle text-muted">Create Invoice For a Purchase Order.</h6>
					</div>
					<div class="card-body">
						<table class="table table-sm my-2">
							<tbody>
								@if(!empty($po))
									<tr>
										<th>Currency :</th>
										<td>
											<input type="text" class="form-control"
											name="dsp_po_currency" id="dsp_po_currency" value="{{ $po->currency }}"
											readonly/>
										</td>
									</tr>
								@else
									 <tr>
										<th>Currency :</th>
										<td>
											<input type="text" class="form-control"
											name="dsp_po_currency" id="dsp_po_currency" value=""
											readonly/>
										</td>
									</tr>
								@endif
								<tr>
									<th>Invoice PoC :</th>
									<td>
										<select class="form-control" name="poc_id" required>
											<option value=""><< PoC Name >> </option>
											@foreach ($pocs as $user)
												<option value="{{ $user->id }}" {{ $user->id == old('poc_id') ? 'selected' : '' }} >{{ $user->name }} </option>
											@endforeach
										</select>
										@error('poc_id')
											<div class="small text-danger">{{ $message }}</div>
										@enderror
									</td>
								</tr>
								<x-tenant.create.notes/>
								<x-tenant.attachment.create/>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- end col-6 -->
		</div>
		<!-- end row -->

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<div class="form-check form-switch">
						<input class="form-check-input m-1" type="checkbox" id="add_row" name="add_row" checked>
						<label class="form-check-label" for="add_row">... add another Line</label>
					</div>
				</div>
				<h5 class="card-title">Invoice Lines</h5>
				<h6 class="card-subtitle text-muted">List of Invoice Lines.</h6>
			</div>

			<table class="table table-striped table-sm">
				<thead>
					<tr>
						<th class="text-center" style="width:3%">#</th>
						<th class="" style="width:37%">Description</th>
						<th class="text-end" style="width:10%">Qty</th>
						<th class="text-end" style="width:10%">Price</th>
						<th class="text-end" style="width:10%">Subtotal</th>
						<th class="text-end" style="width:10%">Tax</th>
						<th class="text-end" style="width:10%">GST</th>
						<th class="text-end" style="width:10%">Amount</th>
					</tr>
				</thead>
				<tbody>
					@include('tenant.includes.invoice.invoice-line-add')
					<tr class="">
						<td colspan="7" class="text-end">
							<strong>TOTAL:</strong>
						</td>
						<td class="text-end">
							<input type="text" class="form-control @error('invoice_amount') is-invalid @enderror"
								style="text-align: right;"
								name="invoice_amount" id="invoice_amount" placeholder="0.00"
								value="{{ old('invoice_amount', (isset($pr->amount) ? number_format($invoice->amount,2) : "0.00")) }}"
								readonly>
							@error('invoice_amount')
									<div class="small text-danger">{{ $message }}</div>
							@enderror
						</td>
					</tr>
				</tbody>
			</table>

			<div class="card-footer">
				<div class="card-actions float-end">
					<a class="btn btn-secondary text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel" href="{{ route('prs.index') }}"><i data-lucide="x-circle"></i> Cancel</a>
					<button type="submit" id="submit" name="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Save"><i data-lucide="save"></i> Save</button>
				</div>
			</div>
		</div>
		<!-- end card -->

	</form>
	<!-- /.form end -->

	@if(!empty($po))
		{{-- <x-tenant.widgets.po.invoices poId="{{ $po->id }}" /> --}}
	@endif

	@include('tenant.includes.js.select2')
	@include('tenant.includes.js.calculate-invoice-amount')
@endsection
