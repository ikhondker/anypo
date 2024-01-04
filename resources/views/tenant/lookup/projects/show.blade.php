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
			<x-tenant.buttons.header.edit object="Project" :id="$project->id"/>
		@endslot
	</x-tenant.page-header>


	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Project Info</h5>
				</div>
				<div class="card-body">
					<x-tenant.show.my-badge    value="{{ $project->id }}"/>
					<x-tenant.show.my-text     value="{{ $project->name }}"/>
					<x-tenant.show.my-date     value="{{ $project->start_date  }}"/>
					<x-tenant.show.my-date     value="{{ $project->end_date  }}"/>
					<x-tenant.show.my-text     value="{{ $project->pm->name }}" label="Manager"/>
					<x-tenant.show.my-text     value="{{ $project->notes }}" label="Notes"/>
					<x-tenant.show.my-boolean  value="{{ $project->closed }}"/>
					<x-tenant.show.my-badge    value="{{ $project->id }}"/>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Project PO</h5>
				</div>
				<div class="card-body">
					<div class="row mb-3">
						<x-tenant.show.my-amount     value="{{ $project->amount }}"/>
						<x-tenant.show.my-amount     value="{{ $project->amount_po_booked }}" label="PO Booked"/>
						<x-tenant.show.my-amount     value="{{ $project->amount_po_issued }}" label="PO Issued"/>
						<x-tenant.show.my-amount     value="{{ $project->amount - $project->amount_po_booked - $project->amount_po_issued }}" label="Available"/>
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
								<a class="dropdown-item" href="{{ route('projects.detach',$project->id) }}">Delete Attachment</a>
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
							<x-tenant.attachment.all entity="PROJECT" aid="{{ $project->id }}"/>
						</div>
					</div>

					<form action="{{ route('projects.attach') }}" id="frm1" name="frm" method="POST" enctype="multipart/form-data">
						@csrf
						{{-- <x-tenant.attachment.create  /> --}}
						<input type="text" name="attach_project_id" id="attach_project_id" class="form-control" placeholder="ID" value="{{ old('id', $project->id ) }}" hidden>
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
					<h5 class="card-title">Project PR</h5>
				</div>
				<div class="card-body">
				<x-tenant.show.my-amount     value="{{ $project->amount }}"/>
				<x-tenant.show.my-amount     value="{{ $project->amount_pr_booked }}"/>
				<x-tenant.show.my-amount     value="{{ $project->amount_pr_issued }}"/>
				<x-tenant.show.my-amount     value="{{ $project->amount - $project->amount_pr_booked - $project->amount_pr_issued }}"/>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
				<h5 class="card-title">GRS</h5>
				</div>
				<div class="card-body">
					<x-tenant.show.my-amount     value="{{ $project->amount }}"/>
					<x-tenant.show.my-amount     value="{{ $project->amount_grs }}"/>
					<x-tenant.show.my-amount     value="{{ $project->amount- $project->amount_grs }}"/>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
				<h5 class="card-title">Payment Details</h5>
				</div>
				<div class="card-body">
					<x-tenant.show.my-amount     value="{{ $project->amount }}"/>
					<x-tenant.show.my-amount     value="{{ $project->amount_payment }}"/>
					<x-tenant.show.my-amount     value="{{ $project->amount- $project->amount_payment }}"/>
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

