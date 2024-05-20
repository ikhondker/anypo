<div class="mb-3 row">
    <label class="col-form-label col-sm-3 text-sm-right">Notes X:</label>
    <div class="col-sm-9">
        <textarea class="form-control" name="notes" placeholder="Enter ..." rows="4">{{ old('notes', $value) }}</textarea>
        @error('notes')
            <div class="text-danger text-xs">{{ $message }}</div>
        @enderror
    </div>
</div>
