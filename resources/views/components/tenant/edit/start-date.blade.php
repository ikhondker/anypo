<div class="mb-3">
	<label class="form-label">Start Date </label>
	<input type="date" class="form-control @error('start_date') is-invalid @enderror" 
		name="start_date" id="start_date" placeholder=""     
		value="{{ old('start_date', $value ) }}"
		required/>
	@error('start_date')
		<div class="text-danger text-xs">{{ $message }}</div>
	@enderror
</div>
