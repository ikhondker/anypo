@extends('layouts.app')
@section('title','Projects')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Projects
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Project"/>
			<x-tenant.buttons.header.create object="Project"/>
			<x-tenant.actions.project-actions id="{{ $project->id }}"/>
		@endslot
	</x-tenant.page-header>


	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Project Basic Info</h5>
					<h6 class="card-subtitle text-muted">Project Basic Information.</h6>
				</div>
				<div class="card-body">
					<x-tenant.show.my-text		value="{{ $project->name }}"/>
					<x-tenant.show.my-date		value="{{ $project->start_date  }}" label="Start Date"/>
					<x-tenant.show.my-date		value="{{ $project->end_date  }}" label="End Date"/>
					<x-tenant.show.my-text		value="{{ $project->pm->name }}" label="Project Manager"/>
					<x-tenant.show.my-boolean	value="{{ $project->closed }}" label="Closed?"/>
					<x-tenant.show.my-text		value="{{ $project->notes }}" label="Notes"/>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Project Purchase Orders Budget</h5>
					<h6 class="card-subtitle text-muted">Project Purchase Orders Budget.</h6>
				</div>
				<div class="card-body">
					<div class="row mb-3">
						<x-tenant.show.my-amount	value="{{ $project->amount }}" label="Budget"/>
						<x-tenant.show.my-amount	value="{{ $project->amount_po_booked }}" label="PO Booked"/>
						<x-tenant.show.my-amount	value="{{ $project->amount_po }}" label="PO Issued"/>
						<x-tenant.show.my-amount	value="{{ $project->amount - $project->amount_po_booked - $project->amount_po }}" label="Available"/>
					</div>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Attachments</h5>
					<h6 class="card-subtitle text-muted">Project Purchase Orders Budget.</h6>
				</div>
				<div class="card-body">
					<div class="row mb-3">
						<div class="col-sm-3 text-end">
							<span class="h6 text-secondary">Attachments:</span>
						</div>
						<div class="col-sm-9">
							<x-tenant.attachment.all entity="PROJECT" aid="{{ $project->id }}"/>
						</div>
					</div>

					<form action="{{ route('projects.attach') }}" id="frm1" name="frm" method="POST" enctype="multipart/form-data">
						@csrf
						{{-- <x-tenant.attachment.create  /> --}}
						<input type="text" name="attach_project_id" id="attach_project_id" class="form-control" placeholder="ID" value="{{ old('attach_project_id', $project->id ) }}" hidden>
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
					<h5 class="card-title">Project Purchase Requisition Budget</h5>
					<h6 class="card-subtitle text-muted">Project Requisition Orders Budget.</h6>
				</div>
				<div class="card-body">
				<x-tenant.show.my-amount	value="{{ $project->amount }}" label="Budget"/>
				<x-tenant.show.my-amount	value="{{ $project->amount_pr_booked }}" label="PR Booked"/>
				<x-tenant.show.my-amount	value="{{ $project->amount_pr }}" label="PR Issued"/>
				<x-tenant.show.my-amount	value="{{ $project->amount - $project->amount_pr_booked - $project->amount_pr }}" label="Available"/>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Project Goods Receipt Amount</h5>
					<h6 class="card-subtitle text-muted">Project Goods Receipt Amount.</h6>
				</div>
				<div class="card-body">
					<x-tenant.show.my-amount	value="{{ $project->amount }}" label="Budget"/>
					<x-tenant.show.my-amount	value="{{ $project->amount_grs }}" label="GRS Issued"/>
					<x-tenant.show.my-amount	value="{{ $project->amount- $project->amount_grs }}" label="Available"/>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Project Invoice Amount</h5>
					<h6 class="card-subtitle text-muted">Project Invoice Amount.</h6>
				</div>
				<div class="card-body">
					<x-tenant.show.my-amount	value="{{ $project->amount }}" label="Budget"/>
					<x-tenant.show.my-amount	value="{{ $project->amount_invoice }}" label="Invoice Received"/>
					<x-tenant.show.my-amount	value="{{ $project->amount- $project->amount_invoice }}" label="Available"/>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Project Payment Amount</h5>
					<h6 class="card-subtitle text-muted">Project Payment Amount.</h6>
				</div>
				<div class="card-body">
					<x-tenant.show.my-amount	value="{{ $project->amount }}" label="Budget"/>
					<x-tenant.show.my-amount	value="{{ $project->amount_payment }}" label="Paid Amount"/>
					<x-tenant.show.my-amount	value="{{ $project->amount- $project->amount_payment }}" label="Available"/>
				</div>
			</div>
			
		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->
	
	<script type="text/javascript">
		function mySubmit() {
			//alert('I am inside 2');
			//document.getElementById('upload').click();
			document.getElementById('frm1').submit();
		}
	</script>
@endsection

