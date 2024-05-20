<table class="table table-striped table-sm">
	<thead>
		<tr>
			<th class="text-center">#</th>
			<th class="">Subject</th>
			<th class="">Date</th>
			<th class="">Read At</th>
			<th class="text-center">Actions</th>
		</tr>
	</thead>
	<tbody>
		@if(auth()->user())

			@forelse($notifications as $notification)
				<tr>
					<td class="text-center">
						{{ $loop->iteration }}
					</td>
					<td class="">
						@if ($notification->read_at == null)
							<a href="{{ route('notifications.show', $notification->id) }}"><span class="text-warning">{{ $notification->data['subject'] }}</span></a>
						@else
							<a href="{{ route('notifications.show', $notification->id) }}"><span class="text-muted">{{ $notification->data['subject'] }}</span></a>
						@endif
					</td>
					<td>
						<x-tenant.list.my-date-time :value="$notification->created_at"/>
					</td>
					<td>
						<x-tenant.list.my-date-time :value="$notification->read_at"/>
					</td>
					<td class="table-action">
						<a href="{{ route('notifications.show', $notification->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i class="align-middle" data-feather="eye"></i></a>
						<a href="{{ route('notifications.read', $notification->id) }}" class="me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Mark as Read"><i class="align-middle" data-feather="thumbs-up"></i></a>
						<a href="{{ route('notifications.destroy', $notification->id) }}" class="me-2 modal-boolean sw2"
							data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
							<i class="align-middle" data-feather="trash-2"></i>
						</a>
					</td>
				</tr>
			@empty
				<tr>
					There are no new notifications!
				</tr>
			@endforelse
		@endif
	</tbody>
</table>

