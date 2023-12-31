<div class="mb-3">
	<label class="form-label">Address1</label>
	<input type="text" class="form-control @error('address1') is-invalid @enderror" 
		name="address1" id="address1" placeholder="Address"     
		value="{{ old('address1', '' ) }}"
		required/>
	@error('address1')
		<div class="text-danger text-xs">{{ $message }}</div>
	@enderror
</div>