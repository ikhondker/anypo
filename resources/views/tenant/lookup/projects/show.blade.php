@extends('layouts.tenant.app')
@section('title','Projects')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projects</a></li>
	<li class="breadcrumb-item active">{{ $project->name }}</li>
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
			<x-tenant.actions.lookup.project-actions projectId="{{ $project->id }}"/>
		@endslot
	</x-tenant.page-header>

	<div class="card">
		<div class="card-header">
			<div class="card-actions float-end">
				@can('update', $project)
					<a class="btn btn-sm btn-light" href="{{ route('projects.edit', $project->id ) }}"><i data-lucide="edit"></i> Edit</a>
				@endif
			</div>
			<h5 class="card-title">Project Basic Info</h5>
			<h6 class="card-subtitle text-muted">Project Basic Information.</h6>
		</div>
		<div class="card-body">
			<table class="table table-sm my-2">
				<tbody>
					<x-tenant.show.my-text		value="{{ $project->code }}" label="Code"/>
					<x-tenant.show.my-text		value="{{ $project->name }}"/>
					<x-tenant.show.my-date		value="{{ $project->start_date }}" label="Start Date"/>
					<x-tenant.show.my-date		value="{{ $project->end_date }}" label="End Date"/>
					<x-tenant.show.my-text		value="{{ $project->pm->name }}" label="Project Manager"/>
					<x-tenant.show.my-closed	value="{{ $project->closed }}"/>
					<x-tenant.show.my-text-area	value="{{ $project->notes }}" label="Notes"/>
                    <tr>
                        <th>Attachments :</th>
                        <td>
                            <x-tenant.attachment.all entity="{{ EntityEnum::PROJECT->value }}" articleId="{{ $project->id }}"/>
                        </td>
					</tr>
					<tr>
                        <th>&nbsp;</th>
                        <td>
                            @can('update', $project)
                                <x-tenant.attachment.add entity="{{ EntityEnum::PROJECT->value }}" articleId="{{ $project->id }}"/>
                            @endcan
                        </td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

	<x-tenant.widgets.back-to-list model="Project"/>

@endsection

