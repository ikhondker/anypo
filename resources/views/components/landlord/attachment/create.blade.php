{{-- <div class="form-group row mb-4">
	<label for="file_to_upload" class="col-sm-2 col-form-label text-end text-secondary">Select File:</label>
	<div class="col-sm-10"> --}}
		<input type="file" class="form-control form-control-sm" name="file_to_upload"
		id="file_to_upload"
		accept=".jpg,.jpeg,.bmp,.png,.gif,.doc,.docx,.ppt,.pptx,.csv,.rtf,.xlsx,.xls,.txt,.pdf,.zip"
		placeholder="file_to_upload">

		@error('file_to_upload')
			<div class="small text-danger">{{ $message }}</div>
		@enderror

	{{-- </div>
</div> --}}
