<table class="table">
	<thead>
		<tr>
			<th>#</th>
			<th>Pay ID</th>
			<th>Date</th>
			<th>Ref/Cheque</th>
			<th class="text-end">Amount</th>

			<th>Bank A/C</th>
			<th>Supplier</th>
			<th>Invoice#</th>
			<th>PO#</th>
			<th>Paid By</th>
			<th>Status</th>
			<th>View</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($payments as $payment)
		<tr>
			<td>{{ $payments->firstItem() + $loop->index }}</td>
			<td><a href="{{ route('payments.show',$payment->id) }}"><strong>{{ $payment->id }}</strong></a></td>
			<td><x-tenant.list.my-date :value="$payment->pay_date"/></td>
			<td>{{ $payment->cheque_no }}</td>
			<td class="text-end">{{ number_format($payment->amount, 2) }} {{ $payment->currency }}</td>
			<td>{{ $payment->bank_account->ac_name }}</td>
			<td>{{ $payment->invoice->supplier->name }}</td>
			<td><a href="{{ route('invoices.show',$payment->invoice_id) }}"><strong>{{ $payment->invoice->invoice_no }}</strong></a></td>
			<td><x-tenant.common.link-po id="{{ $payment->invoice->po_id }}"/></td>
			<td>{{ $payment->payee->name }}</td>
			<td><span class="badge {{ $payment->status_badge->badge }}">{{ $payment->status_badge->name}}</span></td>
			<td>
				<a href="{{ route('payments.show',$payment->id) }}" class="btn btn-light"
					data-bs-toggle="tooltip" data-bs-placement="top" title="View">View
				</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

<div class="row pt-3">
	{{ $payments->links() }}
</div>
<!-- end pagination -->
