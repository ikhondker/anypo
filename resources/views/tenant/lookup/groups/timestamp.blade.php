@extends('layouts.tenant.app')
@section('title','View Item Group')

@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('groups.index') }}" class="text-muted">Item Groups</a></li>
	<li class="breadcrumb-item active">{{ $group->name }}</li>
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			View Item Group
		@endslot
		@slot('buttons')
			<x-tenant.actions.lookup.group-actions groupId="{{ $group->id }}"/>
		@endslot
	</x-tenant.page-header>

	<x-tenant.widgets.who-when model="Group" articleId="{{ $group->id }}"/>

<x-tenant.widgets.back-to-list model="Group"/>

@endsection

