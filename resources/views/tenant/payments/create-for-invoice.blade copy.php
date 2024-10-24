@extends('layouts.tenant.app')
@section('title','Create Payment')
@section('breadcrumb')
	@if(!empty($invoice))
		<li class="breadcrumb-item"><a href="{{ route('pos.show',$invoice->po_id) }}" class="text-muted">PO #{{ $invoice->po_id }}</a></li>
		<li class="breadcrumb-item"><a href="{{ route('pos.invoices', $invoice->po_id) }}" class="text-muted">PO Invoices</a></li>
		<li class="breadcrumb-item"><a href="{{ route('invoices.show', $invoice->id) }}" class="text-muted">Invoice #{{ $invoice->invoice_no }}</a></li>
	@endif
	<li class="breadcrumb-item active">Payment</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Payments
		@endslot
		@slot('buttons')

			<x-tenant.buttons.header.lists object="Payment"/>

			@if(!empty($invoice))
				<x-tenant.actions.invoice-actions invoiceId="{{ $invoice->id }}"/>
			@endif

		@endslot
	</x-tenant.page-header>

	@if(!empty($invoice))
		{{-- <x-tenant.info.invoice-info invoiceId="{{ $invoice->id }}"/> --}}
	@endif

	<!-- form start -->
	<form id="myform" action="{{ route('payments.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Create Payment</h5>
				<h6 class="card-subtitle text-muted">Payment Detail Information.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>

						@if(empty($invoice))
							<tr>
								<th>Invoice #</th>
								<td>
									<select class="form-control" name="invoice_id" id="invoice_id" required>
										<option value=""><< Invoice >> </option>
										@foreach ($invoices as $invoiceN)
											<option value="{{ $invoiceN->id }}" {{ $invoiceN->id == old('invoice_id') ? 'selected' : '' }} >{{ $invoiceN->invoice_no }} </option>
										@endforeach
									</select>
									@error('invoice_id')
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

							<tr>
								<th>Amount-Currency-Date :</th>
								<td>
									<div class="row">
										<div class="col-md-5">
											<input type="text" class="form-control"
											name="dsp_invoice_amount" id="dsp_invoice_amount" value=""
											readonly/>
										</div>
										<div class="col-md-4">
											<input type="text" class="form-control"
											name="dsp_invoice_amount1" id="dsp_invoice_amount1" value=""
											readonly/>
										</div>
										<div class="col-md-3">
											<input type="text" class="form-control"
											name="dsp_invoice_amount2" id="dsp_invoice_amount2" value=""
											readonly/>
										</div>
									</div>

								</td>
							</tr>
							<tr>
								<th>Narration :</th>
								<td>
									<input type="text" class="form-control"
									name="dsp_invoice" id="dsp_invoice" value=""
									readonly/>
								</td>
							</tr>
							<tr>
								<th>PO :</th>
								<td>
									<input type="text" class="form-control"
									name="dsp_po" id="dsp_po" value=""
									readonly/>
								</td>
							</tr>

							<tr>
								<th>Currency :</th>
								<td>
									<input type="text" class="form-control"
									name="dsp_po_currency" id="dsp_po_currency" value=""
									readonly/>
								</td>
							</tr>
						@else
							<input type="text" name="invoice_id" id="invoice_id" class="form-control" placeholder="ID" value="{{ old('invoice_id', $invoice->id ) }}" hidden>
							<tr>
								<th>Invoice # :</th>
								<td>
									<input type="text" class="form-control"
									name="dsp_invoice_no" id="dsp_invoice_no" value="{{ old('dsp_invoice_no', $invoice->invoice_no ) }}"
									readonly/>
								</td>
							</tr>
							<tr>
								<th>Currency</th>
								<td>
									<input type="text" class="form-control @error('currency') is-invalid @enderror"
									name="currency" id="currency" placeholder="Summary"
									value="{{ $po->currency }}"
									readonly/>
								@error('invoice_no')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
								</td>
							</tr>

							<tr>
								<th>Supplier :</th>
								<td>
									<input type="text" class="form-control"
									name="dsp_supplier" id="dsp_supplier" value="{{ $invoice->po->supplier->name }}"
									readonly/>
								</td>
							</tr>
							<tr>
								<th>PO # :</th>
								<td>
									<input type="text" class="form-control"
									name="dsp_po_id" id="dsp_po_id" value="{{ old('po_id', $invoice->po->id ) }}"
									readonly/>
								</td>
							</tr>
						@endif

						<tr>
							<th>Particulars</th>
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

						<tr>
							<th>Bank Ac</th>
							<td>
								<select class="form-control" name="bank_account_id" required>
									<option value=""><< Bank Account >> </option>
									@foreach ($bank_accounts as $bank_account)
										<option value="{{ $bank_account->id }}" {{ $bank_account->id == old('bank_account_id') ? 'selected' : '' }} >{{ $bank_account->ac_name }} </option>
									@endforeach
								</select>
								@error('bank_account_id')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</td>
						</tr>


						<tr>
							<th>Cheque/Ref No</th>
							<td>
								<input type="text" class="form-control @error('cheque_no') is-invalid @enderror"
								name="cheque_no" id="cheque_no" placeholder="123456"
								value="{{ old('cheque_no', '' ) }}"
								required/>
							@error('cheque_no')
								<div class="small text-danger">{{ $message }}</div>
							@enderror
							</td>
						</tr>

						<tr>
							<th>Amount</th>
							<td>
								<input type="number" class="form-control @error('amount') is-invalid @enderror"
								name="amount" id="amount" placeholder="99,999.99"
								value="{{ old('amount', '1.00' ) }}"
								step='0.01' min="1" required/>
							@error('amount')
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


<script type="module">
	$(document).ready(function () {
		$('#invoice_id').change(function() {
			alert($('option:selected').text());
			console.log("PO changed new Hello world1 !");
			let id = $(this).val();
			let url = '{{ route("invoices.get-open-invoices", ":id") }}';
			url = url.replace(':id', id);
			$.ajax({
				url: url,
				type: 'get',
				dataType: 'json',
				// delay: 250,
				success: function(response) {
					if (response != null) {
						$('#dsp_invoice').val(response.supplier.name);
						$('#dsp_po').val(response.supplier.name);
						$('#dsp_supplier').val(response.supplier.name);
						$('#dsp_po_currency').val(response.currency);
					}
				}
			});

		});

	});



</script>



@endsection
