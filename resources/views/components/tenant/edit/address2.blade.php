<div class="mb-3">
	<label class="form-label">Address 2 X</label>
	<input type="text" class="form-control @error('address2') is-invalid @enderror" 
		name="address2" id="address2" placeholder="Address 2"     
		value="{{ old('address2', $value ) }}"
		/>
	@error('address2')
		<div class="text-danger text-xs">{{ $message }}</div>
	@enderror
</div>