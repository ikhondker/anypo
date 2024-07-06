@extends('layouts.tenant.app')
@section('title','Edit Project')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projects</a></li>
	<li class="breadcrumb-item"><a href="{{ route('projects.show',$project->id) }}">{{ $project->code }}</a></li>
	<li class="breadcrumb-item active">Edit</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Project
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Project"/>
			<x-tenant.buttons.header.create object="Project"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('projects.update',$project->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h5 class="card-title">Edit Project Info</h5>
							<h6 class="card-subtitle text-muted">Edit Project detail and other information.</h6>
						</div>
						<div class="card-body">

							<div class="mb-3 col-md-6">
								<label for="code" class="form-label">Code</label>
								<input type="text" class="form-control @error('code') is-invalid @enderror"
									name="code" id="code" placeholder="XXXX" maxlength="25"
									style="text-transform: uppercase"
									value="{{ old('code', $project->code ) }}"
									required/>
								@error('code')
									<div class="text-danger text-xs">{{ $message }}</div>
								@enderror
							</div>

							<x-tenant.edit.name :value="$project->name"/>
							<x-tenant.edit.start-date :value="date('Y-m-d',strtotime($project->start_date))"/>
							<x-tenant.edit.end-date :value="date('Y-m-d',strtotime($project->end_date))"/>
							<div class="mb-3">
								<label class="form-label">Project Manager</label>
								<select class="form-control" name="pm_id">
									@foreach ($pms as $user)
										<option {{ $user->id == old('pm_id',$project->pm_id) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }} </option>
									@endforeach
								</select>
							</div>

							<x-tenant.edit.amount :value="$project->amount"/>
							<x-tenant.edit.notes :value="$project->notes"/>

							<x-tenant.buttons.show.save/>

						</div>
					</div>
				</div>
				<!-- end col-6 -->
			</div>

	</form>
	<!-- /.form end -->
@endsection

