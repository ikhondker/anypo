<div class="row mb-3">
	<div class="col-sm-4 text-end">
		<span class="h6 text-secondary">{{ $label }} X:</span>
	</div>
	<div class="col-sm-8">
		{{ ($value <> "") ? strtoupper(date('d-M-Y H:i:s', strtotime($value))) : "" }}
	</div>
</div>
