@extends('layouts.tenant.app')
@section('title','Edit Project')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('projects.index') }}" class="text-muted">Projects</a></li>
	<li class="breadcrumb-item"><a href="{{ route('projects.show',$project->id) }}" class="text-muted">{{ $project->code }}</a></li>
	<li class="breadcrumb-item active">Edit</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Edit Project
		@endslot
		@slot('buttons')

			<x-tenant.actions.lookup.project-actions projectId="{{ $project->id }}"/>
		@endslot
	</x-tenant.page-header>

	<!-- form start -->
	<form id="myform" action="{{ route('projects.update',$project->id) }}" method="POST" enctype="multipart/form-data">
		@csrf
		@method('PUT')

		<div class="card">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="{{ route('projects.create') }}" class="btn btn-sm btn-light"><i data-lucide="plus"></i> Create</a>
				</div>
				<h5 class="card-title">Edit Project Info</h5>
				<h6 class="card-subtitle text-muted">Edit Project detail and other information.</h6>
			</div>
			<div class="card-body">
				<table class="table table-sm my-2">
					<tbody>
						<tr>
							<th>Code :</th>
							<td>
								<input type="text" class="form-control @error('code') is-invalid @enderror"
								name="code" id="code" placeholder="XXXX" maxlength="25"
								style="text-transform: uppercase"
								value="{{ old('code', $project->code ) }}"
								required/>
							@error('code')
								<div class="small text-danger">{{ $message }}</div>
							@enderror
							</td>
						</tr>
						<x-tenant.edit.name value="{{ $project->name }}"/>
						<x-tenant.edit.start-date value="{{ date('Y-m-d',strtotime($project->start_date)) }}"/>
						<x-tenant.edit.end-date value="{{ date('Y-m-d',strtotime($project->end_date)) }}"/>
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
						<tr>
							<th>Project Manager :</th>
							<td>
								<select class="form-control" name="pm_id">
									@foreach ($pms as $user)
										<option {{ $user->id == old('pm_id',$project->pm_id) ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
									@endforeach
								</select>
							</td>
						</tr>
						<x-tenant.edit.amount value="{{ $project->amount }}"/>
						<x-tenant.edit.notes value="{{ $project->notes }}"/>
						<x-tenant.edit.save/>
					</tbody>
				</table>
			</div>
		</div>

			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">

						</div>
						<div class="card-body">



						</div>
					</div>
				</div>
				<!-- end col-6 -->
			</div>

	</form>
	<!-- /.form end -->

	<x-tenant.widgets.back-to-list model="Project"/>

@endsection

