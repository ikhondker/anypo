<div class="mb-3 col-md-6">
    <label for="city" class="form-label">City X</label>
    <input type="text" class="form-control @error('city') is-invalid @enderror" 
        name="city" id="city" placeholder="City"     
        value="{{ old('city', $value ) }}"
        required/>
    @error('city')
        <div class="text-danger text-xs">{{ $message }}</div>
    @enderror
</div>