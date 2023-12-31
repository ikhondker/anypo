@extends('layouts.app')
@section('title','Budgets')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Budgets
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Budget"/>
			<x-tenant.buttons.header.edit object="Budget" :id="$budget->id"/>
		@endslot
	</x-tenant.page-header>


	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Budget Info</h5>
				</div>
				<div class="card-body">
					<x-tenant.show.my-badge		value="{{ $budget->fy }}" label="FY"/>
					<x-tenant.show.my-text		value="{{ $budget->name }}"/>
					<x-tenant.show.my-date		value="{{ $budget->start_date  }}"/>
					<x-tenant.show.my-date		value="{{ $budget->end_date  }}"/>
					<x-tenant.show.my-text		value="{{ $budget->notes }}" label="Notes"/>
					<x-tenant.show.my-boolean	value="{{ $budget->enable }}"  label="Freeze?"/>
					{{-- <x-tenant.show.my-badge value="{{ $budget->id }}"/> --}}
				</div>
			</div>

			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Budget PO</h5>
				</div>
				<div class="card-body">
					<div class="row mb-3">
						<x-tenant.show.my-amount	value="{{ $budget->amount }}" label="Budget"/>
						<x-tenant.show.my-amount	value="{{ $budget->amount_po_booked }}" label="PO Booked"/>
						<x-tenant.show.my-amount	value="{{ $budget->amount_po_issued }}" label="PO Issued"/>
						<x-tenant.show.my-amount	value="{{ $budget->amount - $budget->amount_po_booked - $budget->amount_po_issued }}" label="Available"/>
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
								<a class="dropdown-item" href="{{ route('budgets.detach',$budget->id) }}">Delete Attachment</a>
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
							<x-tenant.attachment.all entity="BUDGET" aid="{{ $budget->id }}"/>
						</div>
					</div>

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
				
				</div>
			</div>
		</div>
		<!-- end col-6 -->
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Budget PR</h5>
				</div>
				<div class="card-body">
				<x-tenant.show.my-amount	value="{{ $budget->amount }}" label="Budget"/>
				<x-tenant.show.my-amount	value="{{ $budget->amount_pr_booked }}" label="PR Approved"/>
				<x-tenant.show.my-amount	value="{{ $budget->amount_pr_issued }}" label="PR Issues" />
				<x-tenant.show.my-amount	value="{{ $budget->amount - $budget->amount_pr_booked - $budget->amount_pr_issued }}" label="Available"/>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
				<h5 class="card-title">GRS</h5>
				</div>
				<div class="card-body">
					<x-tenant.show.my-amount	value="{{ $budget->amount }}" label="Budget"/>
					<x-tenant.show.my-amount	value="{{ $budget->amount_grs }}" label="GRS Booked"/>
					<x-tenant.show.my-amount	value="{{ $budget->amount- $budget->amount_grs }}" label="Available"/>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
				<h5 class="card-title">Payment Details</h5>
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

@endsection

