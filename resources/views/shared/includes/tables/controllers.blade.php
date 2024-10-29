<div class="card">
	<div class="card-header">
		<div class="card-actions float-end">
			<a href="{{ route('tables.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i>View all</a>
		</div>
		<h5 class="card-title">Folder: {{ request()->route()->parameter('dir') }}</h5>
		<h6 class="card-subtitle text-muted">
			<a class="" href="{{ route('tables.controllers') }}"><i class="align-middle me-1" data-lucide="folder"></i>Root</a>
			<a class="" href="{{ route('tables.controllers','Admin') }}"><i class="align-middle me-1" data-lucide="folder"></i>Admin</a>
			<a class="" href="{{ route('tables.controllers','Lookup') }}"><i class="align-middle me-1" data-lucide="folder"></i>Lookup</a>
			<a class="" href="{{ route('tables.controllers','Manage') }}"><i class="align-middle me-1" data-lucide="folder"></i>Manage</a>
			<a class="" href="{{ route('tables.controllers','Workflow') }}"><i class="align-middle me-1" data-lucide="folder"></i>Workflow</a>
			<a class="" href="{{ route('tables.controllers','Support') }}"><i class="align-middle me-1" data-lucide="folder"></i>Support</a>
		</h6>
	</div>
	<div class="card-body">

		<table class="table table-sm my-2">
			<tbody>
				<tr>
					<th width="10%">Controller List:</th>
					<td>
						@foreach($filesInFolder as $row)
							{{ $row['f'] }},
						@endforeach
					</td>
				</tr>
			</tbody>
		</table>

		<table class="table table-striped table-sm">
			<thead>
				<tr>
					<th class="">#</th>
					<th class="">Name</th>
					<th class="">Object/Model</th>
					<th class="">Route</th>
					<th class="">Functions</th>
					<th class="">Days Ago</th>
					<th class="">Days</th>
					<th class="">Jump</th>
				</tr>
			</thead>

			<tbody>

				@foreach ($filesInFolder as $row)
					<tr>
						<th scope="row">{{ $loop->iteration }}</th>
						<td class="">{{ $row['f'] }}</td>
						<td class="">{{ $row['removed'] }}</td>
						<td class="">{{ $row['route'] }}</td>
						<td class="table-action"><a class="text-info"
							href="http://localhost:8000/{{ $row['route'] }}">Functions</a>
						</td>
						<td class="text-start">
							@if ($row['days'] < 7)
								<span class="text-danger"> {{ $row['last_modified_human'] }} <span>
							@else
								{{ $row['last_modified_human'] }}
							@endif
						</td>
						<td class="text-start">
							@if ($row['days'] < 7)
								<span class="badge bg-danger"> {{ $row['days'] }} <span>
							@else
								{{ $row['days'] }}
							@endif


						</td>
						<td class="table-action"><a class="text-info"
								href="http://localhost:8000/{{ $row['route'] }}">Jump</a>
						</td>
					</tr>
				@endforeach
			</tbody>

		</table>
	</div>
</div>
