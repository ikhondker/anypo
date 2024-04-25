@extends('layouts.app')
@section('title','Create Purchase Order')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('pos.index') }}">Purchase Orders</a></li>
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

						<div class="mb-3 row">
							<label class="col-form-label col-sm-2 text-sm-right">PO Summary</label>
							<div class="col-sm-10">
								<input type="text" class="form-control @error('summary') is-invalid @enderror"
									name="summary" id="summary" placeholder="PO summary"
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
								name="dsp_date" id="dsp_date" value="{{ now() }}"
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
						
						<h5 class="card-title">Purchase Order Additional Info</h5>
						<h6 class="card-subtitle text-muted">Purchase Order Additional Information.</h6>
					</div>
					<div class="card-body">
						<div class="mb-3">
	
							<label class="form-label">Terms and Conditions</label>
							<textarea class="form-control" name="notes"  placeholder="Enter ..." rows="4">{{ old('notes', 'Enter ...') }}</textarea>
							@error('notes')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
							<div class="form-check form-switch">
								<input class="form-check-input mt-2" type="checkbox" id="tc" name="tc">
								<label class="form-check-label mt-1" for="tc">... include standard PO<a class="" data-bs-toggle="modal" data-bs-target="#exampleModal" href="#"> Terms and Conditions</a>.</label>
							</div>	
						</div>

						<x-tenant.attachment.create  />

						<div class="mb-3">
							<label class="form-label">Buyer</label>
							<input type="text" class="form-control"
								name="buyer" id="buyer"
								value="{{  auth()->user()->name  }}"
								readonly/>
						</div>

					</div>
				</div>
			</div>
			<!-- end col-6 -->
		</div>
		<!-- end row -->

		{{-- =================PO lines create================================================= --}}
		<div class="row">
			<div class="col-12 col-xl-12">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Purchase Order Lines</h5>
						<h6 class="card-subtitle text-muted">Using the most basic table markup, here’s how .table-based tables look in Bootstrap.</h6>
					</div>
					<table class="table  table-bordered">
						<thead>
							<tr>
								<th class="">LINE#</th>
								<th class="">Item</th>
								<th class="">Summary</th>
								<th class="">UOM</th>
								<th class="text-end">Qty</th>
								<th class="text-end">Received</th>
								<th class="text-end">Price</th>
								<th class="text-end">Subtotal</th>
								<th class="text-end">Tax</th>
								<th class="text-end">GST</th>
								<th class="text-end">Amount</th>
								<th class="text-end">Status</th>
								<th class="">Action</th>
							</tr>
						</thead>
						<tbody>
							@include('tenant.includes.po.po-line-add')
							@include('tenant.includes.po.po-footer-form')
						</tbody>
					</table>
				</div>
			</div>
		</div>
		{{-- ============================================================== --}}

	</form>
	<!-- /.form end -->

	<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Standard PO Terms and Conditions</h5>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			aaaaaaaaaaaaaaa
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		</div>
		</div>
	</div>
</div>

	@include('tenant.includes.js.select2')
	
@endsection