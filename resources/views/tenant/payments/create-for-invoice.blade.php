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


		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Create Payment for Invoice</h5>
						<h6 class="card-subtitle text-muted">Payment Detail Information.</h6>
					</div>
					<div class="card-body">
						<table class="table table-sm my-2">
							<tbody>

								@if(empty($invoice))
									<tr>
										<th>Invoice #</th>
										<td>
											<select class="form-control select2" data-toggle="select2" name="invoice_id" id="invoice_id" required>
												<option value=""><< Invoice >> </option>
												@foreach ($invoices as $invoiceN)
													<option value="{{ $invoiceN->id }}" {{ $invoiceN->id == old('invoice_id') ? 'selected' : '' }} >{{ $invoiceN->invoice_no }}</option>
												@endforeach
											</select>
											@error('invoice_id')
												<div class="small text-danger">{{ $message }}</div>
											@enderror
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
								@endif
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
								<tr>
									<th>Bank A/C :</th>
									<td>
										<select class="form-control" name="bank_account_id" required>
											<option value=""><< Bank Account >> </option>
											@foreach ($bank_accounts as $bank_account)
												<option value="{{ $bank_account->id }}" {{ $bank_account->id == old('bank_account_id') ? 'selected' : '' }} >{{ $bank_account->ac_name }}</option>
											@endforeach
										</select>
										@error('bank_account_id')
											<div class="small text-danger">{{ $message }}</div>
										@enderror
									</td>
								</tr>
								<tr>
									<th>Cheque/Ref No :</th>
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
									<th>Amount :</th>
									<td>
										<input type="number" class="form-control @error('amount') is-invalid @enderror"
											style="text-align: right;" min="1" step="0.01" max="999999.99"
											name="amount" id="amount" placeholder="0.00"
											value="{{ old('amount','0.00') }}"
											required>
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
			</div>
			<!-- end col-6 -->
			<div class="col-6">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Invoice and PO Details</h5>
						<h6 class="card-subtitle text-muted">Invoice and PO Detail Information.</h6>
					</div>
					<div class="card-body">
						<table class="table table-sm my-2">
							<tbody>
								<tr>
									<th>Supplier :</th>
									<td>
										<input type="text" class="form-control"
										name="dsp_invoice_supplier" id="dsp_invoice_supplier" value="{{ empty($invoice) ? old('dsp_invoice_supplier') : $invoice->po->supplier->name }}"
										readonly/>
									</td>
								</tr>
								<tr>
									<th>Narration :</th>
									<td>
										<input type="text" class="form-control"
										name="dsp_invoice_summary" id="dsp_invoice_summary" value="{{ empty($invoice) ? old('dsp_invoice_summary') : $invoice->summary }}"
										readonly/>
									</td>
								</tr>
								<tr>
									<th>Invoice Date & Amount :</th>
									<td>
										<div class="row">
											<div class="col-md-4">
												<input type="text" class="form-control"
												name="dsp_invoice_date" id="dsp_invoice_date" value="{{ empty($invoice) ? old('dsp_invoice_date') : strtoupper(date('d-M-y', strtotime($invoice->invoice_date))) }}"
												readonly/>
											</div>
											<div class="col-md-5">
												<input type="text" class="form-control"
												style="text-align: right;"
												name="dsp_invoice_amount" id="dsp_invoice_amount" value="{{ empty($invoice) ? old('dsp_invoice_amount') : number_format($invoice->amount,2) }}"
												readonly/>
											</div>
											<div class="col-md-3">
												<input type="text" class="form-control"
												name="dsp_invoice_currency" id="dsp_invoice_currency" value="{{ empty($invoice) ? old('dsp_invoice_currency') : $invoice->currency }}"
												readonly/>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<th>PO :</th>
									<td>
										<input type="text" class="form-control"
										name="dsp_po_summary" id="dsp_po_summary" value="{{ empty($invoice) ? old('dsp_po_summary') : 'PO#'.$invoice->po_id .' : '. $invoice->po->summary }}"
										readonly/>
									</td>
								</tr>
								<tr>
									<th>PO Date and Amount :</th>
									<td>
										<div class="row">
											<div class="col-md-5">
												<input type="text" class="form-control"
												name="dsp_po_date" id="dsp_po_date" value="{{ empty($invoice) ? old('dsp_po_date') :strtoupper(date('d-M-y', strtotime($invoice->po->po_date))) }}"
												readonly/>
											</div>
											<div class="col-md-4">
												<input type="text" class="form-control"
												 style="text-align: right;"
												name="dsp_po_amount" id="dsp_po_amount" value="{{ empty($invoice) ? old('dsp_po_amount') : number_format($invoice->po->amount,2) }}"
												readonly/>
											</div>
											<div class="col-md-3">
												<input type="text" class="form-control"
												name="dsp_po_currency" id="dsp_po_currency" value="{{ empty($invoice) ? old('dsp_po_currency') : $invoice->po->currency }}"
												readonly/>
											</div>
										</div>
									</td>
								</tr>
								<tr>
									<th>Department :</th>
									<td>
										<input type="text" class="form-control"
										name="dsp_dept_name" id="dsp_dept_name" value="{{ empty($invoice) ? old('dsp_dept_name') : $invoice->po->dept->name }}"
										readonly/>
									</td>
								</tr>
								<tr>
									<th>Project :</th>
									<td>
										<input type="text" class="form-control"
										name="dsp_project_name" id="dsp_project_name" value="{{ empty($invoice) ? old('dsp_project_name') : $invoice->po->project->name }}"
										readonly/>
									</td>
								</tr>
								<tr>
									<th>Buyer Name :</th>
									<td>
										<input type="text" class="form-control"
										name="dsp_buyer_name" id="dsp_buyer_name" value="{{ empty($invoice) ? old('dsp_buyer_name') : $invoice->po->buyer->name }}"
										readonly/>
									</td>
								</tr>

								@if(empty($invoice))

								@else
									<input type="text" name="invoice_id" id="invoice_id" class="form-control" placeholder="ID" value="{{ old('invoice_id', $invoice->id ) }}" hidden>
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

	<script type="module">
		$(document).ready(function () {
			$('#invoice_id').change(function() {
				//alert($('option:selected').text());
				let id = $(this).val();
				let url = '{{ route("invoices.get-invoice", ":id") }}';
				url = url.replace(':id', id);
				$.ajax({
					url: url,
					type: 'get',
					dataType: 'json',
					// delay: 250,
					success: function(response) {
						if (response != null) {
							$('#dsp_invoice_supplier').val(response.supplier_name);
							$('#dsp_invoice_summary').val(response.invoice_summary);
							$('#dsp_invoice_date').val(response.invoice_date);
							$('#dsp_invoice_amount').val(response.invoice_amount);
							$('#dsp_invoice_currency').val(response.currency);
							$('#dsp_po_summary').val(response.po_summary);
							$('#dsp_po_date').val(response.po_date);
							$('#dsp_po_amount').val(response.po_amount);
							$('#dsp_po_currency').val(response.po_currency);
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
