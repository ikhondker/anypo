<div class="card">
	<div class="card-header">
		<div class="card-actions float-end">
			<div class="dropdown position-relative">
				@if ($invoice->status == App\Enum\Tenant\AuthStatusEnum::DRAFT->value)
					<a href="{{ route('invoice-lines.add-line', $invoice->id) }}" class="btn btn-sm btn-light"><i data-lucide="plus-square"></i> Add Line</a>
				@endif
			</div>
		</div>
		<h5 class="card-title">Invoice Lines</h5>
		<h6 class="card-subtitle text-muted">List of Invoice Lines.</h6>
	</div>
	<table class="table table-striped table-sm">
		<thead>
			<tr>
				<th class="" style="width:3%">#</th>
				<th class="" style="width:37%">Description</th>
				<th class="text-end" style="width:10%">Qty</th>
				<th class="text-end" style="width:10%">Price</th>
				<th class="text-end" style="width:10%">Subtotal</th>
				<th class="text-end" style="width:10%">Tax</th>
				<th class="text-end" style="width:10%">GST</th>
				<th class="text-end" style="width:10%">Amount</th>
				<th class="" style="width:10%">Action</th>
			</tr>
		</thead>

		<tbody>
			@forelse ($invoiceLines as $invoiceLine)
				<x-tenant.widgets.invoice-line.card-table-row :line="$invoiceLine" :action="true"/>
			@empty

			@endforelse

			<!-- Table footer i.e. Totals -->
			<tr>
				<td class="" colspan="3" scope="col">
					@if ($invoice->status == App\Enum\Tenant\AuthStatusEnum::DRAFT->value)
						<a href="{{ route('invoice-lines.add-line', $invoice->id) }}" class="text-warning d-inline-block"><i data-lucide="plus-square"></i> Add Lines</a>
					@endif
				</td>
				<td class="text-end" scope="col"><strong>TOTAL ({{ $invoice->currency }}) :</strong></td>
				<td class="text-end" scope="col"><strong><x-tenant.list.my-number :value="$invoice->sub_total"/></strong></td>
				<td class="text-end" scope="col"><strong><x-tenant.list.my-number :value="$invoice->tax"/></strong></td>
				<td class="text-end" scope="col"><strong><x-tenant.list.my-number :value="$invoice->gst"/></strong></td>
				<td class="text-end" scope="col">{{ $invoice->currency }} <strong><x-tenant.list.my-number :value="$invoice->amount"/></strong></td>
				<td class="" scope="col">&nbsp</td>
			</tr>
			<!-- End Table footer i.e. Totals -->

		</tbody>

	</table>

</div>
