<!-- Form -->
<div class="row mb-4">
	<label for="content" class="col-sm-3 col-form-label form-label">Content X:</label>
	<div class="col-sm-9">
			<textarea class="form-control" rows="5" name="content" 
			placeholder="Enter ...">{{ old('content', "Enter ...") }}</textarea>
		@error('content')
			<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</div>
</div>
<!-- End Form -->