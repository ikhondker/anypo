{{-- ================================================================== --}}
<div class="row">
	<div class="col-12 col-xl-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Approval History</h5>
				<h6 class="card-subtitle text-muted">Using the most basic table markup, here’s how .table-based tables look in Bootstrap.</h6>
			</div>
			<table class="table table-striped table-sm">
				<thead>
					<tr>
						<th class="" scope="col">#</th>
						<th class="" scope="col">Performer</th>
						<th class="" scope="col">Date</th>
						<th class="" scope="col">Action</th>
						<th class="" scope="col">Notes</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($wfls as $wfl)
					<tr>
						<td class=""> {{ $loop->iteration }} #{{ $wfl->id }}</td>
						<td class="">{{ $wfl->performer->name }}({{ $wfl->performer->designation_name->name }})</td>
						<td class=""><x-tenant.list.my-date-time :value="$wfl->action_date"/></td>
						<td class=""><span class="badge bg-success">{{ $wfl->action }}</span></td>
						<td class="">{{ $wfl->notes }}</td>
					</tr>
					@endforeach

				</tbody>
			</table>
		</div>
	</div>
</div>    
{{-- ============================================================== --}}