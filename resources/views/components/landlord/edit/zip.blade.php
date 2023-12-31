<div class="col-md-3">
	<label for="zip" class="form-label">ZIP</label>
	<input type="text" class="form-control @error('zip') is-invalid @enderror" 
		name="zip" id="zip" placeholder="1234"     
		value="{{ old('zip', $value ) }}"
		required/>
	@error('zip')
		<div class="text-danger text-xs">{{ $message }}</div>
	@enderror
</div>