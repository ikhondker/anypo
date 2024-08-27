@extends('layouts.tenant.app')
@section('title','Add Invoice Line')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('invoices.index') }}" class="text-muted">Invoices</a></li>
	<li class="breadcrumb-item"><a href="{{ route('invoices.show',$invoice->id) }}" class="text-muted">#{{ $invoice->id }}</a></li>
	<li class="breadcrumb-item active">Add New Line</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			Add Invoice Line
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Invoice" label="Invoice"/>
			<x-tenant.actions.invoice-actions invoiceId="{{ $invoice->id }}" show="true"/>
		@endslot
	</x-tenant.page-header>
	
	{{-- <x-tenant.widgets.pr.show-pr-header prId="{{ $pr->id }}"/> --}}


		<!-- form start -->

	<form action="{{ route('invoice-lines.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<div class="form-check form-switch">
						<input class="form-check-input m-1" type="checkbox" id="add_row" name="add_row" checked>
						<label class="form-check-label" for="add_row">... add another Line</label>
					</div>
				</div>

				<h5 class="card-title">Invoice Lines</h5>
				<h6 class="card-subtitle text-muted">List of Invoice Lines.</h6>
			</div>

			<table class="table table-striped table-sm">
				<thead>
					<tr>
						<th class="text-center" style="width:1%">#</th>
						<th class="" style="width:15%">Item</th>
						<th class="" style="width:25%">Description</th>
						<th class="" style="width:8%">UOM</th>
						<th class="text-end" style="width:6%">Qty</th>
						<th class="text-end" style="width:9%">Price</th>
						<th class="text-end" style="width:9%">Subtotal</th>
						<th class="text-end" style="width:9%">Tax</th>
						<th class="text-end" style="width:9%">GST</th>
						<th class="text-end" style="width:9%">Amount</th>
					</tr>
				</thead>
				<tbody>

					@forelse ($invoiceLines as $invoiceLine)
						<x-tenant.widgets.invoice-line.card-table-row :line="$invoiceLine"/>
					@empty

					@endforelse
					@include('tenant.includes.invoice.invoice-line-add')

					<tr class="">
						<td colspan="9" class="text-end">
							<strong>TOTAL:</strong>
						</td>
						<td class="text-end">
							<input type="text" class="form-control @error('pr_amount') is-invalid @enderror"
								style="text-align: right;"
								name="pr_amount" id="pr_amount" placeholder="0.00"
								value="{{ old('pr_amount', (isset($pr->amount) ? number_format($pr->amount,2) : "0.00")) }}"
								readonly>
							@error('pr_amount')
									<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</td>
					</tr>
				</tbody>
			</table>

			<div class="card-footer">
				<div class="card-actions float-end">
					<a class="btn btn-secondary text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel" href="{{ route('prs.show',$pr->id) }}"><i data-lucide="x-circle"></i> Cancel</a>
					<button type="submit" id="submit" name="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Save"><i data-lucide="save"></i> Save</button>
				</div>
			</div>
		</div>
		
	</form>
	<!-- /.form end -->
	
	
	@include('tenant.includes.js.select2')
	@include('tenant.includes.js.calculate-pr-amount')
	
@endsection

