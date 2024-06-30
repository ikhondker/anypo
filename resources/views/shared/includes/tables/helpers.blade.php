<div class="card">
	<div class="card-header">
		<div class="card-actions float-end">
			<a href="{{ route('tables.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
		</div>
		<h5 class="card-title">Folder: {{ request()->route()->parameter('dir') }}</h5>
		<h6 class="card-subtitle text-info">Folder: {{ request()->route()->parameter('dir') }}
			<a class="" href="{{ route('tables.helpers') }}"><i class="align-middle me-1" data-feather="folder"></i>Root</a>
			<a class="" href="{{ route('tables.helpers','Landlord') }}"><i class="align-middle me-1" data-lucide="folder"></i>Landlord</a>
			<a class="" href="{{ route('tables.helpers','Tenant') }}"><i class="align-middle me-1" data-lucide="folder"></i>Tenant</a>
		</h6>
	</div>
	<div class="card-body">

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
						<td class="">&nbsp;</td>
						<td class="">&nbsp;</td>
						<td class="">&nbsp;</td>
						<td class="text-start">
							@if ($row['days'] < 7)
								<span class="text-danger"> {{ $row['last_modified_human'] }} <span>
							@else
								{{ $row['last_modified_human'] }}
							@endif
						</td>
						<td class="text-start">{{ $row['days'] }}</td>
						<td class="">&nbsp;</td>
					</tr>
				@endforeach
			</tbody>

		</table>
	</div>
</div>