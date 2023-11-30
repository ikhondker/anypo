<!-- Form -->
<div class="row mb-4">
    <label for="notes" class="col-sm-3 col-form-label form-label">Notes X:</label>
    <div class="col-sm-9">
        <textarea class="form-control" name="notes"  placeholder="Enter ..." rows="3">{{ old('notes',  $value) }}</textarea>
        @error('notes')
            <div class="text-danger text-xs">{{ $message }}</div>
        @enderror
    </div>
</div>
<!-- End Form -->