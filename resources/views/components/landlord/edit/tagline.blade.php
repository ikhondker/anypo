<!-- Form -->
<div class="row mb-4">
	<label for="tagline" class="col-sm-3 col-form-label form-label">Tagline X:</label>
	<div class="col-sm-9">
	  <input type="text" class="form-control @error('tagline') is-invalid @enderror" 
			name="tagline" id="tagline" placeholder="Tagline 1"     
			value="{{ old('tagline', $value ) }}"
			required/>
		@error('tagline')
			<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</div>
</div>
<!-- End Form -->