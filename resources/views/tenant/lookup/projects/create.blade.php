@extends('layouts.tenant.app')
@section('title','Project')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projects</a></li>
	<li class="breadcrumb-item active">Create</li>
@endsection

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
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h5 class="card-title">Create new Project</h5>
						<h6 class="card-subtitle text-muted">Create new Project and allocate budget.</h6>
					</div>
					<div class="card-body">
						<div class="mb-3 col-md-6">
							<label for="code" class="form-label">Code</label>
							<input type="text" class="form-control @error('code') is-invalid @enderror"
								name="code" id="code" placeholder="XXXX" maxlength="10"
								style="text-transform: uppercase"
								value="{{ old('code', '' ) }}"
								required/>
							@error('code')
								<div class="text-danger text-xs">{{ $message }}</div>
							@enderror
						</div>
						
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
						<div class="mb-3">
							<label class="form-label">Budget Amount ({{ $_setup->currency }})</label>
							<input type="number" class="form-control @error('amount') is-invalid @enderror"
								name="amount" id="amount" placeholder="99,99,999.99"
								step='0.01' min="1" value="{{ old('amount', '1.00' ) }}"
								required/>
							@error('amount')
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