{{-- ================================================================== --}}
<div class="row">
	<div class="col-12 col-xl-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Approval History</h5>
				<h6 class="card-subtitle text-muted">Approval History with Performer and Action.</h6>
			</div>
			<table class="table table-striped table-sm">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Performer</th>
						<th scope="col">Start</th>
                        <th scope="col">End</th>
						<th scope="col">Action</th>
						<th scope="col">Notes</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($wfls as $wfl)
					<tr>
						<td> {{ $loop->iteration }} </td>
						<td>{{ $wfl->performer->name }} [{{ $wfl->performer->designation->name }}]</td>
						<td><x-tenant.list.my-date-time value="{{ $wfl->start_date }}"/></td>
                        <td><x-tenant.list.my-date-time value="{{ $wfl->end_date }}"/></td>
						<td>
							<span class="badge {{ $wfl->action_badge->badge }}">{{ $wfl->action_badge->name}}</span>
						</td>
						<td>{!! nl2br($wfl->notes) !!}</td>
					</tr>
					@endforeach

				</tbody>
			</table>
		</div>
	</div>
</div>
{{-- ============================================================== --}}
