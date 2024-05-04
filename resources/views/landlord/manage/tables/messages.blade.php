@extends('layouts.landlord-app')
@section('title','Routes List')
@section('breadcrumb')
	DB: {{ env('DB_DATABASE')}}@[{{ base_path()}}]
@endsection


@section('content')
	<!-- Card -->
	<div class="card">
		<div class="card-header d-flex justify-content-between align-items-center border-bottom">
			<h5 class="card-header-title">Routes Lists</h5>
		</div>

		<!-- card-body -->
		<div class="card-body">
			<!-- Breadcrumb -->
			<div class="container">
				<div class="row align-items-lg-center pb-3">
					<div class="col-lg mb-2 mb-lg-0">
						<h6 class="card-subtitle text-info">Folder: {{ request()->route()->parameter('dir') }}</h6>
						<a class="" href="{{ route('tables.messages') }}"><i class="align-middle me-1" data-feather="folder"></i>Root</a>
						<a class="" href="{{ route('tables.messages','Admin') }}"><i class="align-middle me-1" data-feather="folder"></i>Admin</a>
						<a class="" href="{{ route('tables.messages','Lookup') }}"><i class="align-middle me-1" data-feather="folder"></i>Lookup</a>
						<a class="" href="{{ route('tables.messages','Manage') }}"><i class="align-middle me-1" data-feather="folder"></i>Manage</a>
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

			@php
				$filesInFolder = \File::files(base_path() . $target_dir);
			@endphp 	

			@foreach($filesInFolder as $path) 
				<div class="alert alert-primary" role="alert">
					<div class="alert-message">
						@php
							$file = pathinfo($path);
							// echo $file['dirname'] .'<br>' ;	// D:\laravel\ho03\app\Http\Controllers
							// echo $file['basename'] .'<br>' ;	// ActivityController.php
							// echo $file['extension'] .'<br>' ;// php
							// echo $file['filename'] .'<br>' ;	// ActivityController

							$f = $file['dirname'] . "\\" . $file['basename'];

							echo '--------------------------------------------<br>';
							echo '<strong>'.$f . '</strong><br>';
							echo '--------------------------------------------<br>';
							foreach (file($f) as $line) {
								// authorize, with
								if (Str::contains($line, 'with(')) {
									echo $line . '<br>';
								}
							}
						@endphp
					</div>
				</div>
			@endforeach
		</div>
	</div>
	<!-- End Card -->

@endsection

