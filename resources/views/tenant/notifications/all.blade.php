@extends('layouts.tenant.app')
@section('title','All Notifications')
@section('breadcrumb')
	<li class="breadcrumb-item active">Notifications</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			All Notifications
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
						<a href="{{ route('notifications.index') }}" class="btn btn-sm btn-light"><i data-lucide="database"></i> Unread Notifications</a>
					</div>
					<h5 class="card-title">All Notification Lists</h5>
					<h6 class="card-subtitle text-muted">List of All Notifications.</h6>
				</div>

				<div class="card-body">

					<x-tenant.notifications.all/>

				</div>
				<!-- end card-body -->
			</div>
			<!-- end card -->

		</div>
		 <!-- end col -->
	</div>
	 <!-- end row -->

@endsection

