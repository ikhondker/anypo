@extends('layouts.tenant.app')
@section('title','Budgets')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('budgets.index') }}" class="text-muted">Budgets</a></li>
	<li class="breadcrumb-item active">{{ $budget->name }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			FY {{ $budget->fy }} Budgets
		@endslot
		@slot('buttons')
			<x-tenant.actions.budget-actions budgetId="{{ $budget->id }}"/>
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
					<table class="table table-sm my-2">
						<tbody>

							<tr>
								<th width="20%">FY :</th>
								<td><span class="badge badge-subtle-primary">{{ $budget->fy }}</span></td>
							</tr>
							<x-tenant.show.my-amount	value="{{ $budget->amount }}" label="Budget"/>
							<x-tenant.show.my-text		value="{{ $budget->name }}" label="Name"/>
							<x-tenant.show.my-date		value="{{ $budget->start_date }}" label="Start Date"/>
							<x-tenant.show.my-date		value="{{ $budget->end_date }}" label="End Date"/>
							<x-tenant.show.my-text		value="{{ $budget->notes }}" label="Notes"/>
							<x-tenant.show.my-closed	value="{{ $budget->closed }}" label="Closed?"/>
							<tr>
								<th>&nbsp;</th>
								<td>
									@if (! $budget->closed)
										<x-tenant.show.my-edit-link model="Budget" :id="$budget->id"/>
									@endif
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>


			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Budget for Purchase Order</h5>
					<h6 class="card-subtitle text-muted">Allocated and utilized annual budget for this period for Purchase Order.</h6>
				</div>
				<div class="card-body">
					<table class="table table-sm my-2">
						<tbody>
							<x-tenant.show.my-amount	value="{{ $budget->amount }}" label="Budget"/>
							<x-tenant.show.my-amount	value="{{ $budget->amount_po_booked }}" label="PO Booked"/>
							<x-tenant.show.my-amount	value="{{ $budget->amount_po }}" label="PO Issued"/>
							<x-tenant.show.my-amount	value="{{ $budget->amount - $budget->amount_po_booked - $budget->amount_po }}" label="Available"/>
						</tbody>
					</table>

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
								<th>Attachments</th>
								<td><x-tenant.attachment.all entity="BUDGET" articleId="{{ $budget->id }}"/></td>
							</tr>
							<tr>
								<th></th>
								<td>
									@if (! $budget->closed)
										<x-tenant.attachment.add entity="{{ EntityEnum::BUDGET->value }}" articleId="{{ $budget->id }}"/>
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

			<x-tenant.dashboards.pr-count-by-budget budgetId="{{ $budget->id }}" />

			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Budget for Purchase Requisition</h5>
					<h6 class="card-subtitle text-muted">Allocated and utilized annual budget for this period for Purchase Requisition.</h6>
				</div>
				<div class="card-body">
					<table class="table table-sm my-2">
						<tbody>
							<x-tenant.show.my-amount	value="{{ $budget->amount }}" label="Budget"/>
							<x-tenant.show.my-amount	value="{{ $budget->amount_pr_booked }}" label="PR Booked"/>
							<x-tenant.show.my-amount	value="{{ $budget->amount_pr }}" label="PR Issued" />
							<x-tenant.show.my-amount	value="{{ $budget->amount - $budget->amount_pr_booked - $budget->amount_pr }}" label="Available"/>
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
							<x-tenant.show.my-amount	value="{{ $budget->amount }}" label="Budget"/>
							<x-tenant.show.my-amount	value="{{ $budget->amount_grs }}" label="GRS Issued"/>
							<x-tenant.show.my-amount	value="{{ $budget->amount- $budget->amount_grs }}" label="Available"/>
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

					<x-tenant.show.my-amount	value="{{ $budget->amount }}" label="Budget"/>
					<x-tenant.show.my-amount	value="{{ $budget->amount_payment }}" label="Paid Amount"/>
					<x-tenant.show.my-amount	value="{{ $budget->amount- $budget->amount_payment }}" label="Available"/>
					</tbody>
				</table>
				</div>
			</div>

		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->


@endsection

