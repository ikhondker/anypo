@extends('layouts.tenant.app')
@section('title','Hierarchy')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('hierarchies.index') }}" class="text-muted">Approval Hierarchies</a></li>
	<li class="breadcrumb-item active">{{ $hierarchy->name }}</li>
@endsection

@section('content')

	<x-tenant.page-header>
		@slot('title')
			Approval Hierarchy
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.create model="Hierarchy"/>
			<x-tenant.actions.workflow.hierarchy-actions hierarchyId="{{ $hierarchy->id }}"/>
		@endslot
	</x-tenant.page-header>

	<x-tenant.widgets.who-when model="Hierarchy" articleId="{{ $hierarchy->id  }}"/>

	<x-tenant.widgets.back-to-list model="Hierarchy"/>

@endsection

