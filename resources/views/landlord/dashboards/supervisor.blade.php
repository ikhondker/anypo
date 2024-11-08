@extends('layouts.landlord.app')
@section('title','Dashboard')
@section('breadcrumb')
	<li class="breadcrumb-item active">Dashboard</li>
@endsection


@section('content')

    <a href="{{ route('contacts.create') }}" class="btn btn-primary float-end mt-n1"><i class="fas fa-plus"></i> New Contact</a>
    <h1 class="h3 mb-3">Dashboard</h1>


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
