@extends('layouts.app')
@section('title','Attachments')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Attachments
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Project"/>
			<x-tenant.actions.project-actions id="{{ $project->id }}"/>

		@endslot
	</x-tenant.page-header>

	<x-tenant.info.project-info id="{{ $project->id }}"/>

	
	<x-tenant.attachment.list-all-by-article entity="{{ EntityEnum::PROJECT->value }}" aid="{{ $project->id }}"/>

@endsection

