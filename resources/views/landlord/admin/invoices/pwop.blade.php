@extends('layouts.landlord.app')
@section('title','Edit Invoice')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('invoices.index') }}" class="text-muted">Invoices</a></li>
	<li class="breadcrumb-item active">{{ $invoice->invoice_no }}</li>
@endsection

@section('content')

	<h1 class="h3 mb-3">Pay without Actual Payment</h1>

	<div class="card">
		<div class="card-header">

			<h5 class="card-title">Pay without Actual Payment (System Only)</h5>
			<h6 class="card-subtitle text-muted">Pay without Actual Payment.</h6>
		</div>
		<div class="card-body">
			<form id="myform" action="{{ route('invoices.pay-pwop',$invoice->id) }}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PUT')

				<table class="table table-sm my-2">
					<tbody>
						<x-landlord.edit.id-read-only :value="$invoice->id"/>
						<tr>
							<th>Summary :</th>
							<td>
								<input type="text" class="form-control @error('summary') is-invalid @enderror"
									name="summary" id="summary" placeholder="summary"
									value="{{ old('summary', $invoice->summary ) }}"
									readonly/>
								@error('summary')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</td>
						</tr>
						<tr>
							<th>Invoice No :</th>
							<td>
								<input type="text" class="form-control @error('invoice_no') is-invalid @enderror"
									name="invoice_no" id="invoice_no" placeholder="invoice_no"
									value="{{ old('invoice_no', $invoice->invoice_no ) }}"
									readonly/>
								@error('invoice_no')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</td>
						</tr>
						<tr>
							<th>Discount :</th>
							<td>
								<input type="number" class="form-control @error('discount') is-invalid @enderror"
								name="discount" id="discount" placeholder="Name"
								value="{{ old('discount', $invoice->discount ) }}"
								readonly/>
							@error('discount')
								<div class="small text-danger">{{ $message }}</div>
							@enderror
							</td>
						</tr>
                         <tr>
                            <th>Internal Notes :</th>
                            <td>
                                <textarea class="form-control" name="notes_internal" placeholder="Enter ..." rows="4">{{ old('notes_internal', $invoice->notes_internal) }}</textarea>
                                @error('notes_internal')
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
