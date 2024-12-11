@extends('layouts.landlord.app')
@section('title', 'Activity Log')
@section('breadcrumb')
	<li class="breadcrumb-item active">Activities</li>
@endsection

@section('content')

<a href="{{ route('activities.create') }}" class="btn btn-primary float-end mt-n1"><i data-lucide="plus"></i> New Activity</a>
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
							<i data-lucide="search"></i>
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

		<table class="table w-100">
			<thead>
				<tr>
					<th>#</th>
					<th>Object</th>
					<th>Obj ID</th>

					<th>Date</th>
					<th>Event</th>
					<th>Performer</th>
					<th>Actions</th>
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
						<td>
							<a href="{{ route('activities.show',$activity->id) }}" class="btn btn-light" data-bs-toggle="tooltip"
								data-bs-placement="top" title="View"><i data-lucide="eye"></i> View</a>
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


@endsection
