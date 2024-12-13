@extends('layouts.landlord.app')
@section('title','Dashboard')
@section('breadcrumb')
	<li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')

	<x-landlord.page-header>
		@slot('title')
			Dashboard
		@endslot
		@slot('buttons')
				<a href="{{ route('tickets.create') }}" class="btn btn-primary me-1"><i data-lucide="plus"></i> New Ticket</a>
				<x-landlord.actions.account-actions/>
		@endslot
	</x-landlord.page-header>

	<div class="d-grid gap-1 gap-lg-1">
		<div class="row">
			<x-landlord.widgets.kpi value="{{ $count_tickets_open }}" route="tickets" label="OPEN TICKETS" icon="activity"/>
			<x-landlord.widgets.kpi value="{{ $count_tickets_total }}" route="tickets" label="TOTAL TICKETS" icon="activity"/>
			<x-landlord.widgets.kpi value="{{ $count_accounts }}" route="accounts" label="ACCOUNTS" icon="activity"/>
			<x-landlord.widgets.kpi value="{{ $count_users }}" route="users" label="USER" icon="activity"/>
		</div>
		<!-- End Row -->
	</div>

	<!-- ========== NOTICE ========== -->
	@include('landlord.includes.notice')
	<!-- ========== END NOTICE ========== -->

	<x-landlord.widgets.expire-warning/>

	<div class="d-grid gap-3 gap-lg-5">
		<x-landlord.widgets.ticket-lists type="OPEN"/>

		<x-landlord.widgets.ticket-lists type="CLOSED"/>
	</div>

	<!-- card-notifications -->
	{{-- <div class="card mt-2 col-12">
		<x-landlord.card.header title="Notifications"/>
		<div class="card-body pt-1">
			<x-wf.notification-unread/>
		</div>
	</div> --}}
	<!-- /.card-notifications -->

@endsection
