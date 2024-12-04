<table class="table">
	<thead>
		<tr>

			<th>#</th>
			<th>INV NO#</th>
			<th>Date</th>
			<th>Supplier</th>
			<th>Narration</th>
			<th class="text-end">Amount</th>
			<th class="text-end">Paid</th>
			<th>PO#</th>
			<th>Status</th>
			<th>Pay Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($invoices as $invoice)
		<tr>
			<td>{{ $invoices->firstItem() + $loop->index }}</td>
			<td><a href="{{ route('invoices.show',$invoice->id) }}"><strong>{{ $invoice->invoice_no }}</strong></a></td>
			<td><x-tenant.list.my-date :value="$invoice->invoice_date"/></td>
			<td>{{ $invoice->supplier->name }}</td>
			<td>{{ $invoice->summary }}</td>
			<td class="text-end">{{ number_format($invoice->amount, 2) }} {{ $invoice->currency }}</td>
			<td class="text-end"><x-tenant.list.my-number :value="$invoice->amount_paid"/></td>
			<td><x-tenant.common.link-po id="{{ $invoice->po_id }}"/></td>
			<td><span class="badge {{ $invoice->status_badge->badge }}">{{ $invoice->status_badge->name}}</span></td>
			<td><span class="badge {{ $invoice->pay_status_badge->badge }}">{{ $invoice->pay_status_badge->name}}</span></td>
			<td>
				<a href="{{ route('invoices.show',$invoice->id) }}" class="btn btn-light"
					data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i data-lucide="eye"></i> View
				</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

<div class="row pt-3">
	{{ $invoices->links() }}
</div>
<!-- end pagination -->
