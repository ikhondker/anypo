@extends('layouts.tenant.app')
@section('title','Edit Requisition')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('prs.index') }}">Requisitions</a></li>
	<li class="breadcrumb-item"><a href="{{ route('prs.show',$pr->id) }}">PR#{{ $pr->id }}</a></li>
	<li class="breadcrumb-item active">Edit</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit PR#{{ $pr->id }}
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Pr" label="Requisition"/>
			<x-tenant.buttons.header.create object="Pr" label="Requisition"/>
			<x-tenant.actions.pr-actions id="{{ $pr->id }}" show="true"/>
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

							{{-- <div class="mb-3">
								<label class="form-label">ID</label>
								<input type="text" name="id" id="id" class="form-control" placeholder="ID" value="{{ old('id', $pr->id ) }}" readonly>
							</div> --}}

							<div class="mb-3 row">
								<label class="col-form-label col-sm-3 text-sm-right">PR Summary</label>
								<div class="col-sm-9">
									<input type="text" class="form-control @error('summary') is-invalid @enderror"
									name="summary" id="summary" placeholder="PR summary"
									value="{{ old('summary', $pr->summary ) }}"
									required/>
								@error('summary')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
								</div>
							</div>

							<div class="mb-3 row">
								<label class="col-form-label col-sm-3 text-sm-right">PR Date</label>
								<div class="col-sm-9">
									<input type="text" class="form-control"
										name="dsp_date" id="dsp_date" value="{{ date_format($pr->pr_date,"d-M-Y"); }}"
									    readonly/>
								</div>
							</div>

							@if ( auth()->user()->role->value == UserRoleEnum::USER->value || auth()->user()->role->value == UserRoleEnum::HOD->value )
								<div class="mb-3 row">
									<label class="col-form-label col-sm-3 text-sm-right">Dept</label>
									<div class="col-sm-9">
										<input type="text" name="dept_id" id="dept_id" class="form-control" placeholder="ID" value="{{ auth()->user()->dept_id }}" hidden>
										<input type="text" class="form-control"
											name="dept_name" id="dept_name" placeholder="dept_name"
											value="{{  $pr->dept->name }}"
											readonly/>
									</div>
								</div>

							@else
								<div class="mb-3 row">
									<label class="col-form-label col-sm-3 text-sm-right">Dept Name</label>
									<div class="col-sm-9">
										<select class="form-control select2" data-toggle="select2" name="dept_id" id="dept_id">
											@foreach ($depts as $dept)
												<option {{ $dept->id == old('dept_id',$pr->dept_id) ? 'selected' : '' }} value="{{ $dept->id }}">{{ $dept->name }} </option>
											@endforeach
										</select>
										@error('dept_id')
											<div class="text-danger text-xs">{{ $message }}</div>
										@enderror
									</div>
								</div>
							@endif


							<div class="mb-3 row">
								<label class="col-form-label col-sm-3 text-sm-right">Supplier</label>
								<div class="col-sm-9">
									<select class="form-control select2" data-toggle="select2" name="supplier_id" id="supplier_id">
										@foreach ($suppliers as $supplier)
											<option {{ $supplier->id == old('supplier_id',$pr->supplier_id) ? 'selected' : '' }} value="{{ $supplier->id }}">{{ $supplier->name }} </option>
										@endforeach
									</select>
									@error('supplier_id')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</div>
							</div>

							<div class="mb-3 row">
								<label class="col-form-label col-sm-3 text-sm-right">Project</label>
								<div class="col-sm-9">
									<select class="form-control select2" data-toggle="select2" name="project_id" id="project_id">
										@foreach ($projects as $project)
											<option {{ $project->id == old('project_id',$pr->project_id) ? 'selected' : '' }} value="{{ $project->id }}">{{ $project->name }} </option>
										@endforeach
									</select>
									@error('project_id')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</div>
							</div>

							<x-tenant.edit.currency :value="$pr->currency"/>

							<x-tenant.buttons.show.save/>

						</div>
					</div>
				</div>
				<!-- end col-6 -->

				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Edit Requisition Additional Info</h5>
							<h6 class="card-subtitle text-muted">Edit Requisition Additional Info.</h6>
						</div>
						<div class="card-body">

                            <div class="mb-3 row">
								<label class="col-form-label col-sm-3 text-sm-right">Need By Date :</label>
								<div class="col-sm-9">
									<input type="date" class="form-control @error('need_by_date') is-invalid @enderror"
                                    name="need_by_date" id="need_by_date" placeholder=""
                                    value="{{ old('need_by_date', date('Y-m-d',strtotime($pr->need_by_date)) ) }}"
                                    required/>
                                    @error('need_by_date')
                                        <div class="text-danger text-xs">{{ $message }}</div>
                                    @enderror
								</div>
							</div>

							<x-tenant.edit.notes :value="$pr->notes"/>

							<x-tenant.attachment.create />

                            <div class="mb-3 row">
                                <label class="col-form-label col-sm-3 text-sm-right">Requestor :</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control"
                                    name="requestor" id="requestor"
                                    value="{{ $pr->requestor->name }}"
                                    readonly/>
                                </div>
                            </div>

							<x-tenant.buttons.show.save/>

						</div>
					</div>
				</div>
				<!-- end col-6 -->
			</div>

			<!-- widget-prl-cards -->
			<x-tenant.widgets.prl.card :pr="$pr">
				@slot('lines')
					<tbody>
						@forelse ($prls as $prl)
							<x-tenant.widgets.prl.card-table-row :line="$prl" :status="$pr->auth_status"/>
						@empty

						@endforelse
					</tbody>
				@endslot
			</x-tenant.widgets.prl.card>
			<!-- /.widget-prl-cards -->


	</form>
	<!-- /.form end -->

	@include('tenant.includes.js.select2')


@endsection

