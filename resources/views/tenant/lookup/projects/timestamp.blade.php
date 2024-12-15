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
			<x-tenant.actions.lookup.project-actions projectId="{{ $project->id }}"/>
		@endslot
	</x-tenant.page-header>

<x-tenant.widgets.who-when model="Project" articleId="{{ $project->id }}"/>

<x-tenant.widgets.back-to-list model="Project"/>

@endsection

