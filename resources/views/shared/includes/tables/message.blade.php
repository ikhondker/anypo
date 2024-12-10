<div class="card">
	<div class="card-header">
		<div class="card-actions float-end">
			<a href="{{ route('tables.index') }}" class="btn btn-sm btn-light"><i data-lucide="database"></i>View all</a>
		</div>
		<h5 class="card-title">Folder: {{ request()->route()->parameter('dir') }}</h5>
		<h6 class="card-subtitle text-muted">
			<a class="" href="{{ route('tables.messages') }}"><i class="align-middle me-1" data-lucide="folder"></i>Root</a>
			<a class="" href="{{ route('tables.messages','Admin') }}"><i class="align-middle me-1" data-lucide="folder"></i>Admin</a>
			<a class="" href="{{ route('tables.messages','Lookup') }}"><i class="align-middle me-1" data-lucide="folder"></i>Lookup</a>
			<a class="" href="{{ route('tables.messages','Manage') }}"><i class="align-middle me-1" data-lucide="folder"></i>Manage</a>
			<a class="" href="{{ route('tables.messages','Workflow') }}"><i class="align-middle me-1" data-lucide="folder"></i>Workflow</a>
			<a class="" href="{{ route('tables.messages','Support') }}"><i class="align-middle me-1" data-lucide="folder"></i>Support</a>
		</h6>
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
