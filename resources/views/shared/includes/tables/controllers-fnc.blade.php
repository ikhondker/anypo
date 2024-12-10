<div class="card">
	<div class="card-header">
		<div class="card-actions float-end">
			<a href="{{ route('tables.index') }}" class="btn btn-sm btn-light"><i data-lucide="database"></i> View all</a>
		</div>
		<h5 class="card-title">Folder: {{ request()->route()->parameter('dir') }}</h5>
		<h6 class="card-subtitle text-info">Folder: {{ request()->route()->parameter('dir') }}
			<a class="" href="{{ route('tables.fnc-controllers') }}"><i class="align-middle me-1" data-lucide="folder"></i>Root</a>
			<a class="" href="{{ route('tables.fnc-controllers','Admin') }}"><i class="align-middle me-1" data-lucide="folder"></i>Admin</a>
			<a class="" href="{{ route('tables.fnc-controllers','Lookup') }}"><i class="align-middle me-1" data-lucide="folder"></i>Lookup</a>
			<a class="" href="{{ route('tables.fnc-controllers','Manage') }}"><i class="align-middle me-1" data-lucide="folder"></i>Manage</a>
			<a class="" href="{{ route('tables.fnc-controllers','Workflow') }}"><i class="align-middle me-1" data-lucide="folder"></i>Workflow</a>
			<a class="" href="{{ route('tables.fnc-controllers','Support') }}"><i class="align-middle me-1" data-lucide="folder"></i>Support</a>
		</h6>
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
					//$methods = (new ReflectionClass('\App\Blog'))->getMethods();
					//dd($methods);
					$exclude = array("middleware", "getMiddleware", "callAction", "__call", "authorize",'authorizeForUser','authorizeResource','validateWith','validate','validateWithBag');
					//$class = new ReflectionClass('App\Http\Controllers\Tenant\HomeController');
					//$class = new ReflectionClass('App\Http\Controllers\Tenant\\'. $row["f"]);
					//$class = new ReflectionClass(config('akk.DOC_DIR_CLASS') .'\\'. $row["f"]);

					//Log::debug('Value of $target_dir-> row[f]=' . $target_dir .'\\'. $row["f"]);
					//$class = new ReflectionClass( $target_dir .'\\'. $row["f"]);
					//Log::debug('Value of $target_dir-> row[f]=' . $target_dir .'\\'. $row["f"]);

					if ($dir == "") {
						Log::debug('NULL Value of $target_dir-> row[f]=' . $target_dir . $row["f"]);
						$class = new ReflectionClass( $target_dir .$row["f"]);
					} else {
						Log::debug('NOT NOT Value of $target_dir-> row[f]=' . $target_dir .'\\'. $row["f"]);
						$class = new ReflectionClass( $target_dir .'\\'. $row["f"]);
					}

					$methods = $class->getMethods(ReflectionMethod::IS_PUBLIC);
					@endphp
					@foreach ($methods as $method)
						@php
							if (!in_array($method->name, $exclude)) {
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
