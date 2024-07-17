@extends('layouts.tenant.app')
@section('title','All Notifications')

@section('breadcrumb')
	<li class="breadcrumb-item active">Notifications</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Unread Notifications
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
						<a href="{{ route('users.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i>  View all</a>
					</div>
					<h5 class="card-title">Unread Notification Lists</h5>
					  <h6 class="card-subtitle text-muted">List of Notifications.</h6>
				</div>
				<div class="card-body">
					<x-tenant.notifications.unread/>
				</div>
			</div>
		</div>
	</div>


	 

@endsection

