@extends('layouts.tenant.app')
@section('title','Projects')

@section('breadcrumb')
	<li class="breadcrumb-item active">Projects</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Projects
		@endslot
		@slot('buttons')
			@can('create', App\Models\Tenant\Lookup\Project::class)
				<x-tenant.buttons.header.create model="Project"/>
			@endcan
			@can('spends', App\Models\Tenant\Lookup\Project::class)
				<a href="{{ route('projects.spends') }}" class="btn btn-primary float-end me-2"><i data-lucide="pie-chart"></i> Project Spends</a>
			@endcan
		@endslot
	</x-tenant.page-header>

	<x-tenant.dashboards.project-counts/>

	<div class="card">
		<div class="card-header">
			<x-tenant.card.header-search-export-bar model="Project"/>
			<h5 class="card-title">
				@if (request('term'))
					Search result for: <strong class="text-info">{{ request('term') }}</strong>
				@else
					Project Lists
				@endif
			</h5>
			<h6 class="card-subtitle text-muted">List of projects and budget usages.</h6>
		</div>
		<div class="card-body">
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Code</th>
						<th>Name</th>
						<th>Project Manager</th>
						<th>Start-End</th>
						<th>Closed</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($projects as $project)
					<tr>
						<td>{{ $projects->firstItem() + $loop->index }}</td>

						<td>{{ $project->code }}</td>
						<td><a href="{{ route('projects.show',$project->id) }}"><strong>{{ $project->name }}</strong></a></td>
						<td>{{ $project->pm->name }}</td>
						<td><x-tenant.list.my-date value="{{ $project->start_date }}"/> to <x-tenant.list.my-date value="{{ $project->end_date }}"/></td>
						<td><x-tenant.list.my-closed :value="$project->closed"/></td>
						<td>
							<a href="{{ route('projects.show',$project->id) }}" class="btn btn-light"
								data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i data-lucide="eye"></i> View
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>

			<div class="row pt-3">
				{{ $projects->links() }}
			</div>
			<!-- end pagination -->

		</div>
		<!-- end card-body -->
	</div>
	<!-- end card -->


@endsection

