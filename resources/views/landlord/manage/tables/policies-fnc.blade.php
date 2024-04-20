@extends('layouts.landlord-app')
@section('title', 'Functions in Models')
@section('breadcrumb')
	DB: {{ env('DB_DATABASE') }}@[{{ base_path() }}]
@endsection


@section('content')
	
	<div class="card">
		<div class="card-header">
			<h5 class="card-title">Functions in Policies</h5>
			<h6 class="card-subtitle text-muted">{{ config('akk.DOC_DIR_POLICY') }}</h6>
		</div>
		<div class="card-body">
			<!-- Breadcrumb -->
			<div class="container">
				<div class="row align-items-lg-center pb-3">
					<div class="col-lg mb-2 mb-lg-0">
						<h6 class="card-subtitle text-info">Folder: {{ request()->route()->parameter('dir')  }}</h6>
						<a class="" href="{{ route('tables.fnc-policies') }}"><i class="align-middle me-1" data-feather="folder"></i>Root</a>
						<a class="" href="{{ route('tables.fnc-policies','Admin') }}"><i class="align-middle me-1" data-feather="folder"></i>Admin</a>
						<a class="" href="{{ route('tables.fnc-policies','Lookup') }}"><i class="align-middle me-1" data-feather="folder"></i>Lookup</a>
						<a class="" href="{{ route('tables.fnc-policies','Manage') }}"><i class="align-middle me-1" data-feather="folder"></i>Manage</a>
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
						$class = new ReflectionClass(config('bo.DOC_DIR_POLICY') .'\\'. $row["f"]);
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

@endsection
