<div class="mb-3">
	<label class="form-label">Name</label>
	<input type="text" class="form-control @error('name') is-invalid @enderror" 
		name="name" id="name" placeholder="Name"     
		value="{{ old('name', $value ) }}"
		required/>
	@error('name')
		<div class="text-danger text-xs">{{ $message }}</div>
	@enderror
</div>