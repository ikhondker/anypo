@extends('layouts.landlord-app')
@section('title','Tables')
@section('breadcrumb')
	DB: {{ env('DB_DATABASE')}}@[{{ base_path()}}]
@endsection


@section('content')

	<!-- Card -->
	<div class="card">
		<div class="card-header">
			<h5 class="card-header-title">Table List DB: {{ env('DB_DATABASE')}}@[{{ base_path()}}]</h5>
		</div>
	
		<!-- card-body -->
		<div class="card-body">
			<x-landlord.table-links/>
		
			<!-- Table -->
			<div class="table-responsive">
				<table class="table table-sm table-borderless table-thead-bordered card-table">
					<thead class="thead-light">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Table Name</th>
						<th scope="col" style="width: 10%;">Action</th>
					</tr>
					</thead>
					<tbody>
						@foreach ($tables as $table)
							@foreach ($table as $key => $value)
							<tr>
								<td>{{ ++$i }}</td>
								<td><a href="{{ route('tables.structure', ['table'=>$value]) }}"><span class="text-info">{{ $value }}</span></a></td>
								<td><a class="btn btn-success btn-sm" href="{{ route('tables.structure', ['table'=>$value]) }}">View</a></td>
							</tr>
							@endforeach    
						@endforeach  

					</tbody>
				</table>
			</div>
			<!-- End Table -->
		</div>
		<!-- /. card-body -->
	</div>
	<!-- End Card -->

@endsection


