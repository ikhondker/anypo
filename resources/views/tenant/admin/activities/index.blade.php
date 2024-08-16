@extends('layouts.tenant.app')
@section('title','Activity Log')
@section('breadcrumb')
	<li class="breadcrumb-item active">Activity Logs</li>
@endsection

@section('content')

<x-tenant.page-header>
	@slot('title')
		Activity Log
	@endslot
	@slot('buttons')

	@endslot
</x-tenant.page-header>

<div class="card">
	<div class="card-header">
		<x-tenant.card.header-search-export-bar object="Activity" />
		<h5 class="card-title">
			@if (request('term'))
				Search result for: <strong class="text-danger">{{ request('term') }}</strong>
			@else
				Activity Lists
			@endif
		</h5>
		<h6 class="card-subtitle text-muted">Log of all user activities.</h6>
	</div>
	<div class="card-body">
		<table class="table table-sm">
			<thead>
				<tr>
					<th>ID</th>
					<th>Timestamp</th>
					<th>Object</th>
					<th>Object ID</th>
					<th>Event</th>
					<th>Columns</th>
					<th>Old Value</th>
					<th>Performed By</th>
					<th>Role</th>
					<th>View</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($activities as $activity)
				<tr>
					<td><a href="{{ route('activities.show',$activity->id) }}"><strong>{{ $activity->id }}</strong></a></td>
					<td><x-tenant.list.my-date-time :value="$activity->created_at" /></td>
					<td>{{ $activity->object_name }}</td>
					<td>{{ $activity->object_id }}
						{{-- <x-tenant.list.article-link entity="{{ $activity->object_name }}" :id="$activity->object_id"/> --}}
					</td>
					{{-- <td>{{ $activity->object_name }}</td> --}}
					<td>{{ $activity->event_name }}</td>
					<td>{{ $activity->column_name }}</td>
					<td>{{ $activity->prior_value }}</td>
					<td>{{ $activity->user->name }}</td>
					<td>
						<x-tenant.list.my-badge :value="$activity->role" />
					</td>
					<td>
						<a href="{{ route('activities.show',$activity->id) }}" class="btn btn-light"
							data-bs-toggle="tooltip" data-bs-placement="top" title="View">View
						</a>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>

		<div class="row pt-3">
			{{ $activities->links() }}
		</div>
		<!-- end pagination -->

	</div>
	<!-- end card-body -->
</div>
<!-- end card -->

@endsection
