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
						<td><a href="{{ route('tables.structure', ['table'=>$value]) }}"><span class="text-info">{{ $value }}</span></a></td>
						<td><a class="btn btn-sm btn-info" href="{{ route('tables.structure', ['table'=> $value]) }}"><i class="fas fa-list"></i> View</a></td>
					</tr>
					@endforeach
				@endforeach
		</tbody>
	</table>
</div>