@extends('layouts.app')
@section('title', 'Functions in Models')
@section('breadcrumb')
	DB: {{ env('DB_DATABASE') }}@[{{ base_path() }}]
@endsection


@section('content')
	<x-tenant.page-header>
		@slot('title')
			Functions in Policies
		@endslot
		@slot('buttons')
			<x-tenant.table-links />
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title">Functions in Policies</h5>
					<h6 class="card-subtitle text-muted">{{ config('akk.DOC_DIR_POLICY') }}</h6>
				</div>
				<div class="card-body">
					<table class="table table-striped table-sm">
						<thead>
							<tr>
								<th class="">#</th>
								<th class="">Name</th>
								<th class="">Method Name</th>
								<th class="">Days Ago</th>
								<th class="">Days</th>
								<th class="">Jump</th>
							</tr>
						</thead>

						<tbody>

							@foreach ($filesInFolder as $row)
								@php
								$exclude = array('__call',	);
								//$class = new ReflectionClass('App\Http\Controllers\Tenant\HomeController');
								//$class = new ReflectionClass('App\Models\Tenant\\'. $row["f"]);
								$class = new ReflectionClass(config('akk.DOC_DIR_POLICY') .'\\'. $row["f"]);
								$methods = $class->getMethods(ReflectionMethod::IS_PUBLIC);
								@endphp
								@foreach ($methods as $method)
									@php
										if  (!in_array($method->name, $exclude)) {
									@endphp
										<tr>
											<th scope="row">{{ $loop->iteration }}</th>
											<td class="">{{ $row['f'] }}</td>
											<td class="">	{{ $method->name }}</td>
											<td class="text-start"></td>
											<td class="text-start"></td>
											<td class="text-start"></td>
										</tr>
										@php
										}
										@endphp

								@endforeach
							@endforeach
						</tbody>

					</table>
				</div>
			</div>
		</div>
	</div>


@endsection
