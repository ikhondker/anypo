@extends('layouts.landlord-app')
@section('title', 'Unhandled Error Logs')
@section('breadcrumb', 'Unhandled Error Logs')

@section('content')

	<!-- Card -->
	<div class="card">
		<div class="card-header">
			<h5 class="card-header-title">Unhandled Error Logs</h5>
		</div>

		<!-- Table -->
		<div class="table-responsive">
			<table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
				<thead class="thead-light">
					<tr>
						<th>Name</th>
						<th>Date</th>
						<th>User</th>
						<th>Role</th>
						<th>Status</th>
						<th style="width: 5%;">Action</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($errorLogs as $errorLog)
						<tr>
							<td>
								<div class="d-flex align-items-center">
									<div class="flex-shrink-0">
										<img class="avatar avatar-sm avatar-circle"
											src="{{ Storage::disk('s3l')->url('logo/logo.png') }}" alt="Logo">
									</div>

									<div class="flex-grow-1 ms-3">
										<a class="d-inline-block link-dark" href="#">
											<h6 class="text-hover-primary mb-0">{{ $errorLog->tenant }}	</h6>
										</a>
										<small class="d-block"> {{ strtoupper(date('d-M-Y H:i:s', strtotime($errorLog->created_at))) }} </small>
									</div>
								</div>
							</td>
							<td>
								<small class="d-block">{{ $errorLog->url }}<br>{{ $errorLog->e_class }}</small>
							</td>
							<td>{{ $errorLog->user_id }}</td>
							<td>{{ $errorLog->role }}</td>
							<td>{{ $errorLog->status }}</td>
							<td><x-landlord.list.actions object="ErrorLog" :id="$errorLog->id" :edit="true" :enable="false" /></td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<!-- End Table -->

	</div>
	<!-- End Card -->

@endsection
