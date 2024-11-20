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
										<div class="small text-danger">{{ $message }}</div>
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
												<div class="small text-danger">{{ $message }}</div>
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
											<div class="small text-danger">{{ $message }}</div>
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
											<div class="small text-danger">{{ $message }}</div>
										@enderror
									</td>
								</tr>
								<x-tenant.create.currency/>
							</tbody>
						</table>
					</div>
				</div>
			</div>
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
									<th>Category :</th>
									<td>
										<select class="form-control select2" data-toggle="select2" name="category_id" required>
											<option value=""><< Category >> </option>
											@foreach ($categories as $category)
												<option value="{{ $category->id }}" {{ $category->id == old('category_id') ? 'selected' : '' }} >{{ $category->name }} </option>
											@endforeach
										</select>
										@error('category_id')
											<div class="small text-danger">{{ $message }}</div>
										@enderror
									</td>
								</tr>
								<tr>
									<th width="20%">Need By Date</th>
									<td>
										<input type="date" class="form-control @error('need_by_date') is-invalid @enderror"
										name="need_by_date" id="need_by_date" placeholder=""
										value="{{ old('need_by_date', date('Y-m-d') ) }}"
										required/>
									@error('need_by_date')
										<div class="small text-danger">{{ $message }}</div>
									@enderror
									</td>
								</tr>
								<tr>
									<th>Notes</th>
									<td>
										<textarea class="form-control" name="notes" placeholder="Enter ..." rows="3">{{ old('notes', 'Enter ...') }}</textarea>
										@error('notes')
											<div class="small text-danger">{{ $message }}</div>
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
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- end row -->

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<div class="form-check form-switch">
						<input class="form-check-input m-1" type="checkbox" id="add_row" name="add_row" checked>
						<label class="form-check-label" for="add_row">... add another Line</label>
					</div>
				</div>
				<h5 class="card-title">Requisition Lines</h5>
				<h6 class="card-subtitle text-muted">List of Requisition Lines.</h6>
			</div>

			<table class="table table-striped table-sm">
				<thead>
					<tr>
						<th class="text-center" style="width:1%">#</th>
						<th class="" style="width:15%">Item</th>
						<th class="" style="width:25%">Description</th>
						<th class="" style="width:8%">UOM</th>
						<th class="text-end" style="width:6%">Qty</th>
						<th class="text-end" style="width:9%">Price</th>
						<th class="text-end" style="width:9%">Subtotal</th>
						<th class="text-end" style="width:9%">Tax</th>
						<th class="text-end" style="width:9%">GST</th>
						<th class="text-end" style="width:9%">Amount</th>
					</tr>
				</thead>
				<tbody>
					@include('tenant.includes.pr.pr-line-add')
					<tr class="">
						<td colspan="9" class="text-end">
							<strong>TOTAL:</strong>
						</td>
						<td class="text-end">
							<input type="text" class="form-control @error('pr_amount') is-invalid @enderror"
								style="text-align: right;"
								name="pr_amount" id="pr_amount" placeholder="0.00"
								value="{{ old('pr_amount', (isset($pr->amount) ? number_format($pr->amount,2) : "0.00")) }}"
								readonly>
							@error('pr_amount')
									<div class="small text-danger">{{ $message }}</div>
							@enderror
						</td>
					</tr>
				</tbody>
			</table>

			<div class="card-footer">
				<div class="card-actions float-end">
					<a class="btn btn-secondary text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel" href="{{ route('prs.index') }}"><i data-lucide="x-circle"></i> Cancel</a>
					<button type="submit" id="submit" name="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Save"><i data-lucide="save"></i> Save</button>
				</div>
			</div>

		</div>

	</form>
	<!-- /.form end -->

	@include('tenant.includes.js.select2')
	@include('tenant.includes.js.calculate-pr-amount')

@endsection
