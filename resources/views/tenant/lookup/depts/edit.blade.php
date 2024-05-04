@extends('layouts.app')
@section('title','Edit Dept')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('depts.index') }}">Departments</a></li>
	<li class="breadcrumb-item active">{{ $dept->name }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Dept
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Dept"/>
			<x-tenant.actions.dept-actions id="{{ $dept->id }}"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('depts.update',$dept->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Dept Info</h5>
							<h6 class="card-subtitle text-muted">Edit department and Requisition and Purchase Order Approval Hierarchy</h6>
						</div>
						<div class="card-body">

							<div class="mb-3">
								<label class="form-label">Dept Name</label>
								<input type="text" class="form-control @error('name') is-invalid @enderror"
									name="name" id="name" placeholder="Dept Name"
									value="{{ old('name', $dept->name ) }}"
									/>
								@error('name')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<div class="mb-3">
								<label class="form-label">PR Hierarchy</label>
								<select class="form-control" name="pr_hierarchy_id">
									@foreach ($hierarchies as $hierarchy)
										<option {{ $hierarchy->id == old('pr_hierarchy_id',$dept->pr_hierarchy_id) ? 'selected' : '' }} value="{{ $hierarchy->id }}">{{ $hierarchy->name }} </option>
									@endforeach
								</select>
								@error('pr_hierarchy_id')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<div class="mb-3">
								<label class="form-label">PO Hierarchy</label>
								<select class="form-control" name="po_hierarchy_id">
									@foreach ($hierarchies as $hierarchy)
										<option {{ $hierarchy->id == old('po_hierarchy_id',$dept->po_hierarchy_id) ? 'selected' : '' }} value="{{ $hierarchy->id }}">{{ $hierarchy->name }} </option>
									@endforeach
								</select>
								@error('po_hierarchy_id')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>
							<x-tenant.buttons.show.save/>

						</div>
					</div>
				</div>
				<!-- end col-6 -->
			</div>
	</form>
	<!-- /.form end -->
	@include('shared.includes.js.sw2-advance')
@endsection

