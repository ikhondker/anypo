<div class="dropdown me-2 d-inline-block position-relative">
	<a class="btn btn-light bg-white shadow-sm dropdown-toggle" href="#" data-bs-toggle="dropdown" data-bs-display="static">
		<i class="align-middle text-info mt-n1" data-lucide="settings"></i> Actions
	 </a>
	<div class="dropdown-menu dropdown-menu-end">

		@if ( $notification->id <> '' && $notification->read_at == '' )
			<a class="dropdown-item" href="{{ route('notifications.read',$notification->id) }}"><i class="align-middle me-1 text-success" data-lucide="check"></i> Mark As Read</a>
			<div class="dropdown-divider"></div>
		@endif

		<a class="dropdown-item" href="{{ route('notifications.index') }}"><i class="align-middle me-1" data-lucide="edit"></i> Unread Notifications</a>
		<a class="dropdown-item" href="{{ route('notifications.all') }}"><i class="align-middle me-1" data-lucide="eye"></i> All Notifications</a>

		<div class="dropdown-divider"></div>

		@if ( $notification->id <> '' )
			<a class="dropdown-item sw2" href="{{ route('notifications.destroy', $notification->id) }}" title="Delete Notification">
				<i class="align-middle me-1 text-danger" data-lucide="trash"></i> Delete Notification</a>
		@endif
		<a class="dropdown-item sw2" href="{{ route('notifications.purge') }}" title=" Purge Notifications">
			<i class="align-middle me-1 text-danger" data-lucide="trash"></i> Purge All Notifications</a>

	</div>
</div>
