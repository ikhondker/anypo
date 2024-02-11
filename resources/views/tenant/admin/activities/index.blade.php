@extends('layouts.app')
@section('title','Activities')

@section('content')

<x-tenant.page-header>
	@slot('title')
	Activities
	@endslot
	@slot('buttons')

	@endslot
</x-tenant.page-header>

<div class="row">

	<div class="col-10">

		<div class="card">
			<div class="card-header">
				<x-tenant.cards.header-search-export-bar object="Activity" />
				<h5 class="card-title">
					@if (request('term'))
					Search result for: <strong class="text-danger">{{ request('term') }}</strong>
					@else
					Activity Lists
					@endif
				</h5>
				<h6 class="card-subtitle text-muted">Horizontal Bootstrap layout header-with-simple-search.</h6>
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
							<th>Performer Role</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($activities as $activity)
						<tr>
							<td>{{ $activity->id }}</td>
							<td>
								<x-tenant.list.my-date-time :value="$activity->created_at" />
							</td>
							<td>{{ $activity->object_name }}</td>
							<td>{{ $activity->object_id }}</td>
							<td>{{ $activity->event_name }}</td>
							<td>{{ $activity->column_name }}</td>
							<td>{{ $activity->prior_value }}</td>
							<td>{{ $activity->user->name }}</td>
							<td>
								<x-tenant.list.my-badge :value="$activity->role" />
							</td>
							<td class="table-action">
								<x-tenant.list.actions object="Activity" :id="$activity->id" :edit="false" />
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

	</div>
	<!-- end col -->
</div>
<!-- end row -->

{{-- @include('tenant.includes.modal-boolean') --}}

@endsection