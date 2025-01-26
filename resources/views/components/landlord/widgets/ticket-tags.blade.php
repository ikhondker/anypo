{{-- ================================================================== --}}
<div class="row">
	<div class="col-12 col-xl-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Tag</h5>
				<h6 class="card-subtitle text-muted">List of Associated Tag with this Ticket.</h6>
			</div>
			<table class="table table-striped table-sm">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Tag</th>
						<th scope="col">Date</th>
						<th scope="col">Added By</th>
						<th scope="col">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($ticketTags as $ticketTag)
					<tr>
						<td>{{ $loop->iteration }}</td>
						<td>{{ $ticketTag->tag->name }}</td>
						<td><x-landlord.list.my-date-time value="{{ $ticketTag->created_at }}"/> </td>
						<td>{{ $ticketTag->user_created_by->name }}</td>
						<td>
							<a href="{{ route('ticket-tags.delete', $ticketTag->id) }}"
								class="text-body sw2" data-bs-placement="top" title="Delete">
								<i class="text-danger" data-lucide="delete"></i>
							</a>
						</td>
					</tr>
					@endforeach

				</tbody>
			</table>
		</div>
	</div>
</div>
{{-- ============================================================== --}}
