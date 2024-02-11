@extends('layouts.app')
@section('title','Dept')
@section('breadcrumb','Create Dept')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Dept
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.save/>
			<x-tenant.buttons.header.lists object="Dept"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('depts.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Department Info</h5>
						<h6 class="card-subtitle text-muted">Create new department with Requisition and Purchase Order Approval Hierarchy</h6>
					</div>
					<div class="card-body">

						<div class="mb-3">
							<label class="form-label">Dept Name</label>
							<input type="text" class="form-control @error('name') is-invalid @enderror"
								name="name" id="name" placeholder="Dept Name"
								value="{{ old('name', '' ) }}"
								required/>
							@error('name')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>

						<div class="mb-3">
							<label class="form-label">PR Hierarchy</label>
							<select class="form-control" name="pr_hierarchy_id" required>
								<option value=""><< Hierarchy >> </option>
								@foreach ($hierarchies as $hierarchy)
									<option value="{{ $hierarchy->id }}" {{ $hierarchy->id == old('pr_hierarchy_id') ? 'selected' : '' }} >{{ $hierarchy->name }} </option>
								@endforeach
							</select>
							@error('pr_hierarchy_id')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>
						<div class="mb-3">
							<label class="form-label">PO Hierarchy</label>
							<select class="form-control" name="po_hierarchy_id" required>
								<option value=""><< Hierarchy >> </option>
								@foreach ($hierarchies as $hierarchy)
									<option value="{{ $hierarchy->id }}" {{ $hierarchy->id == old('pr_hierarchy_id') ? 'selected' : '' }} >{{ $hierarchy->name }} </option>
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
		<!-- end row -->

	</form>
	<!-- /.form end -->

@endsection