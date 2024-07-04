<div class="card">
	<div class="card-header">
		<div class="card-actions float-end">
			<a href="{{ route('aels.export-for-po', $id) }}" class="btn btn-info text-white me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Download">
				<i class="align-middle" data-lucide="download-cloud"></i>
			</a>
		</div>
		<h5 class="card-title">
			Accounting Entries
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
					<th>A/c Code</th>
					<th>Line Description</th>
					<th class="text-end">Dr</th>
					<th class="text-end">Cr</th>
					<th>Currency</th>
					<th>PO#</th>
					<th>Reference</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($aels as $ael)
				<tr>
					<td><a class="text-info" href="{{ route('aels.show',$ael->id) }}">{{ $ael->id }}</a></td>
					<td>{{ $ael->aeh->source_entity->value }}</td>
					<td>{{ $ael->aeh->event }}</td>
					<td><x-tenant.list.my-date :value="$ael->accounting_date"/></td>
					<td>{{ $ael->ac_code }}</td>
					<td>{{ $ael->line_description }}</td>
					<td class="text-end"><x-tenant.list.my-number :value="$ael->fc_dr_amount"/></td>
					<td class="text-end"><x-tenant.list.my-number :value="$ael->fc_cr_amount"/></td>
					<td>{{ $ael->fc_currency }}</td>
					<td><x-tenant.common.link-po id="{{ $ael->aeh->po_id }}"/></td>
					<td>{{ $ael->reference_no }}</td>

				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	<!-- end card-body -->
</div>
<!-- end card -->
