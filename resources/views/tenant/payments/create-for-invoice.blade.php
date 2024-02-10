@extends('layouts.app')
@section('title','Create Payments')
@section('breadcrumb','Create Payments')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Payments
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.save/>
			<x-tenant.buttons.header.lists object="Payment"/>
		@endslot
	</x-tenant.page-header> 

	@include('tenant.includes.po.view-po-header')
	
	<x-tenant.widgets.inv-payments :id="$invoice->id" />

	<!-- form start -->
	<form id="myform" action="{{ route('payments.store') }}" method="POST" enctype="multipart/form-data">
		@csrf
		<input type="text" name="invoice_id" id="invoice_id" class="form-control" placeholder="ID" value="{{ old('invoice_id', $invoice->id ) }}" hidden>
		
		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Payment Info</h5>
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
							<label class="form-label">Bank Ac</label>
							<select class="form-control" name="bank_account_id" required>
								<option value=""><< Bank Account >> </option>
								@foreach ($bank_accounts as $bank_account)
									<option value="{{ $bank_account->id }}" {{ $bank_account->id == old('bank_account_id') ? 'selected' : '' }} >{{ $bank_account->ac_name }} </option>
								@endforeach
							</select>
							@error('bank_account_id')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>
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
							<label class="form-label">Cheque/Ref No</label>
							<input type="text" class="form-control @error('cheque_no') is-invalid @enderror"
								name="cheque_no" id="cheque_no" placeholder="123456"
								value="{{ old('cheque_no', '' ) }}"
								required/>
							@error('cheque_no')
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
			<div class="col-6">

			</div>
			<!-- end col-6 -->
		</div>
		<!-- end row -->

	</form>
	<!-- /.form end -->
	
	

@endsection