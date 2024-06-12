<div class="mb-3">
    <label class="form-label">Notes X:</label>
        <textarea class="form-control" name="notes" placeholder="Enter ..." rows="4">{{ old('notes', $value) }}</textarea>
        @error('notes')
            <div class="text-danger text-xs">{{ $message }}</div>
        @enderror
</div>


