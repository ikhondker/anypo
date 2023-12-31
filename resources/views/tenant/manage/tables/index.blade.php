@extends('layouts.app')
@section('title','Tables')
@section('breadcrumb')
	DB: {{ env('DB_DATABASE')}}@[{{ base_path()}}]
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
		<div class="col-8">
			<div class="card">
				<div class="card-header">
				<h5 class="card-title">Tables Lists</h5>
				</div>
				<div class="card-body">
					<table class="table table-striped table-sm">
						<thead>
							<tr>
								<th class="">#</th>
								<th class="">Name</th>
								<th class="text-start">Action</th>
							</tr>
						</thead>
			
						<tbody>
							@foreach ($tables as $table)
									@foreach ($table as $key => $value)
									<tr>
										<td class=""> {{ ++$i }}</td>
										
										<td class=""><a href="{{ route('tables.structure', ['table'=>$value]) }}"><span class="text-info">{{ $value }}</span></a></td>
										<td class="table-action">
											{{-- <a class="btn btn-success" href="{{ route('tables.structure', ['table'=>$value]) }}">View</a> --}}
											<a href="{{ route('tables.structure', ['table'=>$value]) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i class="align-middle" data-feather="eye"></i></a>
										</td>
									</tr>
									@endforeach
								@endforeach
						</tbody>
			
					</table>
				</div>
			</div>
		</div>
	</div>
	  


@endsection
