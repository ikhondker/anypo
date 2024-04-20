@extends('layouts.app')
@section('title','Msg in Class')
@section('breadcrumb')
	DB: {{ env('DB_DATABASE')}}@[{{ base_path()}}]
@endsection


@section('content')

	<x-tenant.page-header>
		@slot('title')
			Msg in Class
		@endslot
		@slot('buttons')
			<x-tenant.table-links/>
		@endslot
	</x-tenant.page-header>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					{{-- <h5 class="card-title">Routes Code:  </h5> --}}
					<h6 class="card-subtitle text-info">Folder: {{ request()->route()->parameter('dir')  }}</h6><br>
					<a class="" href="{{ route('tables.messages') }}"><i class="align-middle me-1" data-feather="folder"></i>Root</a>
					<a class="" href="{{ route('tables.messages','Admin') }}"><i class="align-middle me-1" data-feather="folder"></i>Admin</a>
					<a class="" href="{{ route('tables.messages','Lookup') }}"><i class="align-middle me-1" data-feather="folder"></i>Lookup</a>
					<a class="" href="{{ route('tables.messages','Manage') }}"><i class="align-middle me-1" data-feather="folder"></i>Manage</a>
					<a class="" href="{{ route('tables.messages','Workflow') }}"><i class="align-middle me-1" data-feather="folder"></i>Workflow</a>
					<a class="" href="{{ route('tables.messages','Support') }}"><i class="align-middle me-1" data-feather="folder"></i>Support</a>
				</div>
				<div class="card-body">
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
		</div>
	</div>

@endsection

