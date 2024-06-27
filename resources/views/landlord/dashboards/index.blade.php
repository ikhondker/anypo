@extends('layouts.landlord.app')
@section('title','Dashboard')
@section('breadcrumb','Dashboard')

@section('content')

	<div class="d-grid gap-1 gap-lg-1">
		<div class="row">
			<x-landlord.widgets.kpi value="{{ $count_tickets_open }}" route="tickets" label="OPEN TICKETS" icon="activity"/>
			<x-landlord.widgets.kpi value="{{ $count_tickets_total }}" route="tickets" label="TOTAL TICKETS" icon="activity"/>
			<x-landlord.widgets.kpi value="{{ $count_accounts }}" route="accounts" label="ACCOUNTS" icon="activity"/>
			<x-landlord.widgets.kpi value="{{ $count_service }}" route="services" label="SERVICES" icon="activity"/>
		</div>
		<!-- End Row -->
	</div>

	<!-- ========== NOTICE ========== -->
	@include('landlord.includes.notice')
	<!-- ========== END NOTICE ========== -->

	<div class="d-grid gap-3 gap-lg-5">
		<x-landlord.widgets.ticket-lists type="LAST5"/>
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
