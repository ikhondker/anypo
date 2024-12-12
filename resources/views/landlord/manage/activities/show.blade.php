@extends('layouts.landlord.app')
@section('title','Event Log')
@section('breadcrumb')
	<li class="breadcrumb-item"><a href="{{ route('activities.index') }}" class="text-muted">Activities</a></li>
	<li class="breadcrumb-item active">{{ $activity->id }}</li>
@endsection

@section('content')
	<a href="{{ route('activities.index') }}" class="btn btn-primary float-end mt-n1 me-1"><i data-lucide="database"></i> View all</a>
	<h1 class="h3 mb-3">View Event Log</h1>


			<div class="card">
				<div class="card-header">
					<div class="card-actions float-end">
						<a href="{{ route('activities.index') }}" class="btn btn-sm btn-light"><i data-lucide="database"></i>View all</a>
						@if (auth()->user()->isSystem())
							<a class="btn btn-sm btn-danger text-white" href="{{ route('activities.edit', $activity->id) }}"><i data-lucide="edit"></i> Edit</a>
						@endif
					</div>
					<h5 class="card-title">View Event Log</h5>
					<h6 class="card-subtitle text-muted">View Event Log Detail.</h6>
				</div>
				<div class="card-body">
					<table class="table table-sm my-2">
						<tbody>
							<x-landlord.show.my-badge		value="{{ $activity->id }}" label="ID"/>
							<x-landlord.show.my-date-time	value="{{ $activity->created_at }}"/>
							<x-landlord.show.my-text		value="{{ $activity->object_id }}" label="Object ID"/>
							<x-landlord.show.my-badge		value="{{ $activity->object_name }}" label="Object"/>

							<x-landlord.show.my-text		value="{{ $activity->event_name }}" label="Event"/>
							<x-landlord.show.my-text		value="{{ $activity->column_name }}" label="Column"/>
							<x-landlord.show.my-text		value="{{ $activity->prior_value }}" label="Prior Value"/>

							<x-landlord.show.my-text		value="{{ $activity->user->name }}" label="Performer"/>
							<x-landlord.show.my-badge		value="{{ $activity->role }}" label="Role"/>
							@if (auth()->user()->isBackend())
								<x-landlord.show.my-text		value="{{ $activity->object_type }}" label="Type"/>
								<x-landlord.show.my-text		value="{{ $activity->ip }}" label="IP"/>
								<x-landlord.show.my-text		value="{{ $activity->URL}}" label="URL"/>
								<x-landlord.show.my-text		value="{{ $activity->method }}" label="Method"/>
							@endif
						</tbody>
					</table>
				</div>
			</div>

@endsection
