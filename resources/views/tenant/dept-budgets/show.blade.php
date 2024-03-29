@extends('layouts.app')
@section('title','Budgets')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Department Budget - {{ $deptBudget->dept->name }}
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="DeptBudget"/>
			<x-tenant.buttons.header.create object="DeptBudget"/>
			<x-tenant.actions.dept-budget-actions id="{{ $deptBudget->id }}"/>
		@endslot
	</x-tenant.page-header>


	<div class="row">
		<x-tenant.charts.dept-budget-po-pie :dbid="$deptBudget->id"/>
		<x-tenant.charts.dept-budget-pr-pie :dbid="$deptBudget->id"/>
		<x-tenant.charts.dept-budget-bar :dbid="$deptBudget->id"/>
	</div>

	<x-tenant.dashboards.dept-budget-stat :dbid="$deptBudget->id"/> 


	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Budget Period</h5>
					<h6 class="card-subtitle text-muted">Budget Period detail.</h6>
				</div>
				<div class="card-body">
					<x-tenant.show.my-badge value="{{ $deptBudget->budget->fy }}" label="FY"/>
					<div class="row mb-3">
						<div class="col-sm-3 text-end">
							<span class="h6 text-secondary">Budget:</span>
						</div>
						<div class="col-sm-9">
							{{ $deptBudget->budget->name }} <x-tenant.info info="Note: You wont be able to edit this."/>
						</div>
					</div>
					<div class="row mb-3">
						<div class="col-sm-3 text-end">
							<span class="h6 text-secondary">Dept:</span>
						</div>
						<div class="col-sm-9">
							{{ $deptBudget->dept->name }} <x-tenant.info info="Note: You wont be able to edit this Department."/>
						</div>
					</div>
					<x-tenant.show.my-date		value="{{ $deptBudget->budget->start_date }}" label="Start Date"/>
					<x-tenant.show.my-date		value="{{ $deptBudget->budget->end_date }}" label="End Date"/>
					<x-tenant.show.my-closed	value="{{ $deptBudget->closed }}"/>
					<x-tenant.show.my-badge		value="{{ $deptBudget->id }}"/>
					<x-tenant.show.my-text		value="{{ $deptBudget->notes }}" label="Notes"/>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Departmental Budget for Purchase Order</h5>
					<h6 class="card-subtitle text-muted">Allocated and utilized annual budget for this period for Purchase Order.</h6>
				</div>
				<div class="card-body">
					<div class="row mb-3">
						<x-tenant.show.my-amount	value="{{ $deptBudget->amount }}" label="Budget"/>
						<x-tenant.show.my-amount	value="{{ $deptBudget->amount_po_booked }}" label="PO Booked"/>
						<x-tenant.show.my-amount	value="{{ $deptBudget->amount_po }}" label="PO Issued"/>
						<x-tenant.show.my-amount	value="{{ $deptBudget->amount - $deptBudget->amount_po_booked - $deptBudget->amount_po }}" label="Available"/>
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
							<x-tenant.attachment.all entity="DEPTBUDGET" aid="{{ $deptBudget->id }}"/>
						</div>
					</div>
					@if (! $deptBudget->closed)
						<form action="{{ route('dept-budgets.attach') }}" id="frm1" name="frm" method="POST" enctype="multipart/form-data">
							@csrf
							{{-- <x-tenant.attachment.create  /> --}}
							<input type="text" name="attach_dept_budget_id" id="attach_dept_budget_id" class="form-control" placeholder="ID" value="{{ old('id', $deptBudget->id ) }}" hidden>
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
				<x-tenant.show.my-amount	value="{{ $deptBudget->amount }}" label="Budget"/>
				<x-tenant.show.my-amount	value="{{ $deptBudget->amount_pr_booked }}" label="PR Booked"/>
				<x-tenant.show.my-amount	value="{{ $deptBudget->amount_pr }}" label="PR Issued"/>
				<x-tenant.show.my-amount	value="{{ $deptBudget->amount - $deptBudget->amount_pr_booked - $deptBudget->amount_pr }}" label="Available"/>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Annual Good Receive Amount</h5>
					<h6 class="card-subtitle text-muted">Allocated budget vs Good Receive Amount for this period.</h6>
				</div>
				<div class="card-body">
					<x-tenant.show.my-amount	value="{{ $deptBudget->amount }}" label="Budget"/>
					<x-tenant.show.my-amount	value="{{ $deptBudget->amount_grs }}" label="GRS Issues"/>
					<x-tenant.show.my-amount	value="{{ $deptBudget->amount- $deptBudget->amount_grs }}" label="Available"/>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Annual Payment</h5>
					<h6 class="card-subtitle text-muted">Allocated budget vs Payment made for this period.</h6>
				</div>
				<div class="card-body">
					<x-tenant.show.my-amount	value="{{ $deptBudget->amount }}" label="Budget"/>
					<x-tenant.show.my-amount	value="{{ $deptBudget->amount_payment }}" label="Payment Made"/>
					<x-tenant.show.my-amount	value="{{ $deptBudget->amount- $deptBudget->amount_payment }}" label="Available"/>
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
	
	@include('tenant.includes.js.sweet-alert2-advance')

	<script type="text/javascript">
		function mySubmit() {
			document.getElementById('frm1').submit();
		}
	</script>


@endsection

