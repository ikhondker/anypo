@extends('layouts.app')
@section('title','Budgets')

@section('content')

	<x-tenant.page-header>
		@slot('title')
		Department Budget Lists
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="DeptBudget"/>
			<x-tenant.buttons.header.create object="DeptBudget"/>
			<x-tenant.buttons.header.edit object="DeptBudget" :id="$deptBudget->id"/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">DeptBudget Info</h5>
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
					<x-tenant.show.my-boolean	value="{{ $deptBudget->freeze }}"/>
					<x-tenant.show.my-badge		value="{{ $deptBudget->id }}"/>
					<x-tenant.show.my-text		value="{{ $deptBudget->notes }}" label="Notes"/>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
					<h5 class="card-title">DeptBudget PO</h5>
				</div>
				<div class="card-body">
					<div class="row mb-3">
						<x-tenant.show.my-amount	value="{{ $deptBudget->amount }}"/>
						<x-tenant.show.my-amount	value="{{ $deptBudget->amount_po_booked }}"/>
						<x-tenant.show.my-amount	value="{{ $deptBudget->amount_po_issued }}"/>
						<x-tenant.show.my-amount	value="{{ $deptBudget->amount - $deptBudget->amount_po_booked - $deptBudget->amount_po_issued }}"/>
					</div>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
					<div class="card-actions float-end">
						<div class="dropdown position-relative">
							<a href="#" data-bs-toggle="dropdown" data-bs-display="static">
								<i class="align-middle" data-feather="more-horizontal"></i>
							</a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="{{ route('dept-budgets.detach',$deptBudget->id) }}">Delete Attachment</a>
							</div>
						</div>
					</div>
					<h5 class="card-title">Attachments</h5>
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
				
				</div>
			</div>


		</div>
		<!-- end col-6 -->
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">DeptBudget PR</h5>
				</div>
				<div class="card-body">
				<x-tenant.show.my-amount	value="{{ $deptBudget->amount }}"/>
				<x-tenant.show.my-amount	value="{{ $deptBudget->amount_pr_booked }}"/>
				<x-tenant.show.my-amount	value="{{ $deptBudget->amount_pr_issued }}"/>
				<x-tenant.show.my-amount	value="{{ $deptBudget->amount - $deptBudget->amount_pr_booked - $deptBudget->amount_pr_issued }}"/>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
				<h5 class="card-title">GRS</h5>
				</div>
				<div class="card-body">
					<x-tenant.show.my-amount	value="{{ $deptBudget->amount }}"/>
					<x-tenant.show.my-amount	value="{{ $deptBudget->amount_grs }}"/>
					<x-tenant.show.my-amount	value="{{ $deptBudget->amount- $deptBudget->amount_grs }}"/>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
				<h5 class="card-title">Payment Details</h5>
				</div>
				<div class="card-body">
					<x-tenant.show.my-amount	value="{{ $deptBudget->amount }}"/>
					<x-tenant.show.my-amount	value="{{ $deptBudget->amount_payment }}"/>
					<x-tenant.show.my-amount	value="{{ $deptBudget->amount- $deptBudget->amount_payment }}"/>
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

