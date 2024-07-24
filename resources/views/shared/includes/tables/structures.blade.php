<div class="card">
	<div class="card-header">
		<div class="card-actions float-end">
			<a href="{{ route('tables.index') }}" class="btn btn-sm btn-light"><i class="fas fa-list"></i> View all</a>
		</div>
		<h5 class="card-title">Table: [{{ $table }}]</h5>
			<h6 class="card-subtitle text-muted">Table Structure.</h6>
	</div>
	<div class="card-body">
		<table class="table table-sm my-2">
			<tbody>
				<tr>
					<th width="10%">COLUMN LIST:</th>
					<td>
						@foreach ($columns as $column)
							{{ $column->Field.' '}}
						@endforeach	
					</td>
				</tr>

				<tr>
					<th>Fillable:</th>
					<td>
						@foreach ($columns as $column)
							@if ( ($column->Field <> 'id') && ($column->Field <> 'deleted_at') && ($column->Field <> 'created_by') && ($column->Field <> 'created_at') )
								{{ '\''.$column->Field.'\', '}}
							@endif
						@endforeach
					</td>
				</tr>
				<tr>
					<th>SQL:</th>
					<td>
						{{ __('SELECT ') }}
						@foreach ($columns as $column)
							@if ($column->Field =='enable')
								IF(enable, 'Yes', 'No') as Enable,
							@else
								{{ $column->Field.', '}}
							@endif 

						@endforeach
						{{ __('FROM '.$table)}}
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>

<div class="card">
	<div class="card-header">
		<h5 class="card-title">Table: [{{ $table }}]</h5>
		<h6 class="card-subtitle text-muted">DB: {{ env('DB_DATABASE')}}@[{{ base_path()}}]</h6>
	</div>

	<table class="table table-striped table-sm">
		<thead>
			<tr>
				<th>SL#</th>
				<th>Name</th>
				<th>Type</th>
				<th>Null</th>
				<th>Key</th>
				<th>Default</th>
				<th>Extra</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($columns as $column)
			<tr>
				<td>{{ $loop->iteration }}</td>
				<td>{{ $column->Field }}</td>
				<td>{{ $column->Type }}</td>
				<td>{{ $column->Null }}</td>
				<td>{{ $column->Key }}</td>
				<td>{{ $column->Default }}</td>
				<td>{{ $column->Extra }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>