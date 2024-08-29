@extends('layouts.tenant.app')
@section('title','Edit Invoice')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('pos.show',$invoice->po_id) }}" class="text-muted">PO #{{ $invoice->po_id }}</a></li>
	<li class="breadcrumb-item"><a href="{{ route('pos.invoices', $invoice->po_id) }}" class="text-muted">PO Invoices</a></li>
	<li class="breadcrumb-item"><a href="{{ route('invoices.show', $invoice->id) }}" class="text-muted">{{ $invoice->invoice_no }}</a></li>
	<li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Invoice
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Invoice"/>
			<x-tenant.actions.invoice-actions invoiceId="{{ $invoice->id }}" show="true"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('invoices.update',$invoice->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Edit Invoice Basic Information</h5>
						<h6 class="card-subtitle text-muted">Edit Invoice Basic Information.</h6>
					</div>
					<div class="card-body">

						<table class="table table-sm my-2">
							<tbody>

								<tr>
									<th>PO # {{ $invoice->po_id }}</th>
									<td>
										<input type="text" class="form-control @error('po_summary') is-invalid @enderror"
										name="po_summary" id="po_summary" placeholder="Summary"
										value="{{ $invoice->po->summary }}"
										readonly/>
									@error('po_summary')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
									</td>
								</tr>
		
		
								<tr>
									<th>Invoice No</th>
									<td>
										<input type="text" class="form-control @error('invoice_no') is-invalid @enderror"
										name="invoice_no" id="invoice_no" placeholder="XXXXX"
										style="text-transform: uppercase"
										value="{{ old('invoice_no', $invoice->invoice_no ) }}"
										required/>
									@error('invoice_no')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
									</td>
								</tr>
		
								<tr>
									<th>Invoice Date</th>
									<td>
										<input type="date" class="form-control @error('invoice_date') is-invalid @enderror"
										name="invoice_date" id="invoice_date" placeholder=""
										value="{{ old('invoice_date', date('Y-m-d',strtotime($invoice->invoice_date)) ) }}"
										required/>
									@error('invoice_date')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
									</td>
								</tr>
		
								<tr>
									<th>Particulars</th>
									<td>
										<input type="text" class="form-control @error('summary') is-invalid @enderror"
										name="summary" id="summary" placeholder="Summary"
										value="{{ old('summary', $invoice->summary ) }}"
										required/>
									@error('summary')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
									</td>
								</tr>

								<x-tenant.edit.currency :value="$invoice->currency"/>

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
							{{-- <a href="{{ route('prs.create') }}" class="btn btn-sm btn-light"><i class="fas fa-plus"></i> Create</a>
							<a href="{{ route('prs.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a> --}}
						</div>
						<h5 class="card-title">Edit Requisition Additional Info</h5>
						<h6 class="card-subtitle text-muted">Edit Requisition Additional Info.</h6>
					</div>
					<div class="card-body">

						<table class="table table-sm my-2">
							<tbody>

								<tr>
									<th>Amount ({{ $invoice->currency }})</th>
									<td>
										<input type="number" class="form-control @error('amount') is-invalid @enderror"
										name="amount" id="amount" placeholder="99,999.99"
										value="{{ old('amount', $invoice->amount ) }}"
										step='0.01' min="1" required/>
									@error('amount')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
									</td>
								</tr>
		
								<x-tenant.create.notes/>
								<tr>
									<th>Invoice PoC</th>
									<td>
										<select class="form-control" name="poc_id" required>
											<option value=""><< PoC Name >> </option>
											@foreach ($pocs as $user)
												<option {{ $user->id == old('poc_id',$invoice->poc_id) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }} </option>
											@endforeach
										</select>
										@error('poc_id')
											<div class="text-danger text-xs">{{ $message }}</div>
										@enderror
									</td>
								</tr>
		
		
								<x-tenant.edit.save/>

								
							</tbody>
						</table>

					</div>
				</div>
			</div>
			<!-- end col-6 -->
		</div>

		<x-tenant.widgets.invoice-line.list-all-lines invoiceId="{{ $invoice->id }}"/>

		<div class="float-end">
			<a class="btn btn-secondary text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel" href="{{ route('prs.show',$invoice->id) }}"><i data-lucide="x-circle"></i> Cancel</a>
			<button type="submit" id="submit" name="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Save"><i data-lucide="save"></i> Save</button>
		</div>

		

	</form>
	<!-- /.form end -->
@endsection

