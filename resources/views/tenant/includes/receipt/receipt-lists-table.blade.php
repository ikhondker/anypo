<table class="table">
	<thead>
		<tr>
			<th>#</th>
			<th>GRN#</th>
			<th>Date</th>
			<th>PO#</th>
			<th>LINE#</th>
			<th>Item</th>
			<th>Qty</th>
			<th>Receiver</th>
			<th>Warehouse</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($receipts as $receipt)
		<tr>
			<td>{{ $receipts->firstItem() + $loop->index }}</td>
			<td><a href="{{ route('receipts.show',$receipt->id) }}"><strong>{{ $receipt->id }}</strong></a></td>
			<td>{{ $receipt->receive_date }}</td>
			<td><x-tenant.common.link-po id="{{ $receipt->pol->po_id }}"/></td>
			<td>{{ $receipt->pol->line_num }}</td>
			<td>{{ $receipt->pol->item_description }}</td>
			<td>{{ $receipt->qty }}</td>
			<td>{{ $receipt->receiver->name }}</td>
			<td>{{ $receipt->warehouse->name }}</td>
			<td><span class="badge badge-subtle-{{ $receipt->status_badge->badge }}">{{ $receipt->status_badge->name}}</span></td>
			<td>
				<a href="{{ route('receipts.show',$receipt->id) }}" class="btn btn-light"
					data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i data-lucide="eye"></i> View
				</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

<div class="row pt-3">
	{{ $receipts->links() }}
</div>
<!-- end pagination -->
