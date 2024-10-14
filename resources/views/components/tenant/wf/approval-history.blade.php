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
						<td class=""> {{ $loop->iteration }} </td>
						<td class="">{{ $wfl->performer->name }} [{{ $wfl->performer->designation->name }}]</td>
						<td class=""><x-tenant.list.my-date-time value="{{ $wfl->action_date }}"/></td>
						<td class="">
                            <span class="badge {{ $wfl->status_badge->badge }}">{{ $wfl->status_badge->name}}</span>
                        </td>
						<td class="">{!! nl2br($wfl->notes) !!}</td>
					</tr>
					@endforeach

				</tbody>
			</table>
		</div>
	</div>
</div>
{{-- ============================================================== --}}
