@extends('layouts.landlord-app')
@section('title', 'Activity Log')
@section('breadcrumb', 'All Activity Log')


@section('content')


	<!-- Card -->
	<div class="card">
		<div class="card-header">
			<h5 class="card-header-title">All Activity Log</h5>
		</div>

		<!-- Table -->
		<div class="table-responsive">
			<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
				<thead class="thead-light">
					<tr>
						<th>Object</th>
						<th>Date</th>
						<th>Event</th>
						<th>User</th>
						<th style="width: 5%;">Action</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($activities as $activity)
						<tr>
							<td>
								<div class="d-flex align-items-center">
									<div class="flex-shrink-0">
										<img class="avatar avatar-sm avatar-circle"
											src="{{ Storage::disk('s3l')->url('avatar/'.$activity->user->avatar) }}"
											alt="{{ $activity->user->name }}" title="{{ $activity->user->name }}">
									</div>

									<div class="flex-grow-1 ms-3">
										<a class="d-inline-block link-dark" href="{{ route('activities.show', $activity->id) }}">
											<h6 class="text-hover-primary mb-0">{{ $activity->object_name }}</h6>
										</a>
										<small class="d-block">ID: {{ $activity->object_id }}</small>
									</div>
								</div>
							</td>
							<td><x-landlord.list.my-date :value="$activity->created_at" /></td>
							<td>{{ $activity->event_name }}</td>
							<td>{{ $activity->user->name }}</td>
							<td><x-landlord.list.actions object="Activity" :id="$activity->id" :edit="false"
									:enable="false" /></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<!-- End Table -->


		<!-- card-body -->
		<div class="card-body">
			<!-- pagination -->
			{{ $activities->links() }}
			<!--/. pagination -->
		</div>
		<!-- /. card-body -->

	</div>
	<!-- End Card -->
@endsection
