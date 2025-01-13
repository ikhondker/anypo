@extends('layouts.tenant.app')
@section('title','Budgets')

@section('breadcrumb')
	@if (! auth()->user()->isHoD())
		<li class="breadcrumb-item"><a href="{{ route('budgets.show', $deptBudget->budget->id ) }}" class="text-muted">{{ $deptBudget->budget->fy }}</a></li>
	@endif
	<li class="breadcrumb-item"><a href="{{ route('dept-budgets.index') }}" class="text-muted">Dept Budgets</a></li>
	<li class="breadcrumb-item active">{{ $deptBudget->dept->name }}</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Department Budget - {{ $deptBudget->dept->name }}
		@endslot
		@slot('buttons')
			<x-tenant.actions.dept-budget-actions deptBudgetId="{{ $deptBudget->id }}"/>
		@endslot
	</x-tenant.page-header>


	<div class="row">
		<x-tenant.charts.dept-budget-bar :dbid="$deptBudget->id"/>
		<x-tenant.charts.dept-budget-po-pie :dbid="$deptBudget->id"/>
		<x-tenant.charts.dept-budget-pr-pie :dbid="$deptBudget->id"/>
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
					<table class="table table-sm my-2">
						<tbody>
							<tr>
								<th width="20%">FY:</th>
								<td><span class="badge badge-subtle-primary">{{ $deptBudget->budget->fy }}</span></td>
							</tr>
							<tr>
								<th>Budget:</th>
								<td>{{ $deptBudget->budget->name }}<x-tenant.info info="Note: You wont be able to edit this."/></td>
							</tr>
							<tr>
								<th>Dept:</th>
								<td>{{ $deptBudget->dept->name }}<x-tenant.info info="Note: You wont be able to edit this Department."/></td>
							</tr>
							<x-tenant.show.my-date		value="{{ $deptBudget->budget->start_date }}" label="Start Date"/>
							<x-tenant.show.my-date		value="{{ $deptBudget->budget->end_date }}" label="End Date"/>
							<x-tenant.show.my-closed	value="{{ $deptBudget->closed }}"/>
							<x-tenant.show.my-badge		value="{{ $deptBudget->id }}"/>
							<x-tenant.show.my-text-area		value="{{ $deptBudget->notes }}" label="Notes"/>
							<tr>
								<th>&nbsp;</th>
								<td>
									@if (! $deptBudget->closed)
										<x-tenant.show.my-edit-link model="DeptBudget" :id="$deptBudget->id"/>
									@endif
								</td>
							</tr>
						</tbody>
					</table>

				</div>
			</div>

			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Departmental Budget for Purchase Order</h5>
					<h6 class="card-subtitle text-muted">Allocated and utilized annual budget for this period for Purchase Order.</h6>
				</div>
				<div class="card-body">
					<div class="row mb-3">
						<table class="table table-sm my-2">
							<tbody>
								<x-tenant.show.my-amount	value="{{ $deptBudget->amount }}" label="Budget"/>
								<x-tenant.show.my-amount	value="{{ $deptBudget->amount_po_booked }}" label="PO Booked"/>
								<x-tenant.show.my-amount	value="{{ $deptBudget->amount_po }}" label="PO Issued"/>
								<x-tenant.show.my-amount	value="{{ $deptBudget->amount - $deptBudget->amount_po_booked - $deptBudget->amount_po }}" label="Available"/>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Attachments</h5>
					<h6 class="card-subtitle text-muted">List of document attached with this budget.</h6>
				</div>
				<div class="card-body">
					<table class="table table-sm my-2">
						<tbody>
							<tr>
								<th>Attachments:</th>
								<td>
									<x-tenant.attachment.all entity="DEPTBUDGET" articleId="{{ $deptBudget->id }}"/>
								</td>
							</tr>
							<tr>
								<th>&nbsp;</th>
								<td>
									@if (! $deptBudget->closed)
                                        <x-tenant.attachment.add entity="{{ EntityEnum::DEPTBUDGET->value }}" articleId="{{ $deptBudget->id }}"/>
									@endif
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>


		</div>
		<!-- end col-6 -->
		<div class="col-6">

			<x-tenant.dashboards.pr-count-by-dept-budget deptBudgetId="{{ $deptBudget->id }}" />

			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Budget for Purchase Requisition</h5>
					<h6 class="card-subtitle text-muted">Allocated and utilized annual budget for this period for Purchase Requisition.</h6>
				</div>
				<div class="card-body">
					<table class="table table-sm my-2">
						<tbody>
							<x-tenant.show.my-amount	value="{{ $deptBudget->amount }}" label="Budget"/>
							<x-tenant.show.my-amount	value="{{ $deptBudget->amount_pr_booked }}" label="PR Booked"/>
							<x-tenant.show.my-amount	value="{{ $deptBudget->amount_pr }}" label="PR Issued"/>
							<x-tenant.show.my-amount	value="{{ $deptBudget->amount - $deptBudget->amount_pr_booked - $deptBudget->amount_pr }}" label="Available"/>
						</tbody>
					</table>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Annual Good Receive Amount</h5>
					<h6 class="card-subtitle text-muted">Allocated budget vs Good Receive Amount for this period.</h6>
				</div>
				<div class="card-body">
					<table class="table table-sm my-2">
						<tbody>
							<x-tenant.show.my-amount	value="{{ $deptBudget->amount }}" label="Budget"/>
							<x-tenant.show.my-amount	value="{{ $deptBudget->amount_grs }}" label="GRS Issued"/>
							<x-tenant.show.my-amount	value="{{ $deptBudget->amount- $deptBudget->amount_grs }}" label="Available"/>
						</tbody>
					</table>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Annual Payment</h5>
					<h6 class="card-subtitle text-muted">Allocated budget vs Payment made for this period.</h6>
				</div>
				<div class="card-body">
					<table class="table table-sm my-2">
						<tbody>
							<x-tenant.show.my-amount	value="{{ $deptBudget->amount }}" label="Budget"/>
							<x-tenant.show.my-amount	value="{{ $deptBudget->amount_payment }}" label="Payment Made"/>
							<x-tenant.show.my-amount	value="{{ $deptBudget->amount- $deptBudget->amount_payment }}" label="Available"/>
						</tbody>
					</table>
				</div>
			</div>


		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->


@endsection

