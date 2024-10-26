<div class="card">
	<div class="card-header">
		<div class="card-actions float-end">
			<a href="{{ route('tables.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i>View all</a>
		</div>
		<h5 class="card-title">Folder: {{ request()->route()->parameter('dir') }}</h5>
		<h6 class="card-subtitle text-muted">
			<a class="" href="{{ route('tables.models') }}"><i class="align-middle me-1" data-lucide="folder"></i>Root</a>
			<a class="" href="{{ route('tables.models','Admin') }}"><i class="align-middle me-1" data-lucide="folder"></i>Admin</a>
			<a class="" href="{{ route('tables.models','Lookup') }}"><i class="align-middle me-1" data-lucide="folder"></i>Lookup</a>
			<a class="" href="{{ route('tables.models','Manage') }}"><i class="align-middle me-1" data-lucide="folder"></i>Manage</a>
			<a class="" href="{{ route('tables.models','Workflow') }}"><i class="align-middle me-1" data-lucide="folder"></i>Workflow</a>
			<a class="" href="{{ route('tables.models','Support') }}"><i class="align-middle me-1" data-lucide="folder"></i>Support</a>
		</h6>
	</div>
	<div class="card-body">

        <table class="table table-sm my-2">
			<tbody>
				<tr>
					<th width="10%">Model List:</th>
					<td>
						@foreach($filesInFolder as $row)
							{{ $row['f'] }},
						@endforeach
					</td>
				</tr>
			</tbody>
		</table>

		<!-- Table -->
		<table class="table table-striped table-sm">

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
							<span class="text-danger"> {{ $row['last_modified_human'] }} <span>
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
</div>
