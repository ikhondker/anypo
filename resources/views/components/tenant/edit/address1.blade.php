<div class="mb-3">
	<label class="form-label">Address 1 X</label>
	<input type="text" class="form-control @error('address1') is-invalid @enderror" 
		name="address1" id="address1" placeholder="Address 1"     
		value="{{ old('address1', $value ) }}"
		required/>
	@error('address1')
		<div class="text-danger text-xs">{{ $message }}</div>
	@enderror
</div>