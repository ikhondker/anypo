<div class="mb-3">
	<label class="form-label">Email</label>
	<input type="email" class="form-control @error('email') is-invalid @enderror"
		name="email" id="email" placeholder="you@example.com"
		value="{{ old('email', 'you@example.com' ) }}"
		required/>
	@error('email')
		<div class="text-danger text-xs">{{ $message }}</div>
	@enderror
</div>