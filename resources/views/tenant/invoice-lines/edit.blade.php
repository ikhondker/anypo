@extends('layouts.tenant.app')
@section('title','Edit Invoice Line')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('invoices.index') }}" class="text-muted">Invoices</a></li>
	<li class="breadcrumb-item"><a href="{{ route('invoices.show',$invoice->id) }}" class="text-muted">Invoice #{{ $invoice->id }}</a></li>
	<li class="breadcrumb-item active">Edit Invoice Line</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Invoice Line
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Invoice" label="Invoice"/>
			<x-tenant.actions.invoice-actions invoiceId="{{ $invoice->id }}"/>
		@endslot
	</x-tenant.page-header>

	{{-- @include('tenant.includes.pr.view-pr-header') --}}
	<x-tenant.widgets.invoice.show-invoice-header invoiceId="{{ $invoice->id }}"/>

	<!-- form start -->
	<form action="{{ route('invoice-lines.update',$invoiceLine->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<div class="dropdown position-relative">
					</div>
				</div>
				<h5 class="card-title">Invoice Lines</h5>
				<h6 class="card-subtitle text-muted">List of Invoice Lines.</h6>
			</div>

			<table class="table table-striped table-sm">
				<thead>
					<tr>
						<th class="text-center" style="width:3%">#</th>
						<th class="" style="width:37%">Summary</th>
						<th class="text-end" style="width:10%">Qty</th>
						<th class="text-end" style="width:10%">Price</th>
						<th class="text-end" style="width:10%">Subtotal</th>
						<th class="text-end" style="width:10%">Tax</th>
						<th class="text-end" style="width:10%">GST</th>
						<th class="text-end" style="width:10%">Amount</th>
					</tr>
				</thead>
				<tbody>

					@forelse ($invoiceLines as $invoiceLineN)
						@if ( $invoiceLineN->id == $invoiceLine->id )
							@include('tenant.includes.invoice.invoice-line-edit')
						@else
							<x-tenant.widgets.invoice-line.card-table-row :line="$invoiceLineN"/>
						@endif
					@empty

					@endforelse

					<tr class="">
						<td colspan="7" class="text-end">
							<strong>TOTAL:</strong>
						</td>
						<td class="text-end">
							<input type="text" class="form-control @error('invoice_amount') is-invalid @enderror"
								style="text-align: right;"
								name="invoice_amount" id="invoice_amount" placeholder="0.00"
								value="{{ old('invoice_amount', (isset($invoice->amount) ? number_format($invoice->amount,2) : "0.00")) }}"
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
					<div class="dropdown position-relative">
							<a class="btn btn-secondary text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel" href="{{ route('invoices.show',$invoice->id) }}"><i data-lucide="x-circle"></i> Cancel</a>
							<button type="submit" id="submit" name="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Save"><i data-lucide="save"></i> Save</button>
					</div>
				</div>
			</div>
		</div>

	</form>
	<!-- /.form end -->

	@include('tenant.includes.js.select2')
	@include('tenant.includes.js.calculate-invoice-amount')
@endsection

