@extends('layouts.app')
@section('title','Pr')
@section('breadcrumb','Create Pr')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Pr
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
					<h5 class="card-title">Requisition Info</h5>
					</div>
					<div class="card-body">

						<div class="mb-3">
							<label class="form-label">Pr Summary</label>
							<input type="text" class="form-control @error('summary') is-invalid @enderror"
								name="summary" id="summary" placeholder="PR summary"
								value="{{ old('summary', '' ) }}"
								required/>
							@error('summary')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3 row">
							<label class="col-form-label col-sm-2 text-sm-right">Dept Name</label>
							<div class="col-sm-10">
								<select class="form-control" name="dept_id" required>
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

						<div class="mb-3 row">
							<label class="col-form-label col-sm-2 text-sm-right">Supplier</label>
							<div class="col-sm-10">
								<select class="form-control" name="supplier_id" required>
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
								<select class="form-control" name="project_id" required>
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
					<h5 class="card-title">Requisition Info</h5>
					</div>
					<div class="card-body">
						<div class="mb-3">
							<label class="form-label">Notes</label>
							<textarea class="form-control" name="notes"  placeholder="Enter ..." rows="3">{{ old('notes', 'Enter ...') }}</textarea>
							@error('notes')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<x-tenant.attachment.create  />

					</div>
			</div>
			<!-- end col-6 -->
		</div>
		<!-- end row -->

		{{-- =================PR lines create================================================= --}}
		<div class="row">
			<div class="col-12 col-xl-12">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Requisition Lines</h5>
						<h6 class="card-subtitle text-muted">Using the most basic table markup, here’s how .table-based tables look in Bootstrap.</h6>
					</div>
					<table class="table">
						<thead>
							<tr>
								<th class="">LINE#</th>
								<th class="">Item</th>
								<th class="">Summary</th>
								<th class="">UOM</th>
								<th class="text-end">Qty</th>
								<th class="text-end">Price</th>
								<th class="text-end">Amount</th>
								<th class="">Action</th>
							</tr>
						</thead>
						<tbody>
							@include('tenant.includes.pr-line-add')

							<tr class="">
								<td colspan="6" class="text-end">
									<strong>TOTAL:</strong>
								</td>
								<td class="text-end">
									<input type="number" step='0.01' min="1" class="form-control @error('amount') is-invalid @enderror"
										style="text-align: right;"
										name="amount" id="amount" placeholder="1.00"
										value="{{ old('amount','1.00') }}"
										required readonly>
									@error('amount')
											<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</td>
								<td class="">
									{{-- <x-tenant.widgets.submit/> --}}
								</td>
							</tr>
							<tr class="">
								<td colspan="6" class="">

								</td>
								<td class="">
									<div class="mb-3 float-end">
										<a class="btn btn-secondary" href="{{ url()->previous() }}"><i data-feather="x-circle"></i> Cancel</a>
										<button type="submit" id="submit" name="action" value="save" class="btn btn-primary"><i data-feather="save"></i> Save</button>
										<button type="submit" id="submit" name="action" value="save_add" class="btn btn-primary"><i data-feather="save"></i> Save and Add Line</button>
									</div>
								</td>
							</tr>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
		{{-- ============================================================== --}}

	</form>
	<!-- /.form end -->

@endsection