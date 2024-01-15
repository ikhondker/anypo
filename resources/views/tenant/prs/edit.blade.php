@extends('layouts.app')
@section('title','Edit Pr')
@section('breadcrumb','Edit Pr')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit PR#{{ $pr->id }}
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Pr"/>
			<x-tenant.buttons.header.create object="Pr"/>
			<a href="{{ route('prs.show', $pr->id) }}" class="btn btn-primary float-end me-2"><i class="fa-regular fa-eye"></i> View Pr</a>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form action="{{ route('prs.update',$pr->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

			<div class="row">
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Edit PR#{{ $pr->id }}</h5>
						</div>
						<div class="card-body">

							{{-- <div class="mb-3">
								<label class="form-label">ID</label>
								<input type="text" name="id" id="id" class="form-control" placeholder="ID" value="{{ old('id', $pr->id ) }}" readonly>
							</div> --}}

							<div class="mb-3">
								<label class="form-label">PR Summary</label>
								<input type="text" class="form-control @error('summary') is-invalid @enderror"
									name="summary" id="summary" placeholder="PR Summary"
									value="{{ old('summary', $pr->summary ) }}"
									/>
								@error('summary')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<div class="mb-3">
								<label class="form-label">Requestor</label>
								<select class="form-control" name="requestor_id">
									@foreach ($users as $user)
										<option {{ $user->id == old('requestor_id',$pr->requestor_id) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }} </option>
									@endforeach
								</select>
								@error('requestor_id')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>
							<div class="mb-3">
								<label class="form-label">Supplier</label>
								<select class="form-control" name="supplier_id">
									@foreach ($suppliers as $supplier)
										<option {{ $supplier->id == old('supplier_id',$pr->supplier_id) ? 'selected' : '' }} value="{{ $supplier->id }}">{{ $supplier->name }} </option>
									@endforeach
								</select>
								@error('supplier_id')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<x-tenant.edit.currency :value="$pr->currency"/>

							{{-- <x-tenant.widgets.submit/> --}}

						</div>
					</div>
				</div>
				<!-- end col-6 -->

				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Pr Info</h5>
						</div>
						<div class="card-body">

							@if ( auth()->user()->role->value == UserRoleEnum::USER->value || auth()->user()->role->value == UserRoleEnum::HOD->value )
								<input type="text" name="dept_id" id="dept_id" class="form-control" placeholder="ID" value="{{ auth()->user()->dept_id }}" hidden>
							@else
								<div class="mb-3">
									<label class="form-label">Dept</label>
									<select class="form-control" name="dept_id">
										@foreach ($depts as $dept)
											<option {{ $dept->id == old('dept_id',$pr->dept_id) ? 'selected' : '' }} value="{{ $dept->id }}">{{ $dept->name }} </option>
										@endforeach
									</select>
									@error('dept_id')
										<div class="text-danger text-xs">{{ $message }}</div>
									@enderror
								</div>
							@endif

							<div class="mb-3">
								<label class="form-label">Project</label>
								<select class="form-control" name="project_id">
									@foreach ($projects as $project)
										<option {{ $project->id == old('project_id',$pr->project_id) ? 'selected' : '' }} value="{{ $project->id }}">{{ $project->name }} </option>
									@endforeach
								</select>
								@error('project_id')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<x-tenant.edit.notes :value="$pr->notes"/>

							<x-tenant.widgets.submit/>

						</div>
					</div>
				</div>
				<!-- end col-6 -->
			</div>

			<!-- widget-pr-lines -->
			<x-tenant.widgets.pr-lines id="{{ $pr->id }}" :show="true"/>

	</form>
	<!-- /.form end -->
@endsection

