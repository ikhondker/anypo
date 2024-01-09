@extends('layouts.app')
@section('title','Project')
@section('breadcrumb','Create Project')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Create Project
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.save/>
			<x-tenant.buttons.header.lists object="Project"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
		@csrf

		<div class="row">
			<div class="col-6">
				<div class="card">
					<div class="card-header">
					<h5 class="card-title">Project Info</h5>
					</div>
					<div class="card-body">
						<x-tenant.create.name/>
						<x-tenant.create.start-date/>
						<x-tenant.create.end-date/>
						
						<div class="mb-3">
							<label class="form-label">Project Manager</label>
							<select class="form-control" name="pm_id" required>
								<option value=""><< Project Manager >> </option>
								@foreach ($pms as $user)
									<option value="{{ $user->id }}" {{ $user->id == old('pm_id') ? 'selected' : '' }} >{{ $user->name }} </option>
								@endforeach
							</select>
							@error('pm_id')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>
				
						<x-tenant.widgets.submit/>
					</div>
				</div>
			</div>
			<!-- end col-6 -->
			<div class="col-6">
				<div class="card">
					<div class="card-header">
					<h5 class="card-title">Budget Info</h5>
					</div>
					<div class="card-body">
						<div class="mb-3">
							<label class="form-check m-0">
							<input type="checkbox" class="form-check-input"
								name="budget_control" id="budget_control"  checked=""/>
								<span class="form-check-label text-danger"> Control Budget?</span>
							</label>
						</div>
						<x-tenant.create.amount/>
						
						<x-tenant.widgets.submit/>
					</div>
				</div>
			</div>
			<!-- end col-6 -->
		</div>
		<!-- end row -->

	</form>
	<!-- /.form end -->

@endsection