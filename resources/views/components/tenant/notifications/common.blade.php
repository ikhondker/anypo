
<table id="notification-table" class="table table-striped table-sm my-0 w-100">
	<thead class="d-none">
		<tr>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody>

		@if(auth()->user())
			@forelse($notifications as $notification)
			<tr>
				<td class="text-truncate col-checkbox">
					<input class="form-check-input" type="checkbox" value="">
				</td>
				<td class="text-truncate col-favorite">
					<i data-lucide="star" class="text-muted"></i>
				</td>
				<td class="text-truncate col-name">
					{{ $notification->data['from'] }}
				</td>
				<td class="text-truncate w-75 col-subject">
					@if ($notification->read_at == null)
							<a href="{{ route('notifications.show', $notification->id) }}"><span class="text-warning">{{ $notification->data['subject'] }}</span></a>
							<a data-bs-toggle="tooltip" data-bs-placement="top" title="Mark as Read" class="" href="{{ route('notifications.read',$notification->id) }}"><i data-lucide="check-circle" class="lucide-16 text-muted"></i></a>
						@else
							<a href="{{ route('notifications.show', $notification->id) }}"><span class="text-muted">{{ $notification->data['subject'] }}</span></a>
						@endif
				</td>
				<td class="d-none d-xl-table-cell text-end text-truncate col-date">
					@php
						$timeAgo = Carbon\Carbon::parse($notification->created_at)->ago();
					@endphp
					{{ $timeAgo }}
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

