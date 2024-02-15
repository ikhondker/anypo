@extends('layouts.app')
@section('title','All Notifications')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Unread Notifications
		@endslot
		@slot('buttons')
			<a href="{{ route('notifications.all') }}" class="btn btn-primary float-end me-2"><i data-feather="bell-off"></i> All Notification</a>
			{{-- <x-tenant.buttons.header.create object="Dept"/> --}}
		@endslot
	</x-tenant.page-header>
	
	@include('tenant.includes.notification-stat')
	
	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<x-tenant.cards.header-search-export-bar object="Notification" :export="false"/>
					<h5 class="card-title">
						@if (request('term'))
							Search result for: <strong class="text-danger">{{ request('term') }}</strong>
						@else
							Notification Lists
						@endif
					</h5>
					<h6 class="card-subtitle text-muted">List of Notifications.</h6>
				</div>

				<div class="card-body">
					
					<x-tenant.notifications.unread/>
					
				</div>
				<!-- end card-body -->
			</div>
			<!-- end card -->

		</div>
		 <!-- end col -->
	</div>
	 <!-- end row -->

	 

@endsection

