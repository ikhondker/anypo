@extends('layouts.tenant.app')
@section('title','Attachments')

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Attachments
		@endslot
		@slot('buttons')
			<x-tenant.actions.lookup.project-actions projectId="{{ $project->id }}"/>
		@endslot
	</x-tenant.page-header>

	<x-tenant.info.project-info projectId="{{ $project->id }}"/>


	<x-tenant.attachment.list-all-by-article entity="{{ App\Enum\Tenant\EntityEnum::PROJECT->value }}" articleId="{{ $project->id }}"/>

@endsection

