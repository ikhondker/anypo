<div class="mb-3">
    <label class="form-label">End Date </label>
    <input type="date" class="form-control @error('end_date') is-invalid @enderror" 
        name="end_date" id="end_date" placeholder=""     
        value="{{ old('end_date', $value ) }}"
        required/>
    @error('end_date')
        <div class="text-danger text-xs">{{ $message }}</div>
    @enderror
</div>