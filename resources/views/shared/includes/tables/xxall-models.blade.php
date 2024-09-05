<div class="card">
	<div class="card-header">
		<div class="card-actions float-end">
			<a href="{{ route('tables.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i>View all</a>
		</div>
	</div>
	<div class="card-body">
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
						{{-- <td>{{ $row }}</td> --}}
						<td class="text-start">{{ $row['days'] }}</td>
						<td class="table-action"><a class="text-info" href="http://localhost:8000/{{ $row['route'] }}">Jump</a></td>
					</tr>
				@endforeach

			</tbody>
		</table>
		<!-- End Table -->
	</div>
</div>