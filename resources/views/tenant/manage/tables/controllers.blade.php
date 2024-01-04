@extends('layouts.app')
@section('title', 'Controllers List')
@section('breadcrumb')
	DB: {{ env('DB_DATABASE') }}@[{{ base_path() }}]
@endsection


@section('content')
	<x-tenant.page-header>
		@slot('title')
			Controllers Lists
		@endslot
		@slot('buttons')
			<x-tenant.table-links />
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Controllers List</h5>
				</div>
				<div class="card-body">
					<table class="table table-striped table-sm">
						<thead>
							<tr>
								<th class="">#</th>
								<th class="">Name</th>
								<th class="">Object/Model</th>
								<th class="">Route</th>
								<th class="">Days Ago</th>
								<th class="">Days</th>
								<th class="">Jump</th>
							</tr>
						</thead>

						<tbody>

							@foreach ($filesInFolder as $row)
								<tr>
									<th scope="row">{{ ++$i }}</th>
									<td class="">{{ $row['f'] }}</td>
									<td class="">{{ $row['removed'] }}</td>
									<td class="">{{ $row['route'] }}</td>
									<td class="text-start">
										@if ($row['days'] < 7)
											<span class="text-danger"> {{ $row['last_modified_human'] }} <span>
										@else
											{{ $row['last_modified_human'] }}
										@endif
									</td>
									<td class="text-start">{{ $row['days'] }}</td>
									<td class="table-action"><a class="text-info"
											href="http://localhost:8000/{{ $row['route'] }}">Jump</a></td>
								</tr>
							@endforeach
						</tbody>

					</table>
				</div>
			</div>
		</div>
	</div>


@endsection
