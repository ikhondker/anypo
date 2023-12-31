<!-- Form -->
<div class="row mb-4">
	<label for="website" class="col-sm-3 col-form-label form-label">Website X:</label>
	<div class="col-sm-9">
	  <input type="text" class="form-control @error('website') is-invalid @enderror" 
			name="website" id="website" placeholder="https://www.example.com"     
			value="{{ old('website', $url ) }}"
			/>
		@error('website')
			<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</div>
</div>
<!-- End Form -->