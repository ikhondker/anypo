@extends('layouts.tenant.app')
@section('title','Edit Requisition')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('prs.index') }}" class="text-muted">Requisitions</a></li>
	<li class="breadcrumb-item"><a href="{{ route('prs.show',$pr->id) }}" class="text-muted">PR#{{ $pr->id }}</a></li>
	<li class="breadcrumb-item active">Edit</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			PR #{{ $pr->id }} : Edit
		@endslot
		@slot('buttons')
			<a href="{{ route('prs.index') }}" class="btn btn-primary float-end me-2"><i data-lucide="list"></i> View All</a>
			<x-tenant.buttons.header.create model="Pr" label="Requisition"/>
			<x-tenant.actions.pr-actions prId="{{ $pr->id }}" show="true"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('prs.update', $pr->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

			<div class="row">
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Basic Information PR #{{ $pr->id }}</h5>
							<h6 class="card-subtitle text-muted">Edit Basic Information of Requisition.</h6>
						</div>
						<div class="card-body">

							<table class="table table-sm my-2">
								<tbody>

									<tr>
										<th width="20%">Summary :</th>
										<td>
											<input type="text" class="form-control @error('summary') is-invalid @enderror"
											name="summary" id="summary" placeholder="PR summary"
											value="{{ old('summary', $pr->summary ) }}"
											required/>
										@error('summary')
											<div class="small text-danger">{{ $message }}</div>
										@enderror
										</td>
									</tr>

									<tr>
										<th>Date :</th>
										<td>
											<input type="text" class="form-control"
											name="dsp_date" id="dsp_date" value="{{ date_format($pr->pr_date,"d-M-Y"); }}"
											readonly/>
										</td>
									</tr>
									@if ( auth()->user()->role->value == UserRoleEnum::USER->value || auth()->user()->role->value == UserRoleEnum::HOD->value )
										<tr>
											<th>Department :</th>
											<td>
												<input type="text" name="dept_id" id="dept_id" class="form-control" placeholder="ID" value="{{ auth()->user()->dept_id }}" hidden>
												<input type="text" class="form-control"
													name="dept_name" id="dept_name" placeholder="dept_name"
													value="{{ $pr->dept->name }}"
													readonly/>
											</td>
										</tr>
									@else
										<tr>
											<th>Department :</th>
											<td>
												<select class="form-control select2" data-toggle="select2" name="dept_id" id="dept_id">
													@foreach ($depts as $dept)
														<option {{ $dept->id == old('dept_id',$pr->dept_id) ? 'selected' : '' }} value="{{ $dept->id }}">{{ $dept->name }}</option>
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
											<select class="form-control select2" data-toggle="select2" name="supplier_id" id="supplier_id">
												@foreach ($suppliers as $supplier)
													<option {{ $supplier->id == old('supplier_id',$pr->supplier_id) ? 'selected' : '' }} value="{{ $supplier->id }}">{{ $supplier->name }}</option>
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
											<select class="form-control select2" data-toggle="select2" name="project_id" id="project_id">
												@foreach ($projects as $project)
													<option {{ $project->id == old('project_id',$pr->project_id) ? 'selected' : '' }} value="{{ $project->id }}">{{ $project->name }}</option>
												@endforeach
											</select>
											@error('project_id')
												<div class="small text-danger">{{ $message }}</div>
											@enderror
										</td>
									</tr>


									<x-tenant.edit.currency :value="$pr->currency"/>

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
								<span class="badge {{ $pr->auth_status_badge->badge }}">{{ $pr->auth_status_badge->name}}</span>
								{{-- <a href="{{ route('prs.create') }}" class="btn btn-sm btn-light"><i data-lucide="plus"></i> Create</a>
								<a href="{{ route('prs.index') }}" class="btn btn-sm btn-light"><i data-lucide="database"></i> View all</a> --}}
							</div>
							<h5 class="card-title">Edit Requisition Additional Info</h5>
							<h6 class="card-subtitle text-muted">Edit Requisition Additional Info.</h6>
						</div>
						<div class="card-body">

							<table class="table table-sm my-2">
								<tbody>
									<tr>
										<th>Category :</th>
										<td>
											<select class="form-control select2" data-toggle="select2" name="category_id" id="category_id">
												@foreach ($categories as $category)
													<option {{ $category->id == old('category_id',$pr->category_id) ? 'selected' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
												@endforeach
											</select>
											@error('category_id')
												<div class="small text-danger">{{ $message }}</div>
											@enderror
										</td>
									</tr>

									<tr width="20%">
										<th>Need By Date :</th>
										<td>
											<input type="date" class="form-control @error('need_by_date') is-invalid @enderror"
												name="need_by_date" id="need_by_date" placeholder=""
												value="{{ old(
														'need_by_date', ( empty($pr->need_by_date)? date('Y-m-d') : date('Y-m-d',strtotime($pr->need_by_date)))
														 ) }}"
												required/>
											@error('need_by_date')
												<div class="small text-danger">{{ $message }}</div>
											@enderror
										</td>
									</tr>
									<x-tenant.edit.notes value="{{ $pr->notes }}"/>

									<x-tenant.attachment.create />
									<tr>
										<th>Requestor :</th>
										<td>
											<input type="text" class="form-control"
											name="requestor" id="requestor"
											value="{{ $pr->requestor->name }}"
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

			<x-tenant.widgets.prl.list-all-lines prId="{{ $pr->id }}"/>

			<div class="float-end">
				<a class="btn btn-secondary text-white" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel" href="{{ route('prs.show',$pr->id) }}"><i data-lucide="x-circle"></i> Cancel</a>
				<button type="submit" id="submit" name="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Save"><i data-lucide="save"></i> Save</button>
			</div>

	</form>
	<!-- /.form end -->

	@include('tenant.includes.js.select2')


@endsection

