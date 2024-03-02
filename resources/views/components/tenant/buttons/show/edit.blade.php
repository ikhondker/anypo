<div class="row mb-3">
	<div class="col-sm-3 text-end">
		<span class="h6 text-secondary">&nbsp;</span>
	</div>
	<div class="col-sm-9">
		<a class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel" href="{{ url()->previous() }}"><i data-feather="x-circle"></i> Cancel</a>
		<a href="{{ route($route.'.edit',$id) }}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
			<i class="align-middle" data-feather="edit"></i> Edit </a>
	</div>
</div>
