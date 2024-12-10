@extends('layouts.tenant.app')
@section('title','All Notifications')
@section('breadcrumb')
	<li class="breadcrumb-item active">Notifications</li>
@endsection

@section('content')

	@php
		use App\Models\User;
	@endphp

	<x-tenant.page-header>
		@slot('title')
			Full Notifications
		@endslot
		@slot('buttons')
			<x-tenant.actions.notification.notification-actions/>
		@endslot
	</x-tenant.page-header>

	<x-tenant.dashboards.notification-stat/>

	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">

					<div class="card-actions float-end">
						{{-- <a href="{{ route('notifications.index') }}" class="btn btn-sm btn-light"><i data-lucide="database"></i> Unread Notifications</a> --}}
					</div>
					<h5 class="card-title">Full Notification Lists</h5>
					<h6 class="card-subtitle text-muted">List of Full Notifications.</h6>
				</div>

				<div class="card-body">
					<table id="notification-table" class="table table-striped table-sm my-0 w-100">
						<thead class="d-none">
							<tr>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>

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
										<td class="text-truncate col-name">
											@php
												$owner = User::where('id', $notification->data['owner_id'])->first();
											@endphp
											{{ $owner->name }}
										</td>
										<td class="text-truncate w-75 col-subject">
											@if ($notification->read_at == null)
												<a href="{{ route('notifications.show', $notification->id) }}"><span class="text-warning">{{ $notification->data['subject'] }}</span></a>
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

						</tbody>
					</table>
			<div class="row pt-3">
				{{ $notifications->links() }}
			</div>
			<!-- end pagination -->

				</div>
				<!-- end card-body -->
			</div>
			<!-- end card -->

		</div>
		 <!-- end col -->
	</div>
	 <!-- end row -->

@endsection

