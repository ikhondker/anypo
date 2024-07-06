@extends('layouts.tenant.app')
@section('title','Additional Information for Requisition')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('prs.index') }}">Requisitions</a></li>
	<li class="breadcrumb-item"><a href="{{ route('prs.show',$pr->id) }}">PR#{{ $pr->id }}</a></li>
	<li class="breadcrumb-item active">Additional Information</li>
@endsection
@section('content')

	<x-tenant.page-header>
		@slot('title')
			Additional Information for Requisition
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Pr" label="Requisition"/>
			<x-tenant.buttons.header.create object="Pr" label="Requisition"/>
			<x-tenant.actions.pr-actions id="{{ $pr->id }}" show="true"/>

		@endslot
	</x-tenant.page-header>

	<x-tenant.info.pr-info id="{{ $pr->id }}"/>


	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Additional Information PR# {{ $pr->id }}</h5>
					<h6 class="card-subtitle text-muted">Additional information of a Purchase Requisitions</h6>
				</div>
				<div class="card-body">

					<table class="table table-sm my-2">
						<tbody>
							<x-tenant.show.my-amount-currency	value="{{ $pr->sub_total }}" currency="{{ $pr->currency }}" label="Subtotal"/>
							<x-tenant.show.my-amount-currency	value="{{ $pr->tax }}" currency="{{ $pr->currency }}" label="Tax"/>
							<x-tenant.show.my-amount-currency	value="{{ $pr->gst }}" currency="{{ $pr->currency }}" label="GST"/>
							<x-tenant.show.my-amount-currency	value="{{ $pr->amount }}" currency="{{ $pr->currency }}" label="PR Amount" />
							<x-tenant.show.my-date		value="{{ $pr->submission_date }}" label="Submission Date"/>
							<x-tenant.show.my-date		value="{{ $pr->auth_date }}" label="Auth Date"/>
							<x-tenant.show.my-text		value="{{ $pr->hierarchy->name }}" label="Hierarchy Name"/>
						</tbody>
					</table>
				</div>
			</div>

		</div>
		<!-- end col-6 -->
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Currency Conversion Information</h5>
					<h6 class="card-subtitle text-muted">Requisitions Amounts in Functional Currency.</h6>
				</div>
				<div class="card-body">

					<table class="table table-sm my-2">
						<tbody>


						<x-tenant.show.my-text		value="{{ $pr->fc_currency }}" label="Functional Currency"/>
						<x-tenant.show.my-amount	value="{{ $pr->fc_exchange_rate }}" label="Exchange Rate"/>
						<x-tenant.show.my-amount	value="{{ $pr->fc_sub_total }}" label="Subtotal"/>
						<x-tenant.show.my-amount	value="{{ $pr->fc_tax }}" label="Tax"/>
						<x-tenant.show.my-amount	value="{{ $pr->fc_gst }}" label="GST"/>
						<x-tenant.show.my-amount	value="{{ $pr->fc_amount }}" label="PR Amount"/>
						</tbody>
					</table>

				</div>
			</div>



		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->
@endsection

