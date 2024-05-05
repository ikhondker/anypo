@extends('layouts.app')
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
			<x-tenant.buttons.header.lists object="Project"/>
			<x-tenant.actions.project-actions id="{{ $project->id }}"/>
		@endslot
	</x-tenant.page-header>


	<div class="row">
		<div class="col-6">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Project Basic Info</h5>
					<h6 class="card-subtitle text-muted">Project Basic Information.</h6>
				</div>
				<div class="card-body">
					<x-tenant.show.my-text		value="{{ $project->code }}" label="Code"/>
					<x-tenant.show.my-text		value="{{ $project->name }}"/>
					<x-tenant.show.my-date		value="{{ $project->start_date }}" label="Start Date"/>
					<x-tenant.show.my-date		value="{{ $project->end_date }}" label="End Date"/>
					<x-tenant.show.my-text		value="{{ $project->pm->name }}" label="Project Manager"/>
					<x-tenant.show.my-boolean	value="{{ $project->closed }}" label="Closed?"/>
					<x-tenant.show.my-text-area		value="{{ $project->notes }}" label="Notes"/>
				</div>
			</div>
		</div>
		<!-- end col-6 -->
		<div class="col-6">
		
			
		</div>
		<!-- end col-6 -->
	</div>
	<!-- end row -->

@endsection

