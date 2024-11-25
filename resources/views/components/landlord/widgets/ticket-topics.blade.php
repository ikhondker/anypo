{{-- ================================================================== --}}
<div class="row">
	<div class="col-12 col-xl-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Topics</h5>
				<h6 class="card-subtitle text-muted">List of Associated Topics with this Ticket.</h6>
			</div>
			<table class="table table-striped table-sm">
				<thead>
					<tr>
						<th scope="col">#</th>
						<th scope="col">Topic</th>
						<th scope="col">Date</th>
						<th scope="col">Added By</th>
						<th scope="col">Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($ticketTopics as $ticketTopic)
					<tr>
						<td>{{ $loop->iteration }} </td>
						<td>{{ $ticketTopic->topic->name }}</td>
						<td><x-landlord.list.my-date-time value="{{ $ticketTopic->created_at }}"/> </td>
						<td>{{ $ticketTopic->user_created_by->name }}</td>
						<td>
							<a href="{{ route('ticket-topics.delete', $ticketTopic->id) }}"
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
