<div class="card">
	<div class="card-header">
		<h5 class="card-title">Tables Lists</h5>
		<h6 class="card-subtitle text-muted">DB: {{ env('DB_DATABASE')}}@[{{ base_path()}}]</h6>
	</div>

	<table class="table table-striped table-sm">
		<thead>
			<tr>
				<th>SL#</th>
				<th class="">Table Name</th>
				<th class="">View</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($tables as $table)
					@foreach ($table as $key => $value)
					<tr>
						<td>{{ ++$i }}</td>
						<td><a href="{{ route('tables.structure', ['table'=>$value]) }}"><strong>{{ $value }}</strong></a></td>
						<td>
							<a href="{{ route('tables.structure', ['table'=> $value]) }}" class="btn btn-light"
								data-bs-toggle="tooltip" data-bs-placement="top" title="View">View
							</a>
						</td>
					</tr>
					@endforeach
				@endforeach
		</tbody>
	</table>
</div>