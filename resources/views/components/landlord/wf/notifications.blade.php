 <!-- my-section-row -->
 <div class="row my-section-row justify-content-between">
	<table class="table mb-0 table-center">
		<thead>
			<tr>
				<th class="">Subject</th>
				<th class="">Date</th>
				<th class="">Read?</th>
				<th class="text-center">Action</th>
			</tr>
		</thead>
		<tbody>
			@if(auth()->user())
				@forelse($notifications as $notification)
					<tr>
						<td class="">
							@if ($notification->read_at == null)
								<a href="{{ route('notifications.show', $notification->id) }}"><span class="text-info">{{ $notification->data['subject'] }}</span></a>
							@else
								<a href="{{ route('notifications.show', $notification->id) }}"><span class="text-muted">#{{ $notification->data['subject'] }}</span></a>
							@endif
						</td>
						<td>
							<span class="table-inner-text"> <x-landlord.list.my-date-time :value="$notification->created_at"/></span>
						</td>
						<td>
							<span class="table-inner-text"> <x-landlord.list.my-date-time :value="$notification->read_at"/></span>
						</td>
						<td class="text-center">
							<a href="{{ route('notifications.show',$notification->id) }}" class="action-btn btn-view bs-tooltip me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
								<i data-feather="eye" class="fea text-muted"></i> 
							</a>
							<a href="{{ route('notifications.read',$notification->id) }}" class="action-btn btn-view bs-tooltip me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Mark as Read">
								<i data-feather="edit" class="fea text-muted"></i> 
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
</div>
<!-- /.my-section-row -->

