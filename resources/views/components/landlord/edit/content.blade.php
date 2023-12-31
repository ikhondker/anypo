<!-- Form -->
<div class="row mb-4">
	<label for="content" class="col-sm-3 col-form-label form-label">Content X:</label>
	<div class="col-sm-9">
		<textarea class="form-control" name="content"  placeholder="Enter ..." rows="3">{{ old('content',  $value) }}</textarea>
		@error('content')
			<div class="text-danger text-xs">{{ $message }}</div>
		@enderror
	</div>
</div>
<!-- End Form -->