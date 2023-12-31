<!-- card-footer -->
<div class="card-footer pt-0 border-0">
	<div class="progress br-30 progress-sm">
		<div class="progress-bar bg-info" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
	</div>
	<div class="d-flex justify-content-between">
		<div class="col-4">
			<a class="btn btn-dark" href="{{ url()->previous() }}"> Back</a>
		</div>
		<div class="col-4 d-flex justify-content-end">
			<a class="btn btn-secondary" href="{{ route( $route.'.index') }}">{{ $title }} List</a>
		</div>
	</div>
</div>
<!-- /.card-footer -->