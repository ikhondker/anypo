<div class="mb-3">
	<label class="form-label">Website</label>
	<input type="text" class="form-control @error('website') is-invalid @enderror"
		name="website" id="website" placeholder="http://www.anypo.net"
		value="{{ old('website', 'http://www.anypo.net' ) }}"
		required/>
	@error('website')
		<div class="text-danger text-xs">{{ $message }}</div>
	@enderror
</div>