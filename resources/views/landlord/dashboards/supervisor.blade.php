@extends('layouts.landlord.app')
@section('title','Dashboard')
@section('breadcrumb','Dashboard')

@section('content')
	<div class="d-grid gap-1 gap-lg-1">
		<div class="row">
			<x-landlord.widgets.kpi value="{{ $count_tickets }}" route="tickets"label="ALL TICKETS" icon="activity"/>
			<x-landlord.widgets.kpi value="{{ $count_all_open_tickets }}" route="tickets" label="TOTAL OPEN" icon="activity"/>
			<x-landlord.widgets.kpi value="{{ $count_unassigned_tickets }}" route="tickets" label="TOTAL UNASSIGNED" icon="activity"/>
			<x-landlord.widgets.kpi value="{{ $count_all_closed_tickets }}" route="services" label="TOTAL CLOSED" icon="activity"/>
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
