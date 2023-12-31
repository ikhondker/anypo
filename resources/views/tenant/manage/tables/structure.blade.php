@extends('layouts.app')
@section('title','Table Structure')
@section('breadcrumb')
	Table: {{ $table }} 
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Tables Lists 
		@endslot
		@slot('buttons')
			<x-tenant.table-links/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
				<h5 class="card-title">Table: [{{ $table }}]</h5>
				</div>
				<div class="card-body">
					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label col-form-label-sm text-end text-muted h6">COLUMN LIST:</label>
						<div class="col-sm-9 col-form-label col-form-label-sm">
							@foreach ($columns as $column)
								{{ $column->Field.' '}}
							@endforeach
						</div>
					</div>
					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label col-form-label-sm text-end text-muted h6">Fillable:</label>
						<div class="col-sm-9 col-form-label col-form-label-sm">
							@foreach ($columns as $column)
								@if ( ($column->Field <> 'id') && ($column->Field <> 'deleted_at') && ($column->Field <> 'created_by') && ($column->Field <> 'created_at')  )
									{{ '\''.$column->Field.'\', '}}
								@endif
							@endforeach
						</div>
					</div>
		
					<div class="form-group row">
						<label for="name" class="col-sm-2 col-form-label col-form-label-sm text-end text-muted h6">SQL:</label>
						<div class="col-sm-9 col-form-label col-form-label-sm">
							{{ __('SELECT ')  }}
							@foreach ($columns as $column)
								@if ($column->Field =='enable')
									IF(enable, 'Yes', 'No') as Enable,
								@else
									{{ $column->Field.', '}}
								@endif 

							@endforeach
							{{ __('FROM '.$table)  }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	  
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
				<h5 class="card-title">Table [{{ $table }}]</h5>
				</div>
				<div class="card-body">
					<table class="table table-striped table-sm">
						<thead>
							<tr>
								<th class="" scope="col">SL#</th>
								<th class="" scope="col">Name</th>
								<th class="" scope="col">Type</th>
								<th class="" scope="col">Null</th>
								<th class="" scope="col">Key</th>
								<th class="" scope="col">Default</th>
								<th class="" scope="col">Extra</th>
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
			</div>
		</div>
	</div>
	
@endsection

