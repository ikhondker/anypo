@extends('layouts.tenant.app')
@section('title','Create Requisition')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('prs.index') }}" class="text-muted">Requisitions</a></li>
	<li class="breadcrumb-item active">Create</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Requisition
		@endslot
		@slot('buttons')
			<a href="{{ route('prs.index') }}" class="btn btn-primary float-end me-2"><i data-lucide="list"></i> View All</a>
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
						<table class="table table-sm my-2">
							<tbody>
								<tr>
									<th width="20%">Summary :</th>
									<td>
										<input type="text" class="form-control @error('summary') is-invalid @enderror"
										name="summary" id="summary" placeholder="PR summary"
										value="{{ old('summary', '' ) }}"
										required/>
									@error('summary')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
									</td>
								</tr>
							
								<tr>
									<th>PR Date :</th>
									<td>
										<input type="text" class="form-control"
										name="dsp_date" id="dsp_date" value="{{ date_format(now(),"d-M-Y H:i:s"); }}"
										readonly/>
									</td>
								</tr>
																
								@if ( auth()->user()->role->value == UserRoleEnum::USER->value || auth()->user()->role->value == UserRoleEnum::HOD->value )
									<input type="text" name="dept_id" id="dept_id" class="form-control" placeholder="ID" value="{{ auth()->user()->dept_id }}" hidden>
								@else
									<tr>
										<th>Department :</th>
										<td>
											<select class="form-control select2" data-toggle="select2" name="dept_id" required>
												<option value=""><< Dept >> </option>
												@foreach ($depts as $dept)
													<option value="{{ $dept->id }}" {{ $dept->id == old('dept_id') ? 'selected' : '' }} >{{ $dept->name }} </option>
												@endforeach
											</select>
											@error('dept_id')
												<div class="text-danger text-xs">{{ $message }}</div>
											@enderror
										</td>
									</tr>
								@endif
								<tr>
									<th>Supplier :</th>
									<td>
										<select class="form-control select2" data-toggle="select2" name="supplier_id" required>
											<option value=""><< Supplier >> </option>
											@foreach ($suppliers as $supplier)
												<option value="{{ $supplier->id }}" {{ $supplier->id == old('supplier_id') ? 'selected' : '' }} >{{ $supplier->name }} </option>
											@endforeach
										</select>
										@error('supplier_id')
											<div class="text-danger text-xs">{{ $message }}</div>
										@enderror
									</td>
								</tr>
								<tr>
									<th>Project :</th>
									<td>
										<select class="form-control select2" data-toggle="select2" name="project_id" required>
											<option value=""><< Project >> </option>
											@foreach ($projects as $project)
												<option value="{{ $project->id }}" {{ $project->id == old('project_id') ? 'selected' : '' }} >{{ $project->name }} </option>
											@endforeach
										</select>
										@error('project_id')
											<div class="text-danger text-xs">{{ $message }}</div>
										@enderror
									</td>
								</tr>
								<x-tenant.create.currency/>
							</tbody>
						</table>
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
						<table class="table table-sm my-2">
							<tbody>
								<tr>
									<th width="20%">Need By Date</th>
									<td>
										<input type="date" class="form-control @error('need_by_date') is-invalid @enderror"
										name="need_by_date" id="need_by_date" placeholder=""
										value="{{ old('need_by_date', date('Y-m-d') ) }}"
										required/>
									@error('need_by_date')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
									</td>
								</tr>
								<tr>
									<th>Notes</th>
									<td>
										<textarea class="form-control" name="notes" placeholder="Enter ..." rows="3">{{ old('notes', 'Enter ...') }}</textarea>
										@error('notes')
											<div class="text-danger text-xs">{{ $message }}</div>
										@enderror
									</td>
								</tr>
								<x-tenant.attachment.create />
								<tr>
									<th>Requestor</th>
									<td>
										<input type="text" class="form-control"
										name="requestor" id="requestor"
										value="{{ auth()->user()->name }}"
										readonly/>
									</td>
								</tr>
										
								<x-tenant.buttons.show.save/>
							</tbody>
						</table>


						
					</div>
				</div>
			</div>
			<!-- end col-6 -->
		</div>
		<!-- end row -->

		<!-- widget-prl-cards -->
		<x-tenant.widgets.prl.card :readOnly="false" :addMore="true">
			@slot('lines')
				<tbody>
					@include('tenant.includes.pr.pr-line-add')
				</tbody>
			@endslot
		</x-tenant.widgets.prl.card>
		<!-- /.widget-prl-cards -->

	</form>
	<!-- /.form end -->

	@include('tenant.includes.js.select2')

@endsection
