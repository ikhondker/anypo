<div class="row mb-3">
	<div class="col-sm-3 text-end">
		<span class="h6 text-secondary">Updated At X:</span>
	</div>
	<div class="col-sm-9">
		{{ ($value <> "") ? strtoupper(date('d-M-Y H:i:s', strtotime($value))) : "" }}
	</div>
</div>
