<div class="mb-3">
    <label class="form-label">Address2</label>
    <input type="text" class="form-control @error('address2') is-invalid @enderror" 
        name="address2" id="address2" placeholder="Address"     
        value="{{ old('address2', '' ) }}"
        required/>
    @error('address2')
        <div class="text-danger text-xs">{{ $message }}</div>
    @enderror
</div>