 <!-- card-footer -->
 <div class="card-footer pt-0 border-0">
	<div class="progress br-30 progress-sm">
		<div class="progress-bar bg-info" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
	</div>
	<div class="d-flex justify-content-between">
		<div class="col-4">
			<a class="btn btn-secondary" href="{{ route($route.'.create') }}"> Create {{ $object}}</a>
			{{-- <a class="badge badge-light-primary" href="{{ route($route.'.export') }}" title="Export ot CSV">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
			</a> --}}
		</div>
		<div class="col-8 d-flex justify-content-end">
			{{-- {{ $templates->links() }} --}}
			{!! $links !!}
		</div>
	</div>
</div>
<!-- /.card-footer -->