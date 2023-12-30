<div class="card-actions float-end">
	<form action="{{ route( $route.'.index') }}" method="GET" role="search">
		<div class="btn-toolbar" role="toolbar" aria-label="Toolbar">
			<div class="btn-group me-2" role="group" aria-label="First group">
				<input type="text" class="form-control form-control-sm" minlength=3 name="term" placeholder="Search..." value="{{ old('term', request('term') ) }}"  id="term" required>
				
				<button type="submit" class="btn btn-info me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Search..."> <i class="align-middle" data-feather="search"></i></button>

				<a href="{{ route( $route.'.index') }}" class="btn btn-info text-white me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Reload">
					<i class="align-middle" data-feather="refresh-cw"></i>
				</a>
				@if ($export)
					<a href="{{ route( $route.'.export') }}" class="btn btn-info text-white me-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Download">
						
						<i class="align-middle" data-feather="download-cloud"></i> 
					</a>
				@endif
			</div>
		</div>
	</form>
</div>