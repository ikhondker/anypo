<div class="card">
	<div class="card-header">
		<div class="card-actions float-end">
			<a href="{{ route('accountings.export-for-po', $id) }}" class="btn btn-info text-white me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Download">
				<i class="align-middle" data-feather="download-cloud"></i> 
			</a>
		</div>
		<h5 class="card-title">
			Accounting  Entries
		</h5>
		<h6 class="card-subtitle text-muted">List of Generated Accounting Entries</h6>
	</div>
	<div class="card-body">
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Entity</th>
					<th>Event</th>
					<th>Date</th>
					<th>Account</th>
					<th>Line</th>
					<th class="text-end">Dr</th>
					<th class="text-end">Cr</th>
					<th>Currency</th>
					<th>PO#</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($accountings as $accounting)
				<tr>
					<td><a class="text-info" href="{{ route('accountings.show',$accounting->id) }}">{{ $accounting->id }}</a></td>
					<td>{{ $accounting->entity }}</td>
					<td>{{ $accounting->event }}</td>
					<td><x-tenant.list.my-date :value="$accounting->accounting_date"/></td>
					<td>{{ $accounting->ac_code }}</td>
					<td>{{ $accounting->line_description }}</td>
					<td class="text-end"><x-tenant.list.my-number :value="$accounting->fc_dr_amount"/></td>
					<td class="text-end"><x-tenant.list.my-number :value="$accounting->fc_cr_amount"/></td>
					<td>{{ $accounting->fc_currency }}</td>
					<td><x-tenant.common.link-po id="{{ $accounting->po_id }}"/></td>
					<td class="table-action">
						<x-tenant.list.actions object="Accounting" :id="$accounting->id" :edit="false"/>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<!-- end card-body -->
</div>
<!-- end card -->