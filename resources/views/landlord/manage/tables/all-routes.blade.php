@extends('layouts.landlord-app')
@section('title',' All Routes List')
@section('breadcrumb')
	All Routes List
@endsection


@section('content')

	<!-- Card -->
	<div class="card">
		<div class="card-header d-flex justify-content-between align-items-center border-bottom">
			<h5 class="card-header-title">All Routes</h5>
		</div>

		<!-- card-body -->
		<div class="card-body">
			<x-landlord.table-links/>
			<!-- Table -->
			<table class="table table-sm table-borderless table-thead-bordered">
				<thead class="thead-light">
				<tr>
					<th scope="col">SL#</th>
					<th scope="col">Method</th>
					<th scope="col">URI</th>
					<th scope="col">Name</th>
					<th scope="col">Action</th>

				</tr>
				</thead>
				@php
				$skip_routes = array(
					'sanctum/csrf-cookie',
					'livewire/message/{name}',
					'{locale}/livewire/message/{name}',
					'livewire/upload-file',
					'livewire/preview-file/{filename}',
					'livewire/livewire.js',
					'livewire/livewire.js.map',
					'_ignition/health-check',
					'_ignition/execute-solution',
					'_ignition/update-config',
					'tenancy/assets/{path?}',
					'api/user',
					'api/user',
					'/'
				);
			@endphp   
			<tbody>
				@foreach($routes as $route)
					@if (! in_array($route->uri(), $skip_routes ))
						<tr>
							<th scope="row">{{ ++$i }}</th>
							<td>{{ $route->methods()[0] }}</td>
							<td>{{ $route->uri() }}</td>
							<td>{{ $route->getName() }}</td>
							<td>{{ $route->getActionName() }}</td>
						</tr>
					@endif
				@endforeach
			</tbody>
			</table>
			<!-- End Table -->
		</div>
		<!-- /. card-body -->

	</div>
	<!-- End Card -->
	
@endsection

