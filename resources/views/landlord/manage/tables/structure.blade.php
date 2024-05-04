@extends('layouts.landlord-app')
@section('title','Table')
@section('breadcrumb')
	Table: {{ $table }} 
@endsection

@section('content')
	<div class="d-grid gap-3 gap-lg-5">

		<!-- Card -->
		<div class="card">
			<div class="card-header d-flex justify-content-between align-items-center border-bottom">
				<h5 class="card-header-title">Table: [{{ $table }}]</h5>
				<a class="btn btn-primary btn-sm" href="{{ route('users.create') }}">
					<i class="bi bi-plus-square me-1"></i> Future
				</a>
			</div>

			<!-- card-body -->
			<div class="card-body">
				<!-- Breadcrumb -->
				<div class="container">
					<div class="row align-items-lg-center pb-3">
						<div class="col-lg mb-2 mb-lg-0">
							<h6 class="card-subtitle text-info">Folder: {{ request()->route()->parameter('dir') }}</h6>
						</div>
						<!-- End Col -->
						<div class="col-lg-auto">
							<x-landlord.table-links/>
						</div>
						<!-- End Col -->
						</div>
						<!-- End Row -->
				</div>
				<!-- End Breadcrumb -->
				
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
							@if ( ($column->Field <> 'id') && ($column->Field <> 'deleted_at') && ($column->Field <> 'created_by') && ($column->Field <> 'created_at') )
								{{ '\''.$column->Field.'\', '}}
							@endif
						@endforeach
					</div>
				</div>
				<div class="form-group row">
					<label for="name" class="col-sm-2 col-form-label col-form-label-sm text-end text-muted h6">SQL:</label>
					<div class="col-sm-9 col-form-label col-form-label-sm">
						{{ __('SELECT ') }}
						@foreach ($columns as $column)
							@if ($column->Field =='enable')
								IF(enable, 'Yes', 'No') as Enable,
							@else
								{{ $column->Field.', '}}
							@endif 

						@endforeach
						{{ __('FROM '.$table)}}
					</div>
				</div>
			</div>
			<!-- /. card-body -->

		</div>
		<!-- End Card -->


		<!-- Card -->
		<div class="card">
			<div class="card-header d-flex justify-content-between align-items-center border-bottom">
				<h5 class="card-header-title">COLUMN LIST: Table [{{ $table }}]</h5>
				<a class="btn btn-primary btn-sm" href="{{ route('users.create') }}">
					<i class="bi bi-plus-square me-1"></i> Future
				</a>
			</div>

			<!-- card-body -->
			<div class="card-body">
				

				<table class="table table-sm table-borderless table-thead-bordered">
					 <thead class="thead-light">
						<tr>
							<th scope="col">SL#</th>
							<th scope="col">Name</th>
							<th scope="col">Type</th>
							<th scope="col">Null</th>
							<th scope="col">Key</th>
							<th scope="col">Default</th>
							<th scope="col">Extra</th>
						</tr>
					</thead>
		
					<tbody>
						@foreach ($columns as $column)
							<tr>
								<th scope="row">{{ $loop->iteration }}</th>
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
			<!-- /. card-body -->

		</div>
		<!-- End Card -->

	</div>
	
@endsection

