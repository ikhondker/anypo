@extends('layouts.tenant.app')
@section('title','Edit Purchase Order')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('pos.index') }}" class="text-muted">Purchase Orders</a></li>
	<li class="breadcrumb-item"><a href="{{ route('pos.show',$po->id) }}" class="text-muted">PO#{{ $po->id }}</a></li>
	<li class="breadcrumb-item active">Edit</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit PO#{{ $po->id }}
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Po" label="Purchase Order"/>
			<x-tenant.buttons.header.create object="Po" label="Purchase Order"/>
			<x-tenant.actions.po-actions poId="{{ $po->id }}" show="true"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('pos.update',$po->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

			<div class="row">
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Basic Information PO#{{ $po->id }}</h5>
							<h6 class="card-subtitle text-muted">Edit Basic Information of Purchase Order.</h6>
						</div>
						<div class="card-body">
							<table class="table table-sm my-2">
								<tbody>
									<tr>
										<th width="20%">PO Summary :</th>
										<td>
											<input type="text" class="form-control @error('summary') is-invalid @enderror"
											name="summary" id="summary" placeholder="PR summary"
											value="{{ old('summary', $po->summary ) }}"
											required/>
										@error('summary')
											<div class="text-danger text-xs">{{ $message }}</div>
										@enderror
										</td>
									</tr>
									<tr>
										<th>PO Date :</th>
										<td>
											<input type="text" class="form-control"
											name="dsp_date" id="dsp_date" value="{{ date_format($po->po_date,"d-M-Y H:i:s"); }}"
											readonly/>
										</td>
									</tr>
									@if ( auth()->user()->role->value == UserRoleEnum::USER->value || auth()->user()->role->value == UserRoleEnum::HOD->value )
										<input type="text" name="dept_id" id="dept_id" class="form-control" placeholder="ID" value="{{ auth()->user()->dept_id }}" hidden>
									@else
										<tr>
											<th>Dept Name :</th>
											<td>
												<select class="form-control select2" data-toggle="select2" name="dept_id" id="dept_id">
													@foreach ($depts as $dept)
														<option {{ $dept->id == old('dept_id',$po->dept_id) ? 'selected' : '' }} value="{{ $dept->id }}">{{ $dept->name }} </option>
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
											<select class="form-control select2" data-toggle="select2" name="supplier_id" id="supplier_id">
												@foreach ($suppliers as $supplier)
													<option {{ $supplier->id == old('supplier_id',$po->supplier_id) ? 'selected' : '' }} value="{{ $supplier->id }}">{{ $supplier->name }} </option>
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
											<select class="form-control select2" data-toggle="select2" name="project_id" id="project_id">
												@foreach ($projects as $project)
													<option {{ $project->id == old('project_id',$po->project_id) ? 'selected' : '' }} value="{{ $project->id }}">{{ $project->name }} </option>
												@endforeach
											</select>
											@error('project_id')
												<div class="text-danger text-xs">{{ $message }}</div>
											@enderror
										</td>
									</tr>
									<x-tenant.edit.currency :value="$po->currency"/>
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
								
							</div>
							<h5 class="card-title">Edit Purchase Order Other Information</h5>
							<h6 class="card-subtitle text-muted">Edit Purchase Order Other Information.</h6>
						</div>
						<div class="card-body">
							<table class="table table-sm my-2">
								<tbody>

									<tr>
										<th width="20%">Need By Date :</th>
										<td>
											<input type="date" class="form-control @error('need_by_date') is-invalid @enderror"
											name="need_by_date" id="need_by_date" placeholder=""
											value="{{ old('need_by_date', date('Y-m-d',strtotime($po->need_by_date)) ) }}"
											required/>
											@error('need_by_date')
												<div class="text-danger text-xs">{{ $message }}</div>
											@enderror
										</td>
									</tr>
									<tr>
										<th>Terms and Conditions :</th>
										<td>
											<textarea class="form-control" name="notes" placeholder="Enter ..." rows="3">{{ old('notes', $po->notes) }}</textarea>
											@error('notes')
												<div class="text-danger text-xs">{{ $message }}</div>
											@enderror
											<div class="form-check form-switch">
												<input class="form-check-input mt-2" type="checkbox" id="tc" name="tc" @checked($po->tc)>
												<label class="form-check-label mt-1" for="tc">... include standard PO<a class="" data-bs-toggle="modal" data-bs-target="#exampleModal" href="#"> Terms and Conditions</a>.</label>
											</div>
										</td>
									</tr>
									<x-tenant.attachment.create />
									<tr>
										<th>Requestor :</th>
										<td>
											<select class="form-control" name="requestor_id">
												@foreach ($users as $user)
													<option {{ $user->id == old('requestor_id',$po->requestor_id) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }} </option>
												@endforeach
											</select>
											@error('requestor_id')
												<div class="text-danger text-xs">{{ $message }}</div>
											@enderror
										</td>
									</tr>
									<tr>
										<th>Buyer :</th>
										<td>
											<input type="text" class="form-control"
											name="requestor" id="requestor"
											value="{{ $po->buyer->name }}"
											readonly/>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- end col-6 -->
			</div>

			<x-tenant.widgets.pol.list-all-lines poId="{{ $po->id }}"/>

			<div class="float-end">
				<a class="btn btn-secondary text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel" href="{{ route('pos.show',$po->id) }}"><i data-lucide="x-circle"></i> Cancel</a>
				<button type="submit" id="submit" name="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Save"><i data-lucide="save"></i> Save</button>
			</div>

	</form>
	<!-- /.form end -->
@endsection

