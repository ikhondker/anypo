@extends('layouts.tenant.app')
@section('title','Attachments')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('projects.index') }}" class="text-muted">Projects</a></li>
	<li class="breadcrumb-item"><a href="{{ route('projects.show',$project->id) }}" class="text-muted">{{ $project->name }}</a></li>
	<li class="breadcrumb-item active">Attachments</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Attachments
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create model="Project" label="Project"/>
			<x-tenant.actions.lookup.project-actions projectId="{{ $project->id }}"/>
		@endslot
	</x-tenant.page-header>

	{{-- <x-tenant.info.project-info projectId="{{ $project->id }}"/> --}}


	<x-tenant.attachment.list-all-by-article entity="{{ EntityEnum::PROJECT->value }}" articleId="{{ $project->id }}"/>

	<div class="row">
		<div class="col-sm-6">
			<x-tenant.attachment.add entity="{{ EntityEnum::PROJECT->value }}" articleId="{{ $project->id }}"/>
		</div>
		<div class="col-sm-6 text-end">
				<a class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Back" href="{{ route('projects.show', $project->id) }}"><i data-lucide="arrow-left-circle"></i> Back to Projects</a>
		</div>
	</div>

@endsection

