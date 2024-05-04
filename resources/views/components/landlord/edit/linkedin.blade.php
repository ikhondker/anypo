<!-- Form -->
<div class="row mb-4">
	<label for="linkedin" class="col-sm-3 col-form-label form-label">LinkedIn X:</label>
	<div class="col-sm-9">
		<input type="text" class="form-control @error('linkedin') is-invalid @enderror"
			name="linkedin" id="linkedin" placeholder="https://www.linkedin.com/username"
			value="{{ old('linkedin', $url ) }}"
			/>
		@error('linkedin')
			<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</div>
</div>
<!-- End Form -->