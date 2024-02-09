@extends('layouts.app')
@section('title','Budgets')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Department Budget Usages
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Dbu"/>
		@endslot
	</x-tenant.page-header>

	

	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">DeptBudget Usages Info</h5>
					<h6 class="card-subtitle text-muted">Using the most basic table markup, here’s how .table-based tables look in Bootstrap.</h6>
				</div>
				<div class="card-body">
					<x-tenant.show.my-text		value="{{ $dbu->id }}" label="ID"/>
					<x-tenant.show.my-text		value="{{ $dbu->deptBudget->budget->fy }}" label="FY"/>
					<x-tenant.show.my-text		value="{{ $dbu->dept->name }}" label="Dept"/>
					<x-tenant.show.my-date		value="{{ $dbu->created_at }}" label="Date"/>
					<x-tenant.show.my-text		value="{{ $dbu->entity }}" label="Entity"/>
					<x-tenant.show.my-text		value="{{ $dbu->article_id }}" label="Article ID"/>
					<x-tenant.show.my-text		value="{{ $dbu->event }}" label="Event"/>

				</div>
			</div>
	


		</div>
		<!-- end col-6 -->
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Dept Budget Usages</h5>
				</div>
				<div class="card-body">
				<x-tenant.show.my-amount	value="{{ $dbu->amount_pr_booked }}" label="PR Booked"/>
				<x-tenant.show.my-amount	value="{{ $dbu->amount_pr_issued }}" label="PR Approved"/>
				<x-tenant.show.my-amount	value="{{ $dbu->amount_po_booked }}" label="PO Booked"/>
				<x-tenant.show.my-amount	value="{{ $dbu->amount_po_issued }}" label="PO Issued"/>
				<x-tenant.show.my-amount	value="{{ $dbu->amount_grs }}" label="GRS Amount"/>
				<x-tenant.show.my-amount	value="{{ $dbu->amount_payment }}" label="Payment Amount"/>
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


@endsection

