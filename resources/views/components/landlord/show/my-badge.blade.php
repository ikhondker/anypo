{{-- <div class="row mb-3">
	<div class="col-sm-2"><p class="text-end text-secondary"><strong>{{ $label }} X :</strong></p></div>
	<div class="col-sm-10"><span class="badge outline-badge-secondary mb-2 me-4">{{ $value }}</span> </div>
</div> --}}

{{-- <div class="form-group row">
	<label for="cell" class="col-sm-3 col-form-label col-form-label-sm text-end text-muted">{{ $label }} X :</label>
	<div class="col-sm-9 col-form-label col-form-label-sm">
		<span class="badge bg-soft-info">{{ $value }}</span>
	</div>
</div> --}}

<div class="row mb-4">
	<label class="col-sm-3 col-form-label form-label">{{ $label }} X :</label>
	<div class="col-sm-9 col-form-label">
		<span class="badge bg-{{ $badge }}">{{ $value }}</span>
	</div>
</div>
