@extends('layouts.landlord-app')
@section('title','Dashboard')
@section('breadcrumb','Dashboard')

@section('content')
	<div class="d-grid gap-1 gap-lg-1">
		<div class="row">
			<x-landlord.widget.kpi value="{{ $count_tickets }}" route="tickets"  label="ALL TICKETS1" icon="com013"/>
			<x-landlord.widget.kpi value="{{ $count_all_open_tickets }}" route="tickets" label="TOTAL OPEN"  icon="abs029"/>
			<x-landlord.widget.kpi value="{{ $count_unassigned_tickets }}" route="tickets" label="TOTAL UNASSIGNED" icon="abs027"/>
			<x-landlord.widget.kpi value="{{ $count_all_closed_tickets }}" route="services" label="TOTAL CLOSED"  icon="com006"/>
		</div>
		<!-- End Row -->
	</div>

	<!-- ========== NOTICE ========== -->
	@include('landlord.includes.notice')
	<!-- ========== END NOTICE ========== -->

	<div class="d-grid gap-3 gap-lg-5">
		<x-landlord.widget.ticket-lists type="UNASSIGNED"/>
	
		<x-landlord.widget.ticket-lists type="OPEN"/>
	</div>


@endsection
