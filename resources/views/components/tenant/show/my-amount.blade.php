<div class="row mb-3">
	<div class="col-sm-3 text-end">
		<span class="h6 text-secondary">{{ $label }} X:</span>
	</div>
	<div class="col-sm-9">
		{{number_format($value, 2)}} {{ $_setup->currency }}
	</div>
</div>
