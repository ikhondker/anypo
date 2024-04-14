@extends('layouts.landlord-app')
@section('title','Event Log')
@section('breadcrumb','Event Log')


@section('content')


	<!-- Card -->
	<div class="card">

		<div class="card-header d-sm-flex justify-content-sm-between align-items-sm-center border-bottom">

			<h5 class="card-header-title">
				@if (request('start_date'))
					Search result for: <strong class="text-danger">{{ request('start_date') .' to '.request('end_date') }}</strong>
				@else
				Event Log
				@endif
			</h5>

			<div class="card-actions float-end">
				<!-- form -->
				<form action="{{ route('activities.index') }}" method="GET" role="search">

					
					<div class="btn-group" role="group" aria-label="First group">
						<input type="date" class="datepicker form-control @error('start_date') is-invalid @enderror"
							name="start_date" id="start_date" placeholder=""
							value="{{ old('start_date', date('Y-m-01') ) }}"
							required/>
						<input type="date" class="form-control @error('end_date') is-invalid @enderror"
							name="end_date" id="end_date" placeholder=""
							value="{{ old('end_date', date('Y-m-d') ) }}"
							required/>
						<button type="submit" name="action" value="search" class="btn btn-info me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Search..."> <i class="bi bi-search"></i></i></button>
						<a href="{{ route( 'activities.index') }}" class="btn btn-info text-white me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
							<i class="bi bi-arrow-repeat"></i>
						</a>
						<button type="submit" name="action" value="export" class="btn btn-info me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Download"> 
							<i class="bi bi-arrow-down-circle"></i>
						</button>

						{{-- <button type="submit" class="btn btn-info me-1" data-bs-toggle="tooltip" data-bs-placement="top"
							title="Search..."><i class="bi bi-search"></i></button>

						<a href="{{ route('activities.index') }}" class="btn btn-info me-1" data-bs-toggle="tooltip"
							data-bs-placement="top" title="Reload">
							<i class="bi bi-arrow-repeat"></i>
						</a>

						<a href="{{ route('activities.export') }}" class="btn btn-info me-1" data-bs-toggle="tooltip"
							data-bs-placement="top" title="Download">
							<i class="bi bi-arrow-down-circle"></i>
						</a> --}}

					</div>
					
				</form>
				<!--/. form -->
			</div>
		</div>
		<!-- Table -->
		<div class="table-responsive">
			<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
				<thead class="thead-light">
				<tr>
					<th>Object</th>
					<th>Date</th>
					<th>Event</th>
					<th>Performer</th>
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
									<a class="d-inline-block link-dark" href="#">
										<h6 class="text-hover-primary mb-0">{{ $activity->object_name }}</h6>
									</a>
								<small class="d-block">ID: {{ $activity->object_id }}</small>
								</div>
							</div>
						</td>
						<td><x-landlord.list.my-date :value="$activity->created_at"/></td>
						<td>{{ $activity->event_name }}</td>
						<td>{{ $activity->user->name }}</td>
						<td><x-landlord.list.actions object="Activity" :id="$activity->id" :edit="false" :enable="false"/></td>
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
