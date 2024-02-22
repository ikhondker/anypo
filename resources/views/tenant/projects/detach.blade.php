@extends('layouts.app')
@section('title','Remove Attachments')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Remove Attachments
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Project"/>
			<x-tenant.buttons.header.create object="Project"/>
			<x-tenant.buttons.header.edit object="Project" :id="$project->id"/>
			<a href="{{ route('projects.show', $project->id) }}" class="btn btn-primary float-end me-2"><i class="fa-regular fa-eye"></i> View Project</a>
		@endslot
	</x-tenant.page-header>

	<x-tenant.widgets.project-info id="{{ $project->id }}"/>

	
	@include('tenant.includes.detach-by-article')
 

@endsection

