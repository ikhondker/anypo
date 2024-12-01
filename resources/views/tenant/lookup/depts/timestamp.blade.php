@extends('layouts.tenant.app')
@section('title','View Dept')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('depts.index') }}" class="text-muted">Departments</a></li>
	<li class="breadcrumb-item active">{{ $dept->name }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Dept
		@endslot
		@slot('buttons')
			<x-tenant.actions.lookup.dept-actions deptId="{{ $dept->id }}"/>
		@endslot
	</x-tenant.page-header>

    <x-tenant.widgets.who-when model="Dept" articleId="{{ $dept->id  }}"/>

    <x-tenant.widgets.back-to-list model="Dept"/>
@endsection

