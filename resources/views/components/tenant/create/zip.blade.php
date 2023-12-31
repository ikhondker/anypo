<div class="mb-3 col-md-2">
	<label for="zip" class="form-label">Zip</label>
	<input type="text" class="form-control @error('zip') is-invalid @enderror" 
		name="zip" id="zip" placeholder="1234"     
		value="{{ old('zip', '0000' ) }}"
		required/>
	@error('zip')
		<div class="text-danger text-xs">{{ $message }}</div>
	@enderror
</div>