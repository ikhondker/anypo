<!-- Form -->
<div class="row mb-4">
	<label for="cell" class="col-sm-3 col-form-label form-label">Cell X:</label>
	<div class="col-sm-9">
	  <input type="text" class="form-control @error('cell') is-invalid @enderror" 
			name="cell" id="cell" placeholder="+01911"     
			value="{{ old('cell', '' ) }}"
			required/>
		@error('cell')
			<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</div>
</div>
<!-- End Form -->