{{-- <label for="file_to_upload" class="col-sm-2 col-form-label text-end text-secondary">Select File:</label>
<input type="file" class="form-control form-control-sm" name="file_to_upload" id="file_to_upload"
	accept=".jpg,.jpeg,.bmp,.png,.gif,.doc,.docx,.ppt,.pptx,.csv,.rtf,.xlsx,.xls,.txt,.pdf,.zip"
	placeholder="file_to_upload"> --}}

    <div class="mb-3 row">
        <label class="col-form-label col-sm-3 text-sm-right">Attachment :</label>
        <div class="col-sm-9">
            <input type="file" class="form-control form-control-sm" name="file_to_upload" id="file_to_upload"
            accept=".jpg,.jpeg,.bmp,.png,.gif,.doc,.docx,.ppt,.pptx,.csv,.rtf,.xlsx,.xls,.txt,.pdf,.zip"
            placeholder="file_to_upload">

            @error('file_to_upload')
            <div class="text-danger text-xs">{{ $message }}</div>
            @enderror
        </div>
    </div>

{{-- <div class="mb-3">
	<label class="form-label">Attachment</label>
	<input type="file" class="form-control form-control-sm" name="file_to_upload" id="file_to_upload"
		accept=".jpg,.jpeg,.bmp,.png,.gif,.doc,.docx,.ppt,.pptx,.csv,.rtf,.xlsx,.xls,.txt,.pdf,.zip"
		placeholder="file_to_upload">

	@error('file_to_upload')
	<div class="text-danger text-xs">{{ $message }}</div>
	@enderror
</div> --}}

{{-- <label class="form-label w-100">File Upload</label>
<input type="file" name="file_to_upload" id="file_to_upload"
	accept=".jpg,.jpeg,.bmp,.png,.gif,.doc,.docx,.ppt,.pptx,.csv,.rtf,.xlsx,.xls,.txt,.pdf,.zip"
	placeholder="file_to_upload" />
<small class="form-text text-muted">Example block-level help text here.</small> --}}
