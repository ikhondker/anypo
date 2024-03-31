@extends('layouts.app')
@section('title','Edit Invoice')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('receipts.index') }}">Receipts TODO</a></li>
	<li class="breadcrumb-item"><a href="{{ route('receipts.index') }}">TODO POL</a></li>
	<li class="breadcrumb-item active">Receipt</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Invoice
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Invoice"/>
			<x-tenant.buttons.header.lists object="Po" label="Purchase Order"/>
			<x-tenant.actions.invoice-actions id="{{ $invoice->id }}" show="true"/>
		
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

						<div class="mb-3">
							<label class="form-label">PO # {{ $invoice->po_id }}</label>
							<input type="text" class="form-control @error('po_summary') is-invalid @enderror"
								name="po_summary" id="po_summary" placeholder="Summary"
								value="{{ $invoice->po->summary }}"
								readonly/>
							@error('po_summary')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>


						<div class="mb-3">
							<label class="form-label">Invoice No</label>
							<input type="text" class="form-control @error('invoice_no') is-invalid @enderror"
								name="invoice_no" id="invoice_no" placeholder="XXXXX"
								style="text-transform: uppercase"
								value="{{ old('invoice_no', $invoice->invoice_no ) }}"
								required/>
							@error('invoice_no')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label class="form-label">Invoice Date</label>
							<input type="date" class="form-control @error('invoice_date') is-invalid @enderror"
								name="invoice_date" id="invoice_date" placeholder=""
								value="{{ old('invoice_date', date('Y-m-d',strtotime($invoice->invoice_date)) ) }}"
								required/>
							@error('invoice_date')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label class="form-label">Particulars</label>
							<input type="text" class="form-control @error('summary') is-invalid @enderror"
								name="summary" id="summary" placeholder="Summary"
								value="{{ old('summary', $invoice->summary ) }}"
								required/>
							@error('summary')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						
					
					</div>
				</div>
			</div>
			<!-- end col-6 -->
			<div class="col-6">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Edit Invoice Amount</h5>
						<h6 class="card-subtitle text-muted">Edit Invoice Amount Information.</h6>
					</div>
					<div class="card-body">

						<div class="mb-3">
							<label class="form-label">Amount ({{ $invoice->currency }})</label>
							<input type="number" class="form-control @error('amount') is-invalid @enderror"
								name="amount" id="amount" placeholder="99,999.99"
								value="{{ old('amount', $invoice->amount ) }}"
								step='0.01' min="1" required/>
							@error('amount')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>
						<x-tenant.create.notes/>
						<div class="mb-3">
							<label class="form-label">Invoice PoC</label>
							<select class="form-control" name="poc_id" required>
								<option value=""><< PoC Name >> </option>
								@foreach ($pocs as $user)
									<option {{ $user->id == old('poc_id',$invoice->poc_id) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }} </option>
								@endforeach
							</select>
							@error('poc_id')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>
						
						<x-tenant.buttons.show.save/>
					</div>
				</div>
			</div>
			<!-- end col-6 -->
		</div>
		<!-- end row -->

	</form>
	<!-- /.form end -->
@endsection

