@extends('layouts.landlord.app')
@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')

	<div class="d-grid gap-1 gap-lg-1">
		<div class="row">
			<x-landlord.widgets.kpi value="{{ $count_tickets }}" route="tickets" label="ALL TICKETS" icon="com013"/>
			<x-landlord.widgets.kpi value="{{ $count_all_open_tickets }}" route="tickets" label="TOTAL OPEN" icon="abs029"/>
			<x-landlord.widgets.kpi value="{{ $count_unassigned_tickets }}" route="tickets" label="TOTAL UNASSIGNED" icon="abs027"/>
			<x-landlord.widgets.kpi value="{{ $count_all_closed_tickets }}" route="tickets" label="TOTAL CLOSED" icon="com006"/>
		</div>
		<!-- End Row -->
	</div>

	<div class="d-grid gap-1 gap-lg-1">
		<div class="row">
			<x-landlord.widgets.kpi value="{{ $count_accounts }}" label="TOTAL ACCOUNTS" icon="com013" route="accounts"/>
			<x-landlord.widgets.kpi value="{{ $count_service }}" label="TOTAL SERVICES" icon="abs029" route="services"/>
			<x-landlord.widgets.kpi value="{{ $count_invoices }}" label="TOTAL INVOICES" icon="abs027" route="invoices"/>
			<x-landlord.widgets.kpi value="{{ $count_payments }}" label="TOTAL PAYMENTS" icon="com006" route="payments"/>
		</div>
		<!-- End Row -->
	</div>

	<div class="d-grid gap-1 gap-lg-1">
		<div class="row">
			<x-landlord.widgets.kpi value="{{ $count_users }}" label="TOTAL USERS" icon="com006" route="users"/>
			<x-landlord.widgets.kpi value="{{ $count_users_active }}" label="TOTAL ACTIVE" icon="abs029" route="users"/>
			<x-landlord.widgets.kpi value="{{ $count_users_inactive }}" label="TOTAL INACTIVE" icon="abs027" route="users"/>
			<x-landlord.widgets.kpi value="{{ $count_users_non_val }}" label="TOTAL NON-VAL" icon="com006" route="users"/>
		</div>
		<!-- End Row -->
	</div>



	<!-- ========== NOTICE ========== -->
	@include('landlord.includes.notice')
	<!-- ========== END NOTICE ========== -->

	<div class="d-grid gap-3 gap-lg-5">

		<x-landlord.widgets.ticket-lists type="UNASSIGNED"/>

		<x-landlord.widgets.ticket-lists type="OPEN"/>

	</div>



@endsection
