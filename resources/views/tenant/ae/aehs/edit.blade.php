@extends('layouts.tenant.app')
@section('title','Edit Dept')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('depts.index') }}" class="text-muted">Aeh(?)</a></li>
	<li class="breadcrumb-item active">{{ $dept->name }}????</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Accounting
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists model="Ael"/>
			<x-tenant.buttons.header.create model="Ael"/>
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
							<h6 class="card-subtitle text-muted">Edit Accounting Lines</h6>
						</div>
						<div class="card-body">

							<div class="mb-3">
								<label class="form-label">Dept Name</label>
								<input type="text" class="form-control @error('name') is-invalid @enderror"
									name="name" id="name" placeholder="Dept Name"
									value="{{ old('name', $dept->name ) }}"
									/>
								@error('name')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</div>

							<div class="mb-3">
								<label class="form-label">PR Hierarchy</label>
								<select class="form-control" name="pr_hierarchy_id">
									@foreach ($hierarchies as $hierarchy)
										<option {{ $hierarchy->id == old('pr_hierarchy_id',$dept->pr_hierarchy_id) ? 'selected' : '' }} value="{{ $hierarchy->id }}">{{ $hierarchy->name }}</option>
									@endforeach
								</select>
								@error('pr_hierarchy_id')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</div>

							<div class="mb-3">
								<label class="form-label">PO Hierarchy</label>
								<select class="form-control" name="po_hierarchy_id">
									@foreach ($hierarchies as $hierarchy)
										<option {{ $hierarchy->id == old('po_hierarchy_id',$dept->po_hierarchy_id) ? 'selected' : '' }} value="{{ $hierarchy->id }}">{{ $hierarchy->name }}</option>
									@endforeach
								</select>
								@error('po_hierarchy_id')
									<div class="small text-danger">{{ $message }}</div>
								@enderror
							</div>
							<x-tenant.edit.save/>

						</div>
					</div>
				</div>
				<!-- end col-6 -->
			</div>
	</form>
	<!-- /.form end -->
@endsection

