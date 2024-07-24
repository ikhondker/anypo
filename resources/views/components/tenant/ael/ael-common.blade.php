
	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">

			</div>
			<h5 class="card-title">
				Accounting Lines {{ $label }}
			</h5>
			<h6 class="card-subtitle text-muted">List of Generated Accounting Lines</h6>
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
						<th class="text-end">Dr.</th>
						<th class="text-end">Cr.</th>
						<th>Currency</th>
						<th>PO#</th>
						<th>Reference</th>
					</tr>
				</thead>
				<tbody>
					
						@foreach ($aels as $ael)
							<tr>
								<td><a href="{{ route('aels.show',$ael->id) }}"><strong>{{ $ael->id }}</strong></a></td>
								<td><span class="badge badge-subtle-primary">{{ $ael->aeh->source_entity->value }}</span></td>
								<td>
									@if ($ael->aeh->event->value == App\Enum\AehEventEnum::POST->value)
									<span class="badge badge-subtle-success">{{ $ael->aeh->event }}</span>
									@else 
									<span class="badge badge-subtle-danger">{{ $ael->aeh->event }}</span>
									@endif
								</td>
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
