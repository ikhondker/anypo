@extends('layouts.app')
@section('title','Budgets')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			FY {{ $budget->fy }} Budgets 
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Budget"/>
			<x-tenant.buttons.header.edit object="Budget" :id="$budget->id"/>
			<x-tenant.actions.budget-actions id="{{ $budget->id }}"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<x-tenant.charts.budget-po-pie :bid="$budget->id"/>
		<x-tenant.charts.budget-by-dept-pie :bid="$budget->id"/>
		<x-tenant.charts.budget-by-dept-po-bar :bid="$budget->id"/>
	</div>

	<x-tenant.dashboards.budget-stat :bid="$budget->id"/>

	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Budget Period</h5>
					<h6 class="card-subtitle text-muted">Budget Period detail.</h6>
				</div>
				<div class="card-body">
					<x-tenant.show.my-badge		value="{{ $budget->fy }}" label="FY"/>
					<x-tenant.show.my-text		value="{{ $budget->name }}" label="Name"/>
					<x-tenant.show.my-date		value="{{ $budget->start_date }}" label="Start Date"/>
					<x-tenant.show.my-date		value="{{ $budget->end_date }}" label="End Date"/>
					<x-tenant.show.my-text		value="{{ $budget->notes }}" label="Notes"/>
					<x-tenant.show.my-closed	value="{{ $budget->closed }}"  label="Closed?"/>
					<x-tenant.buttons.show.edit object="Budget" :id="$budget->id"/>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Budget for Purchase Order</h5>
					<h6 class="card-subtitle text-muted">Allocated and utilized annual budget for this period for Purchase Order.</h6>
				</div>
				<div class="card-body">
					<div class="row mb-3">
						<x-tenant.show.my-amount	value="{{ $budget->amount }}" label="Budget"/>
						<x-tenant.show.my-amount	value="{{ $budget->amount_po_booked }}" label="PO Booked"/>
						<x-tenant.show.my-amount	value="{{ $budget->amount_po }}" label="PO Issued"/>
						<x-tenant.show.my-amount	value="{{ $budget->amount - $budget->amount_po_booked - $budget->amount_po }}" label="Available"/>
					</div>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Attachments</h5>
					<h6 class="card-subtitle text-muted">List of document attached with this budget.</h6>
				</div>
				<div class="card-body">
					<div class="row mb-3">
						<div class="col-sm-3 text-end">
							<span class="h6 text-secondary">Attachments:</span>
						</div>
						<div class="col-sm-9">
							<x-tenant.attachment.all entity="BUDGET" aid="{{ $budget->id }}"/>
						</div>
					</div>
					@if (! $budget->closed)
						<form action="{{ route('budgets.attach') }}" id="frm1" name="frm" method="POST" enctype="multipart/form-data">
							@csrf
							{{-- <x-tenant.attachment.create  /> --}}
							<input type="text" name="attach_budget_id" id="attach_budget_id" class="form-control" placeholder="ID" value="{{ old('id', $budget->id ) }}" hidden>
							<div class="row">
								<div class="col-sm-3 text-end">
								
								</div>
								<div class="col-sm-9 text-end">
									<input type="file" id="file_to_upload" name="file_to_upload" onchange="mySubmit()" style="display:none;" />
									<a href="" class="text-warning d-inline-block" onclick="document.getElementById('file_to_upload').click(); return false">Add Attachment</a>
								</div>
							</div>
						</form>
						<!-- /.form end -->
					@endif	
				</div>
			</div>
		</div>
		<!-- end col-6 -->
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Budget for Purchase Requisition</h5>
					<h6 class="card-subtitle text-muted">Allocated and utilized annual budget for this period for Purchase Requisition.</h6>
				</div>
				<div class="card-body">
				<x-tenant.show.my-amount	value="{{ $budget->amount }}" label="Budget"/>
				<x-tenant.show.my-amount	value="{{ $budget->amount_pr_booked }}" label="PR Booked"/>
				<x-tenant.show.my-amount	value="{{ $budget->amount_pr }}" label="PR Issues" />
				<x-tenant.show.my-amount	value="{{ $budget->amount - $budget->amount_pr_booked - $budget->amount_pr }}" label="Available"/>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
						<h5 class="card-title">Annual Good Receive Amount</h5>
						<h6 class="card-subtitle text-muted">Allocated budget vs Good Receive Amount for this period.</h6>
				</div>
				<div class="card-body">
					<x-tenant.show.my-amount	value="{{ $budget->amount }}" label="Budget"/>
					<x-tenant.show.my-amount	value="{{ $budget->amount_grs }}" label="GRS Booked"/>
					<x-tenant.show.my-amount	value="{{ $budget->amount- $budget->amount_grs }}" label="Available"/>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Annual Payment</h5>
					<h6 class="card-subtitle text-muted">Allocated budget vs Payment made for this period.</h6>
				</div>
				<div class="card-body">
					<x-tenant.show.my-amount	value="{{ $budget->amount }}" label="Budget"/>
					<x-tenant.show.my-amount	value="{{ $budget->amount_payment }}" label="Paid Amount"/>
					<x-tenant.show.my-amount	value="{{ $budget->amount- $budget->amount_payment }}" label="Available"/>
				</div>
			</div>
			
		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->

	<div class="row">
		<div class="col-6">
			
		</div>
		<!-- end col-6 -->
		<div class="col-6">
			
		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->

	<script type="text/javascript">
		function mySubmit() {
			document.getElementById('frm1').submit();
		}
	</script>

	@include('tenant.includes.js.sweet-alert2-advance')

@endsection

