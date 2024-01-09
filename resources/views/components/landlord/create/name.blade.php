 <!-- Form -->
 <div class="row mb-4">
	<label for="emailLabel" class="col-sm-3 col-form-label form-label">Name X:</label>

	<div class="col-sm-9">
		<input type="text" class="form-control @error('name') is-invalid @enderror"
			name="name" id="name" placeholder="Name"
			value="{{ old('name', '' ) }}"
			required/>
		@error('name')
			<div class="text-danger text-xs">{{ $message }}</div>
		@enderror

	</div>
  </div>
  <!-- End Form -->