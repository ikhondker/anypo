
<div class="card">
	<div class="card-header">
		<div class="card-actions float-end">
			<a href="{{ route('tables.index') }}" class="btn btn-sm btn-light"><i data-lucide="database"></i> View all</a>
		</div>
		<h5 class="card-title">All Routes</h5>
		<h6 class="card-subtitle text-muted">Route::getRoutes()->getRoutesByName();</h6>
	</div>
	<div class="card-body">

		<table class="table table-striped table-sm">
			<thead>
				<tr>
					<th>SL#</th>
					<th>Method</th>
					<th>URI</th>
					<th>Name</th>
					<th>Actions</th>
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
					'/',
					'_debugbar/open',
					'_debugbar/clockwork/{id}',
					'_debugbar/telescope/{id}',
					'_debugbar/assets/stylesheets',
					'_debugbar/assets/javascript',
					'_debugbar/cache/{key}/{tags?}',
					'telescope/{view?}',
				);
			@endphp
			<tbody>
				@foreach($routes as $route)
					@if (! in_array($route->uri(), $skip_routes ))
						<tr>
							<td> {{ $loop->iteration }}</td>
							<td>{{ $route->methods()[0] }}</td>
							<td>{{ $route->uri() }}</td>
							<td>{{ $route->getName() }}</td>
							<td>{{ $route->getActionName() }}</td>
						</tr>
					@endif
				@endforeach
			</tbody>
		</table>

	</div>
</div>
