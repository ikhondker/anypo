@extends('layouts.landlord.app')
@section('title','Edit Invoice')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('invoices.index') }}" class="text-muted">Invoices</a></li>
	<li class="breadcrumb-item active">{{ $invoice->invoice_no }}</li>
@endsection

@section('content')

	<h1 class="h3 mb-3">Edit Invoice</h1>

	<div class="card">
		<div class="card-header">

			<h5 class="card-title">Edit Invoice (SYSTEM Only)</h5>
			<h6 class="card-subtitle text-muted">Edit Invoice Details.</h6>
		</div>
		<div class="card-body">
			<form id="myform" action="{{ route('invoices.update',$invoice->id) }}" method="POST" enctype="multipart/form-data">
				@csrf
				@method('PUT')

				<table class="table table-sm my-2">
					<tbody>

						<x-landlord.edit.id-read-only :value="$invoice->invoice_type"/>
						<x-landlord.edit.id-read-only :value="$invoice->id"/>
						<x-landlord.edit.id-read-only :value="$invoice->account->name"/>
						<tr>
							<th>Summary :</th>
							<td>
								<input type="text" class="form-control @error('summary') is-invalid @enderror"
									name="summary" id="summary" placeholder="summary"
									value="{{ old('summary', $invoice->summary ) }}"
									required/>
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
										name="invoice_date" id="invoice_date" placeholder="Name"
										value="{{ old('invoice_date', date('Y-m-d',strtotime($invoice->invoice_date)) ) }}"
										required/>
									@error('invoice_date')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
							</td>
						</tr>
						<tr>
							<th>From Date:</th>
							<td>
								<input type="date" class="form-control @error('from_date') is-invalid @enderror"
										name="from_date" id="from_date" placeholder="Name"
										value="{{ old('from_date', date('Y-m-d',strtotime($invoice->from_date)) ) }}"
										required/>
									@error('from_date')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
							</td>
						</tr>
						<tr>
							<th>To Date :</th>
							<td>
								<input type="date" class="form-control @error('to_date') is-invalid @enderror"
										name="to_date" id="to_date" placeholder="Name"
										value="{{ old('to_date', date('Y-m-d',strtotime($invoice->to_date)) ) }}"
										required/>
									@error('to_date')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
							</td>
						</tr>
						<tr>
							<th>Due Date :</th>
							<td>
								<input type="date" class="form-control @error('due_date') is-invalid @enderror"
										name="due_date" id="due_date" placeholder="Name"
										value="{{ old('due_date', date('Y-m-d',strtotime($invoice->due_date)) ) }}"
										required/>
									@error('due_date')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
							</td>
						</tr>
						<tr>
							<th>Qty :</th>
							<td>
								<input type="number" class="form-control @error('qty') is-invalid @enderror"
								name="qty" id="qty" placeholder="1"
								value="{{ old('qty', $invoice->qty ) }}"
								required/>
							@error('qty')
								<div class="small text-danger">{{ $message }}</div>
							@enderror
							</td>
						</tr>
						<tr>
							<th>Price :</th>
							<td>
								<input type="number" class="form-control @error('price') is-invalid @enderror"
								name="price" id="price" placeholder="Name"
								value="{{ old('price', $invoice->price ) }}"
								required/>
							@error('price')
								<div class="small text-danger">{{ $message }}</div>
							@enderror
							</td>
						</tr>
						<tr>
							<th>Amount :</th>
							<td>
								<input type="number" class="form-control @error('amount') is-invalid @enderror"
										name="amount" id="amount" placeholder="Name"
										value="{{ old('amount', $invoice->amount ) }}"
										required/>
									@error('amount')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
							</td>
						</tr>
						<x-landlord.edit.notes value="{{ $invoice->notes }}"/>




					</tbody>
				</table>

				<x-landlord.edit.save/>
			</form>
		</div>
	</div>

@endsection
