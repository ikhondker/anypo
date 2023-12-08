@extends('layouts.landlord-app')
@section('title','Dashboard')
@section('breadcrumb','Dashboard')

@section('content')

	<div class="d-grid gap-1 gap-lg-1">
		<div class="row">
			<x-landlord.widget.kpi value="{{ $count_tickets_open }}" route="tickets"  label="OPEN TICKETS" icon="com013"/>
			<x-landlord.widget.kpi value="{{ $count_tickets_total }}" route="tickets" label="TOTAL TICKETS" icon="abs027"/>
			<x-landlord.widget.kpi value="{{ $count_accounts }}" route="accounts" label="ACCOUNTS"  icon="com006"/>
			<x-landlord.widget.kpi value="{{ $count_users }}" route="users" label="USER"  icon="abs029"/>
		</div>
		<!-- End Row -->
	</div>

	<!-- ========== NOTICE ========== -->
	@include('landlord.includes.notice')
	<!-- ========== END NOTICE ========== -->


	@if ($account->next_bill_generated)
	<div class="alert alert-soft-info alert-dismissible fade show" role="alert">
		<div class="d-flex">
			<div class="flex-shrink-0">
				<i class="bi-exclamation-triangle-fill"></i>
			</div>
			<div class="flex-grow-1 ms-2">
				<span class="fw-semibold">Information: </span> You have an unpaid invoice 		
				<a class="text-danger" href="{{ route('home.invoice', $account->next_invoice_no) }}" target="_blank"> #{{ $account->next_invoice_no }}</a>.
				Might consider paying it now.
			</div>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>
	</div>
	@endif

	<div class="d-grid gap-3 gap-lg-5">
		<x-landlord.widget.ticket-lists type="OPEN"/>

		<x-landlord.widget.ticket-lists type="CLOSED"/>
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
