<div class="row mb-4">
	<label class="col-sm-3 col-form-label form-label">{{ $label }} X :</label>
	<div class="col-sm-9 col-form-label">
		{{ ($value <> "") ? strtoupper(date('d-M-Y H:i:s', strtotime($value))) : "" }} 
	</div>
</div>

