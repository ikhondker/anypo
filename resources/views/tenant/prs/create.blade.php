@extends('layouts.app')
@section('title','Requisition')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('prs.index') }}">Requisitions</a></li>
	<li class="breadcrumb-item active">Create</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Requisition
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Pr"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('prs.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Requisition Basic Information</h5>
						<h6 class="card-subtitle text-muted">Requisition Basic Information.</h6>
					</div>
					<div class="card-body"> 

						<div class="mb-3 row">
							<label class="col-form-label col-sm-2 text-sm-right">PR Summary</label>
							<div class="col-sm-10">
								<input type="text" class="form-control @error('summary') is-invalid @enderror"
								name="summary" id="summary" placeholder="PR summary"
								value="{{ old('summary', '' ) }}"
								required/>
							@error('summary')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
							</div>
						</div>

						<div class="mb-3 row">
							<label class="col-form-label col-sm-2 text-sm-right">PR Date</label>
							<div class="col-sm-10">
								<input type="text" class="form-control"
								name="dsp_date" id="dsp_date" value="{{ date_format(now(),"d-M-Y H:i:s");  }}"
								readonly/>
							</div>
						</div>


						@if ( auth()->user()->role->value == UserRoleEnum::USER->value || auth()->user()->role->value == UserRoleEnum::HOD->value )
							<input type="text" name="dept_id" id="dept_id" class="form-control" placeholder="ID" value="{{ auth()->user()->dept_id }}" hidden>
						@else
							<div class="mb-3 row">
								<label class="col-form-label col-sm-2 text-sm-right">Dept Name</label>
								<div class="col-sm-10">
									<select class="form-control select2" data-toggle="select2" name="dept_id" required>
										<option value=""><< Dept >> </option>
										@foreach ($depts as $dept)
											<option value="{{ $dept->id }}" {{ $dept->id == old('dept_id') ? 'selected' : '' }} >{{ $dept->name }} </option>
										@endforeach
									</select>
									@error('dept_id')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</div>
							</div>
						@endif

						<div class="mb-3 row">
							<label class="col-form-label col-sm-2 text-sm-right">Supplier</label>
							<div class="col-sm-10">
								<select class="form-control select2" data-toggle="select2" name="supplier_id" required>
									<option value=""><< Supplier >> </option>
									@foreach ($suppliers as $supplier)
										<option value="{{ $supplier->id }}" {{ $supplier->id == old('supplier_id') ? 'selected' : '' }} >{{ $supplier->name }} </option>
									@endforeach
								</select>
								@error('supplier_id')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>
						</div>

						<div class="mb-3 row">
							<label class="col-form-label col-sm-2 text-sm-right">Project</label>
							<div class="col-sm-10">
								<select class="form-control select2" data-toggle="select2" name="project_id" required>
									<option value=""><< Project >> </option>
									@foreach ($projects as $project)
										<option value="{{ $project->id }}" {{ $project->id == old('project_id') ? 'selected' : '' }} >{{ $project->name }} </option>
									@endforeach
								</select>
								@error('project_id')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>
						</div>

						<x-tenant.create.currency/>

					</div>
				</div>
			</div>
			<!-- end col-6 -->
			<div class="col-6">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Requisition Additional Info</h5>
						<h6 class="card-subtitle text-muted">Requisition Additional Information.</h6>
					</div>
					<div class="card-body">

						<div class="mb-3">
							<label class="form-label">Notes</label>
							<textarea class="form-control" name="notes"  placeholder="Enter ..." rows="3">{{ old('notes', 'Enter ...') }}</textarea>
							@error('notes')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<x-tenant.attachment.create />

						<div class="mb-3">
							<label class="form-label">Requestor</label>
							<input type="text" class="form-control"
								name="requestor" id="requestor"
								value="{{ auth()->user()->name }}"
								readonly/>
						</div>
					</div>
				</div>		
			</div>
			<!-- end col-6 -->
		</div>
		<!-- end row -->


		{{-- =================PR lines create ================================================= --}}
		<div class="row">
			<div class="col-12 col-xl-12">
				<div class="card">
					<div class="card-header">
						<div class="card-actions float-end">
							<div class="dropdown position-relative">
									<div class="form-check form-switch">
										<input class="form-check-input m-1" type="checkbox" id="add_row" name="add_row" checked>
										<label class="form-check-label" for="add_row">... add another row</label>
									</div>
							</div>
						</div>
						<h5 class="card-title">Requisition Lines</h5>
						<h6 class="card-subtitle text-muted">List of Requisition Lines.</h6>
					</div>
					
					<table class="table table-striped table-hover">
						<x-tenant.widgets.prl.pr-lines-table-header/>
						<tbody>
							@include('tenant.includes.pr.pr-line-add')
							@include('tenant.includes.pr.pr-footer-form')
						</tbody>
					</table>
					
				</div>
			</div>
		</div>
		{{-- ============================================================== --}}
	
		

	</form>
	<!-- /.form end -->

	@include('tenant.includes.js.select2')
	

@endsection