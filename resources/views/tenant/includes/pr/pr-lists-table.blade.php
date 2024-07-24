<table class="table">
	<thead>
		<tr>
			<th>PR#</th>
			<th>Date</th>
			<th>Summary</th>
			<th>Requestor</th>
			<th>Dept</th>
			<th>Supplier</th>
			<th>Project</th>
			<th class="text-end">Amount</th>
			<th>Approval</th>
			<th>Status</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($prs as $pr)
		<tr>
			<td>{{ $pr->id }}</td>
			<td><x-tenant.list.my-date :value="$pr->pr_date"/></td>
			<td><a href="{{ route('prs.show',$pr->id) }}"><strong>{{ $pr->summary }}</strong></a></td>
			<td>{{ $pr->requestor->name }}</td>
			<td>{{ $pr->dept->name }}</td>
			<td>{{ $pr->supplier->name }}</td>
			<td>{{ $pr->project->code }}</td>
			<td class="text-end">{{ number_format($pr->amount, 2) }} {{ $pr->currency }}  </td>
			<td><span class="badge {{ $pr->auth_status_badge->badge }}">{{ $pr->auth_status_badge->name}}</span></td>
			<td><span class="badge {{ $pr->status_badge->badge }}">{{ $pr->status_badge->name}}</span></td>
			<td class="table-action">
				<a href="{{ route('prs.show',$pr->id) }}" class="btn btn-light"
					data-bs-toggle="tooltip" data-bs-placement="top" title="View">View
				</a>
				{{-- <a href="{{ route('prs.show',$pr->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
					<i class="align-middle" data-lucide="eye"></i></a>

				<a href="{{ route('reports.pr',$pr->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Print">
						<i class="align-middle" data-lucide="printer"></i></a> --}}
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

<div class="row pt-3">
	{{ $prs->links() }}
</div>
<!-- end pagination -->
