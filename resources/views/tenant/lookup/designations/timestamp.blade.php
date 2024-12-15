@extends('layouts.tenant.app')
@section('title','View Designation')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('designations.index') }}" class="text-muted">Designations</a></li>
	<li class="breadcrumb-item active">{{ $designation->name }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Designation
		@endslot
		@slot('buttons')
			<x-tenant.buttons.header.lists model="Designation"/>
			<x-tenant.actions.lookup.designation-actions designationId="{{ $designation->id }}"/>
		@endslot
	</x-tenant.page-header>

<x-tenant.widgets.who-when model="Designation" articleId="{{ $designation->id }}"/>

<x-tenant.widgets.back-to-list model="Designation"/>

@endsection

