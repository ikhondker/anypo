@extends('layouts.landlord-app')
@section('title','Models List')
@section('breadcrumb')
	DB: {{ env('DB_DATABASE')}}@[{{ base_path()}}]
@endsection


@section('content')

	<!-- Card -->
	<div class="card">
		<div class="card-header d-flex justify-content-between align-items-center border-bottom">
			<h5 class="card-header-title">Model Lists</h5>

		</div>

		<!-- card-body -->
		<div class="card-body">
			<x-landlord.table-links/>
			<!-- Table -->
			<table class="table table-sm table-borderless table-thead-bordered">
				<thead class="thead-light">
				<tr>
					<th scope="col">#</th>
					<th scope="col">Name</th>
					<th scope="col">object</th>
					<th scope="col">Route</th>
					<th scope="col">Days Ago</th>
					<th scope="col">Days</th>
					<th scope="col">Jump</th>
				</tr>
				</thead>
				<tbody>
					@foreach($filesInFolder as $row) 
						<tr>
							<th scope="row">{{ $loop->iteration }}</th>
							<td>{{ $row['f'] }}</td>
							<td>{{ Str::lower($row['f']) }}</td>
							<td>{{ $row['route'] }}</td>
							<td class="text-start">
								@if ($row['days'] < 7)
								<span class="text-danger">  {{ $row['last_modified_human'] }} <span>
								@else
								{{ $row['last_modified_human'] }}
								@endif
							</td>
							<td class="text-start">{{ $row['days'] }}</td>
							<td class="table-action"><a class="text-info" href="http://localhost:8000/{{ $row['route'] }}">Jump</a></td>
						</tr>
					@endforeach

				</tbody>
			</table>
			<!-- End Table -->
		</div>
		<!-- /. card-body -->

	</div>
	<!-- End Card -->

@endsection



