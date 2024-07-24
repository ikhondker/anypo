@extends('layouts.tenant.app')
@section('title','Attachments')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Attachments
		@endslot
		@slot('buttons')
			<x-tenant.actions.lookup.project-actions id="{{ $project->id }}"/>
		@endslot
	</x-tenant.page-header>

	<x-tenant.info.project-info id="{{ $project->id }}"/>

	
	<x-tenant.attachment.list-all-by-article entity="{{ EntityEnum::PROJECT->value }}" aid="{{ $project->id }}"/>

@endsection

