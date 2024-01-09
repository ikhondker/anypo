<!-- Form -->
<div class="row mb-4">
	<label for="address1" class="col-sm-3 col-form-label form-label">Address X:</label>
	<div class="col-sm-9">
	  <input type="text" class="form-control @error('address1') is-invalid @enderror"
			name="address1" id="address1" placeholder="Address 1"
			value="{{ old('address1', $value ) }}"
			required/>
		@error('address1')
			<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</div>
</div>
<!-- End Form -->