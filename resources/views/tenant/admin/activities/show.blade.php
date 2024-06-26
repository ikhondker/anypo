@extends('layouts.tenant.app')
@section('title','View Activity Log')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('activities.index') }}">Activity Logs</a></li>
	<li class="breadcrumb-item active">{{ $activity->id }}</li>
@endsection
@section('content')

<x-tenant.page-header>
	@slot('title')
		View Activity Log
	@endslot
	@slot('buttons')
	<x-tenant.buttons.header.lists object="Activity" />
	@endslot
</x-tenant.page-header>


<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">Activity Log Detail</h5>
				<h6 class="card-subtitle text-muted">Activity log detail information.</h6>
			</div>
			<div class="card-body">
				<x-tenant.show.my-badge value="{{ $activity->id }}" label="ID" />
				<x-tenant.show.my-date-time value="{{ $activity->created_at }}" label="Timestamp" />
				<x-tenant.show.my-badge value="{{ $activity->object_name }}" label="Object" />
				<x-tenant.show.article-link entity="{{ $activity->object_name }}" :id="$activity->object_id"/>
				<x-tenant.show.my-badge value="{{ $activity->event_name }}" label="Event" />
				<x-tenant.show.my-text value="{{ $activity->column_name }}" label="Column" />
				<x-tenant.show.my-text value="{{ $activity->prior_value }}" label="Prior Value" />
				<x-tenant.show.my-text value="{{ $activity->user->name }}" label="User" />
				<x-tenant.show.my-badge value="{{ $activity->role }}" label="Role" />
				<x-tenant.show.my-text value="{{ $activity->url }}" label="URL" />
				<x-tenant.show.my-badge value="{{ $activity->method }}" label="Method" />
				<x-tenant.show.my-text value="{{ $activity->ip }}" label="IP" />
			</div>
		</div>
	</div>
	<!-- end col-6 -->
</div>
<!-- end row -->


@endsection