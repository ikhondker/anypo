<table class="table">
	<thead>
		<tr>
			<th>PO#</th>
			<th>Date</th>
			<th>Summary</th>
			<th>Dept</th>
			<th>Supplier</th>
			<th>Project</th>
			<th class="text-end">PO Amount</th>
			<th>Cur.</th>
			<th>Buyer</th>
			<th>Approval</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($pos as $po)
		<tr>
			<td>{{ $po->id }}</td>
			<td><x-tenant.list.my-date value="{{ $po->po_date }}"/></td>
			<td><a href="{{ route('pos.show',$po->id) }}"><strong>{{ $po->summary }}</strong></a></td>
			<td><span class="badge rounded-pill badge-subtle-{{ $po->dept->bg_color }}">{{ $po->dept->name}}</span></td>
			<td>{{ $po->supplier->name }}</td>
			<td>{{ $po->project->code }}</td>
			<td class="text-end">{{ number_format($po->amount, 2) }}</td>
			<td>{{ $po->currency }}</td>
			<td>{{ $po->buyer->name }}</td>
			<td><span class="badge badge-subtle-{{ $po->auth_status_badge->badge }}">{{ $po->auth_status_badge->name}}</span></td>
			<td><span class="badge badge-subtle-{{ $po->status_badge->badge }}">{{ $po->status_badge->name}}</span></td>
			<td>
				<a href="{{ route('pos.show',$po->id) }}" class="btn btn-light"
					data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i data-lucide="eye"></i> View
				</a>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

<div class="row pt-3">
	{{ $pos->links() }}
</div>
<!-- end pagination -->



