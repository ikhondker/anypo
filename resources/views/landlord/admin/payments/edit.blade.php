@extends('layouts.landlord.app')
@section('title','Edit Payment')
@section('breadcrumb','Edit Payment')

@section('content')

	<h1 class="h3 mb-3">Edit Payment</h1>

	<div class="card">
		<div class="card-header">

			<h5 class="card-title">Edit Payment (Admin Only)</h5>
			<h6 class="card-subtitle text-muted">Edit Payment Details.</h6>
		</div>
		<div class="card-body">
			<form id="myform" action="{{ route('payments.update',$payment->id) }}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PUT')

				<table class="table table-sm my-2">
					<tbody>


						<x-landlord.edit.id-read-only :value="$payment->id"/>

							<tr>
								<th>Summary :</th>
								<td>
									<input type="text" class="form-control @error('summary') is-invalid @enderror"
										name="summary" id="summary" placeholder="summary"
										value="{{ old('summary', $payment->summary  ) }}"
										required/>
									@error('summary')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
								</td>
							</tr>
							<tr>
								<th>Pay Date :</th>
								<td>
									<input type="date" class="form-control @error('pay_date') is-invalid @enderror"
											name="pay_date" id="pay_date" placeholder="Name"
											value="{{ old('pay_date', $payment->pay_date ) }}"
											required/>
										@error('pay_date')
											<div class="small text-danger">{{ $message }}</div>
										@enderror
								</td>
							</tr>

							<tr>
								<th>Invoice ID :</th>
								<td>
									<input type="text" class="form-control @error('invoice_id') is-invalid @enderror"
										name="invoice_id" id="invoice_id" placeholder="invoice_id"
										value="{{ old('invoice_id', $payment->invoice_id  ) }}"
										required/>
									@error('invoice_id')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
								</td>
							</tr>
							<tr>
								<th>Amount :</th>
								<td>
									<input type="number" class="form-control @error('amount') is-invalid @enderror"
											name="amount" id="amount" placeholder="Name"
											value="{{ old('amount', $payment->amount ) }}"
											required/>
										@error('amount')
											<div class="small text-danger">{{ $message }}</div>
										@enderror
								</td>
							</tr>

							<tr>
								<th>Cheque No :</th>
								<td>
									<input type="text" class="form-control @error('cheque_no') is-invalid @enderror"
										name="cheque_no" id="cheque_no" placeholder="cheque_no"
										value="{{ old('cheque_no', $payment->cheque_no  ) }}"
										required/>
									@error('cheque_no')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
								</td>
							</tr>

							<tr>
								<th>Reference ID :</th>
								<td>
									<input type="text" class="form-control @error('reference_id') is-invalid @enderror"
										name="reference_id" id="reference_id" placeholder="reference_id"
										value="{{ old('reference_id', $payment->reference_id  ) }}"
										required/>
									@error('reference_id')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
								</td>
							</tr>
					</tbody>
				</table>

				<x-landlord.edit.save/>
			</form>
		</div>
	</div>

@endsection
