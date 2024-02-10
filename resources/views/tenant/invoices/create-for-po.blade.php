@extends('layouts.app')
@section('title','Create Invoice')
@section('breadcrumb','Create Invoice')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Invoices for PO #{{ $po->id }}
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.save/>
			<x-tenant.buttons.header.lists object="Invoice"/>
		@endslot
	</x-tenant.page-header> 


	@include('tenant.includes.po.view-po-header')
	
	<x-tenant.widgets.po.invoices :id="$po->id" />

	<!-- form start -->
	<form id="myform" action="{{ route('invoices.store') }}" method="POST" enctype="multipart/form-data">
		@csrf
		<input type="text" name="po_id" id="po_id" class="form-control" placeholder="ID" value="{{ old('po_id', $po->id ) }}" hidden>
		
		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Invoice Info</h5>
					</div>
					<div class="card-body">

						<div class="mb-3">
							<label class="form-label">Invoice No</label>
							<input type="text" class="form-control @error('invoice_no') is-invalid @enderror"
								name="invoice_no" id="invoice_no" placeholder="XXXXX"
								value="{{ old('invoice_no', '' ) }}"
								required/>
							@error('invoice_no')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label class="form-label">Invoice Date</label>
							<input type="date" class="form-control @error('invoice_date') is-invalid @enderror"
								name="invoice_date" id="invoice_date" placeholder=""
								value="{{ old('invoice_date', date('Y-m-01') ) }}"
								required/>
							@error('invoice_date')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label class="form-label">Particulars</label>
							<input type="text" class="form-control @error('summary') is-invalid @enderror"
								name="summary" id="summary" placeholder="Summary"
								value="{{ old('summary', '' ) }}"
								required/>
							@error('summary')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label class="form-label">Invoice PoC</label>
							<select class="form-control" name="poc_id" required>
								<option value=""><< PoC Name >> </option>
								@foreach ($pocs as $user)
									<option value="{{ $user->id }}" {{ $user->id == old('poc_id') ? 'selected' : '' }} >{{ $user->name }} </option>
								@endforeach
							</select>
							@error('poc_id')
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
						<h5 class="card-title">Invoice Info</h5>
					</div>
					<div class="card-body">

						<div class="mb-3">
							<label class="form-label">Currency</label>
							<input type="text" class="form-control @error('currency') is-invalid @enderror"
								name="currency" id="currency" placeholder="Summary"
								value="{{ $po->currency }}"
								readonly/>
							@error('invoice_no')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label class="form-label">Amount</label>
							<input type="number" class="form-control @error('amount') is-invalid @enderror"
								name="amount" id="amount" placeholder="99,999.99"
								value="{{ old('amount', '1.00' ) }}"
								step='0.01' min="1" required/>
							@error('amount')
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
		</div>
		<!-- end row -->

	</form>
	<!-- /.form end -->
	
	

@endsection