@extends('layouts.tenant.app')
@section('title','Create Purchase Order')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('pos.index') }}" class="text-muted">Purchase Orders</a></li>
	<li class="breadcrumb-item active">Create</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Purchase Order
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Po" label="Purchase Order"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('pos.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header">
						
						<h5 class="card-title">Purchase Order Basic Information</h5>
						<h6 class="card-subtitle text-muted">Purchase Order Basic Information.</h6>
					</div>
					<div class="card-body">

						<table class="table table-sm my-2">
							<tbody>
						
								<tr>
									<th width="20%">PO Summary :</th>
									<td>
										<input type="text" class="form-control @error('summary') is-invalid @enderror"
										name="summary" id="summary" placeholder="PO summary"
										value="{{ old('summary', '' ) }}"
										required/>
									@error('summary')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
									</td>
								</tr>
								
								<tr>
									<th>PO Date :</th>
									<td>
										<div class="col-sm-9">
											<input type="text" class="form-control"
											name="dsp_date" id="dsp_date" value="{{ now() }}"
											readonly/>
									</td>
								</tr>
								
								
								@if ( auth()->user()->role->value == UserRoleEnum::USER->value || auth()->user()->role->value == UserRoleEnum::HOD->value )
									<input type="text" name="dept_id" id="dept_id" class="form-control" placeholder="ID" value="{{ auth()->user()->dept_id }}" hidden>
								@else
									<tr>
										<th>Dept Name :</th>
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
										<div class="col-sm-9">
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
						<div class="card-actions float-end">
							<a href="{{ route('pos.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
						</div>
						<h5 class="card-title">Purchase Order Additional Info</h5>
						<h6 class="card-subtitle text-muted">Purchase Order Additional Information.</h6>
					</div>
					<div class="card-body">
						<table class="table table-sm my-2">
							<tbody>
						
								<tr>
									<th>Need By Date :</th>
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
									<th>Terms and Conditions :</th>
									<td>
										<textarea class="form-control" name="notes" placeholder="Enter ..." rows="4">{{ old('notes', 'Enter ...') }}</textarea>
										@error('notes')
											<div class="text-danger text-xs">{{ $message }}</div>
										@enderror
										<div class="form-check form-switch">
											<input class="form-check-input mt-2" type="checkbox" id="tc" name="tc">
											<label class="form-check-label mt-1" for="tc">... include standard PO<a class="" data-bs-toggle="modal" data-bs-target="#exampleModal" href="#"> Terms and Conditions</a>.</label>
										</div>
									</td>
								</tr>
								<x-tenant.attachment.create />
								<tr>
									<th>Buyer :</th>
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

		<!-- widget-pol-cards -->
		<x-tenant.widgets.pol.card :readOnly="false" :addMore="true">
			@slot('lines')
				<tbody>
					@include('tenant.includes.po.po-line-add')
				</tbody>
			@endslot
		</x-tenant.widgets.pol.card>
		<!-- /.widget-pol-cards -->

	</form>
	<!-- /.form end -->

	@include('tenant.includes.js.select2')

@endsection
