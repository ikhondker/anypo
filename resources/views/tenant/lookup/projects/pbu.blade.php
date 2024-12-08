@extends('layouts.tenant.app')
@section('title','Projects Budget Usages')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('projects.index') }}">Projects</a></li>
	<li class="breadcrumb-item active">{{ $project->name }}</li>
@endsection


@section('content')
	<x-tenant.page-header>
		@slot('title')
			Projects Budget Usages
		@endslot
		@slot('buttons')
			<x-tenant.actions.lookup.project-actions projectId="{{ $project->id }}"/>
		@endslot
	</x-tenant.page-header>

	<x-tenant.info.project-info projectId="{{ $project->id }}"/>

	<x-tenant.widgets.dbu-project projectId={{ $project->id }}/>


	<script type="text/javascript">
		function mySubmit() {
			document.getElementById('frm1').submit();
		}
	</script>

@endsection

