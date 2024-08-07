@extends('layouts.tenant.app')
@section('title','PO for a Project')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('suppliers.index') }}" class="text-muted">Projects</a></li>
	<li class="breadcrumb-item active">{{ $project->name }}</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			PO for a Project
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists object="Project"/>
			<x-tenant.actions.lookup.project-actions id="{{ $project->id }}"/>
		@endslot
	</x-tenant.page-header>


	<x-tenant.info.project-info id="{{ $project->id }}"/>

	<x-tenant.widgets.po.list-by-project id="{{ $project->id }}"/>
	
@endsection

