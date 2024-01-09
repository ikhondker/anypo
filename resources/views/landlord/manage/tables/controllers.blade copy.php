@extends('layouts.landlord-app')
@section('title','Controllers List')
@section('breadcrumb')
	DB: {{ env('DB_DATABASE')}}@[{{ base_path()}}]
@endsection


@section('content')

	<!-- Card -->
	<div class="card">
		<div class="card-header d-flex justify-content-between align-items-center border-bottom">
			<h5 class="card-header-title">Controllers List</h5>

		</div>

		<!-- card-body -->
		<div class="card-body">

			<x-landlord.table-links/>

			{{-- @foreach($filesInFolder as $row) 
			{{ print_r($row) }}	
			{{ ++$i.' -- '.$row['f'] }}
				<hr>
			@endforeach --}}

			<!-- Table -->
			{{-- <table class="table table-sm table-borderless table-thead-bordered">
				<thead class="thead-light">
				<tr>

					<th scope="col">#</th>
					<th scope="col">Name</th>
					<th scope="col">Object/Model</th>
					<th scope="col">Route</th>
					<th scope="col">Days Ago</th>
					<th scope="col">Days</th>
					<th scope="col">Jump</th>

				</tr>
				</thead>
				<tbody>
					@foreach($filesInFolder as $path) 
						@php
							$file = pathinfo($path);
							$f= $file['filename'] ;
							//$t= $file['mTime'];
							$last_modified=File::lastModified($path);
							//$t = $t1->toDateTimeString();
							//$t=gmdate("Y-m-d\TH:i:s\Z", $t1)->diffForHumans();
							// ok
							//$t = Carbon::createFromTimestamp($t1)->format('m/d/Y');
							$last_modified_human= \Carbon\Carbon::parse($last_modified)->diffForHumans();
							$last_modified_date= \Carbon\Carbon::parse($last_modified);
							$days = $last_modified_date->diffInDays(now(), false);
	
							$removed = Str::remove('Controller', $f);
							$route = Str::lower(Str::plural(Str::snake($removed, '-')));
						@endphp
							<tr>
								<th scope="row">{{ ++$i }}</th>
								<td class="">{{ $f }}</td>
								<td class="">{{ $removed }}</td>
								<td class="">{{ $route }}</td>
								<td class="text-start">
									@if ($days < 7)
									<span class="text-danger">  {{ $last_modified_human }} <span>
									@else
									{{ $last_modified_human }}
									@endif
								</td>
								<td class="text-start">{{ $days }}</td>
								<td class="table-action"><a class="text-info" href="http://localhost:8000/{{ $route }}">Jump</a></td>
							</tr>
					@endforeach

				</tbody>
			</table> --}}
			<!-- End Table -->
		</div>
		<!-- /. card-body -->

	</div>
	<!-- End Card -->


@endsection

