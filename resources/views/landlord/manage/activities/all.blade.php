@extends('layouts.landlord.app')
@section('title', 'Activity Log')
@section('breadcrumb', 'All Activity Log')


@section('content')

<a href="{{ route('activities.create') }}" class="btn btn-primary float-end mt-n1"><i class="fas fa-plus"></i> New Activity</a>
<h1 class="h3 mb-3">All Activities</h1>

<div class="card">
	<div class="card-body">
		<div class="row mb-3">
			<div class="col-md-6 col-xl-4 mb-2 mb-md-0">
				<!-- form -->
				<form action="{{ route('activities.all') }}" method="GET" role="search">
					<div class="input-group input-group-search">
						<input type="date" class="datepicker form-control @error('start_date') is-invalid @enderror"
							name="start_date" id="start_date" placeholder=""
							value="{{ old('start_date', date('Y-m-01') ) }}"
							required/>
						<input type="date" class="form-control @error('end_date') is-invalid @enderror"
							name="end_date" id="end_date" placeholder=""
							value="{{ old('end_date', date('Y-m-d') ) }}"
							required/>
						<button class="btn" type="submit">
							<i class="align-middle" data-lucide="search"></i>
						</button>
					</div>
					@if (request('start_date'))
						Search result for: <strong class="text-danger">{{ request('start_date') .' to '.request('end_date') }}</strong>
					@endif
				</form>
				<!--/. form -->
			</div>
			<div class="col-md-6 col-xl-8">

				<div class="text-sm-end">
					<a href="{{ route('activities.all') }}" class="btn btn-primary btn-lg"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
						<i data-lucide="refresh-cw"></i></a>
					<a href="{{ route('activities.export') }}" class="btn btn-light btn-lg me-2"
						data-bs-toggle="tooltip" data-bs-placement="top" title="Export">
						<i data-lucide="download"></i> Export</a>
				</div>
			</div>
		</div>

		<table id="datatables-orders" class="table w-100">
			<thead>
				<tr>
					<th class="align-middle">#</th>
					<th class="align-middle">Object</th>
					<th class="align-middle">Obj ID</th>

					<th class="align-middle">Date</th>
					<th class="align-middle">Event</th>
					<th class="align-middle">Performer</th>
					<th class="align-middle text-end">Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($activities as $activity)
					<tr>
						<td>
							<img src="{{ Storage::disk('s3l')->url('avatar/avatar.png') }}" width="32" height="32" class="rounded-circle my-n1" alt="Avatar" title="Avatar">
						</td>
						<td>
							<a href="{{ route('activities.show', $activity->id) }}">
							<strong>{{ $activity->object_name }}</strong>
							</a>
						</td>
						<td>{{ $activity->object_id }}</td>
						<td><x-landlord.list.my-date :value="$activity->created_at"/></td>
						<td>{{ $activity->event_name }}</td>
						<td>{{ $activity->user->name }}</td>


						<td class="text-end">
							<a href="{{ route('activities.show',$activity->id) }}" class="btn btn-light" data-bs-toggle="tooltip"
								data-bs-placement="top" title="View">View</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<div class="row mb-3">
			{{ $activities->links() }}
		</div>

	</div>
</div>

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
										<small class="d-block">OBJID: {{ $activity->object_id }}</small>
									</div>
								</div>
							</td>
							<td><x-landlord.list.my-date :value="$activity->created_at" /></td>
							<td>{{ $activity->event_name }}
								<small class="d-block">By: {{ $activity->user->name }}</small>
							</td>
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
