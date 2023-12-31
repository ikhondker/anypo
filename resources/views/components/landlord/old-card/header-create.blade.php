{{-- bg-light-secondary /  bg-white --}}
<!-- card-header -->
<div class="card-header bg-white">
	<div class="d-flex justify-content-between">
		<div class="align-self-center">
			<span class="card-title card-header-title">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#2196f3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
				<strong> {{ $title }} </strong>
			</span>
		</div>
		<div class="align-self-center">
			<a class="btn btn-secondary" href="{{ route($route.'.create') }}"> Create {{ $object }}</a>
			@if ($export)
			<a href="{{ route( $route.'.export') }}" class="">
				<span class="input-group-btn">
					<button class="btn btn-outline-secondary" type="button" title="Export">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
					</button>
				</span>
			</a>
			@endif
		</div>

	</div>
</div>
<!-- /.card-header -->