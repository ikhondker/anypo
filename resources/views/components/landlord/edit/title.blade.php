<!-- Form -->
<div class="row mb-4">
	<label for="title" class="col-sm-3 col-form-label form-label">Title X:</label>
	<div class="col-sm-9">
	  <input type="text" class="form-control @error('title') is-invalid @enderror"
			name="title" id="title" placeholder="Title"
			value="{{ old('title', $value ) }}"
			required/>
		@error('title')
			<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</div>
</div>
<!-- End Form -->